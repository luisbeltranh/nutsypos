<?php

namespace App\Models;

use CodeIgniter\Model;

use App\Models\GranelEmbolsadosModel;
use App\Models\IngresosGranelModel;
use App\Models\IngresosModel;
use App\Models\ProductosModel;
use App\Models\ProductosGranelModel;
use App\Models\VentasModel;
use App\Models\EmbolsadosModel;
use App\Models\FormasPagoModel;
use App\Models\GastosModel;


class Informesmodels extends Model
{
    public function ventasTotales($fecha_inicio, $fecha_fin)
    {
        $modelo_formas_pago = new FormasPagoModel();
        $formas_pago = $modelo_formas_pago->findAll();
        $modelo_ventas = new VentasModel();
        $modelo_gastos = new GastosModel();
        $datos = [];
        $datos['ventas_total'] = $modelo_ventas->selectSum('total')->where('ventas.created_at BETWEEN "' . $fecha_inicio . '" AND "' . $fecha_fin . '"')->first();
        foreach ($formas_pago as $key => $forma_pago) {
            $datos['ventas_' . $forma_pago['nombre']] = $modelo_ventas->selectSum('total')->where('ventas.created_at BETWEEN "' . $fecha_inicio . '" AND "' . $fecha_fin . '" AND ventas.forma_pago_id = "' . $forma_pago['id'] . '"')->first();
        }
        $datos['gastos_total'] = $modelo_gastos->selectSum('monto')->where('gastos.created_at BETWEEN "' . $fecha_inicio . '" AND "' . $fecha_fin . '"')->first();
        $datos['utilidad'] = $datos['ventas_total']['total'] - $datos['gastos_total']['monto'];
        $datos['efectivo_caja'] = $datos['ventas_Efectivo']['total'] - $datos['gastos_total']['monto'];
        $datos['mas_vendidos'] = $this->productosPorVentas($fecha_inicio, $fecha_fin);
        $datos['mas_rentables'] = $this->productosPorUtilidad($fecha_inicio, $fecha_fin);
        $datos['inventario_bajo'] = $this->inventarioBajo();
        $datos['listado_productos_embolsados'] = $this->listadoProductosEmbolsados($fecha_inicio, $fecha_fin);
        $datos['ingreso_productos'] = $this->ingresoProductos($fecha_inicio, $fecha_fin);
        return $datos;
    }
    // esta funcion devuelve la suma de las ventas por producto ordenadas de mas vendidos a menos vendidos
    function productosPorVentas($fecha_inicio, $fecha_fin)
    {
        $modelo_ventas = new VentasModel();
        $resultado = $modelo_ventas
            ->select('productos.nombre AS producto_nombre, SUM(ventas.cantidad) AS total_cantidad, SUM(ventas.total) AS total_vendido')
            ->join('productos', 'productos.id = ventas.producto_id')
            ->where('ventas.created_at >=', $fecha_inicio)
            ->where('ventas.created_at <=', $fecha_fin)
            ->where('ventas.deleted_at', null) // Para no incluir ventas eliminadas (soft delete)
            ->groupBy(['ventas.producto_id', 'productos.nombre'])
            ->orderBy('total_cantidad', 'DESC') // Ordena por la cantidad total vendida (de mayor a menor)
            ->orderBy('producto_nombre', 'ASC')  // Si las cantidades son iguales, ordena por nombre alfabéticamente
            ->findAll();

        return $resultado;
    }
    // esta funcion devuelve la suma de las ventas por producto ordenadas de mas rentables a menos rentables
    function productosPorUtilidad($fecha_inicio, $fecha_fin)
    {
        $modelo_ventas = new VentasModel();
        $resultado = $modelo_ventas
            ->select('productos.nombre AS producto_nombre, SUM((ventas.monto - ventas.costo) * ventas.cantidad) AS total_utilidad, SUM(ventas.cantidad) AS total_cantidad, SUM(ventas.total) AS total_vendido')
            ->join('productos', 'productos.id = ventas.producto_id')
            ->where('ventas.created_at >=', $fecha_inicio)
            ->where('ventas.created_at <=', $fecha_fin)
            ->where('ventas.deleted_at', null) // Para no incluir ventas eliminadas (soft delete)
            ->groupBy(['ventas.producto_id', 'productos.nombre'])
            ->orderBy('total_utilidad', 'DESC') // Ordena por la utilidad total (de mayor a menor)
            ->orderBy('producto_nombre', 'ASC')  // Si las utilidades son iguales, ordena por nombre alfabéticamente
            ->findAll();
        return $resultado;
    }
    // Esta funcion nos da un array con los productos que tienen poco inventario < 5
    function inventarioBajo()
    {
        $modelo_productos = new ProductosModel();
        $resultado = $modelo_productos->where('productos.cantidad_total < 5')->findAll();
        return $resultado;
    }
    function listadoProductosEmbolsados($fecha_inicio, $fecha_fin)
    {
        $modelo_embolsados = new EmbolsadosModel();
        $resultado = $modelo_embolsados
            ->select('productos.nombre AS producto_nombre, productos_granel.nombre AS producto_granel_nombre, cantidad_granel_usado, cantidad_producto_embolsado')
            ->join('productos', 'productos.id = embolsados.producto_id')
            ->join('productos_granel', 'productos_granel.id = embolsados.producto_granel_id')
            ->where('embolsados.created_at >=', $fecha_inicio)
            ->where('embolsados.created_at <=', $fecha_fin)
            ->findAll();
        return $resultado;
    }
    function ingresoProductos($fecha_inicio, $fecha_fin)
    {
        $modelo_ingresos = new IngresosModel();
        $resultado = $modelo_ingresos
            ->select('productos.nombre AS producto_nombre, cantidad, tipo_ingreso')
            ->join('productos', 'productos.id = ingresos.producto_id')
            ->where('ingresos.created_at >=', $fecha_inicio)
            ->where('ingresos.created_at <=', $fecha_fin)
            ->orderBy('tipo_ingreso', 'ASC')
            ->findAll();
        return $resultado;
    }
}
