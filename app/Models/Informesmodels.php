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
use App\Models\CierreposModel;

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
        $datos['costo_productos_vendidos'] = $this->costoProductosVendidos($fecha_inicio, $fecha_fin);
        $datos['ganancia_bruta'] = $datos['ventas_total']['total'] - $datos['costo_productos_vendidos']['total_costo'] - $datos['gastos_total']['monto'];
        $datos['utilidad'] = $datos['ventas_total']['total'] - $datos['gastos_total']['monto'];
        $datos['cantidad_ventas'] = $this->cantidad_ventas($fecha_inicio, $fecha_fin);
        $datos['cantidad_articulos_vendidos'] = $this->cantidad_articulos_vendidos($fecha_inicio, $fecha_fin);
        $datos['venta_promedio'] = $datos['cantidad_ventas']['cantidad_ventas'] > 0 ? $datos['ventas_total']['total'] / $datos['cantidad_ventas']['cantidad_ventas'] : 0;
        $datos['efectivo_caja'] = $datos['ventas_Efectivo']['total'] - $datos['gastos_total']['monto'];
        $datos['mas_vendidos'] = $this->productosPorVentas($fecha_inicio, $fecha_fin);
        $datos['mas_rentables'] = $this->productosPorUtilidad($fecha_inicio, $fecha_fin);
        $datos['inventario_unitario_bajo'] = $this->inventarioUnitarioBajo();
        $datos['inventario_granel_bajo'] = $this->inventarioGranelBajo();
        $datos['listado_productos_embolsados'] = $this->listadoProductosEmbolsados($fecha_inicio, $fecha_fin);
        $datos['ingreso_productos'] = $this->ingresoProductos($fecha_inicio, $fecha_fin);
        $datos['ingresos_granel'] = $this->ingresosGranel($fecha_inicio, $fecha_fin);
        $datos['productos_ingresos_ventas'] = $this->productosIngresosVentas($fecha_inicio, $fecha_fin);
        $datos['efectivo_arqueo'] = isset($this->efectivoArqueo(date('Y-m-d', strtotime($fecha_inicio)))['efectivo_arqueo']) ? $this->efectivoArqueo(date('Y-m-d', strtotime($fecha_inicio)))['efectivo_arqueo'] : 0;
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
            ->orderBy('total_vendido', 'DESC') // Ordena por el total vendido (de mayor a menor)
            ->orderBy('producto_nombre', 'ASC')  // Si las cantidades son iguales, ordena por nombre alfabéticamente
            ->limit(10) // Limita a los 10 productos más vendidos
            ->findAll();

        return $resultado;
    }
    // esta funcio devuelve el costo total de los productos vendidos en el rango de fechas
    function costoProductosVendidos($fecha_inicio, $fecha_fin)
    {
        $modelo_ventas = new VentasModel();
        $resultado = $modelo_ventas
            ->select('SUM(ventas.costo * ventas.cantidad) AS total_costo')
            ->where('ventas.created_at >=', $fecha_inicio)
            ->where('ventas.created_at <=', $fecha_fin)
            ->first();
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
    function cantidad_ventas($fecha_inicio, $fecha_fin)
    {
        $modelo_ventas = new VentasModel();
        $resultado = $modelo_ventas->select('COUNT(DISTINCT(numero_venta)) AS cantidad_ventas')
            ->where('ventas.created_at >=', $fecha_inicio)
            ->where('ventas.created_at <=', $fecha_fin)
            ->first();
        return $resultado;
    }
    function cantidad_articulos_vendidos($fecha_inicio, $fecha_fin)
    {
        $modelo_ventas = new VentasModel();
        $resultado = $modelo_ventas->select('SUM(cantidad) AS cantidad_articulos_vendidos')
            ->where('ventas.created_at >=', $fecha_inicio)
            ->where('ventas.created_at <=', $fecha_fin)
            ->first();
        return $resultado;
    }
    // Esta funcion nos da un array con los productos que tienen poco inventario < 5
    function inventarioUnitarioBajo()
    {
        $modelo_productos = new ProductosModel();
        $resultado = $modelo_productos->where('productos.cantidad_total <= minimo')->findAll();
        return $resultado;
    }
    function inventarioGranelBajo()
    {
        $modelo_productos_granel = new ProductosGranelModel();
        $resultado = $modelo_productos_granel->where('productos_granel.cantidad_total <= minimo')->findAll();
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
    // esta funcion devuelve un array con todos los productos, total de ingresos del producto y total de ventas del producto en el rango de fechas
    function productosIngresosVentas($fecha_inicio, $fecha_fin)
    {
        $modelo_productos = new ProductosModel();
        $resultado = $modelo_productos
            ->select('productos.nombre AS producto_nombre, SUM(ingresos.cantidad) AS total_ingresos, SUM(ventas.cantidad) AS total_ventas')
            ->join('ingresos', 'ingresos.producto_id = productos.id', 'left')
            ->join('ventas', 'ventas.producto_id = productos.id', 'left')
            ->where('ingresos.created_at >=', $fecha_inicio)
            ->where('ingresos.created_at <=', $fecha_fin)
            ->orWhere('ventas.created_at >=', $fecha_inicio)
            ->orWhere('ventas.created_at <=', $fecha_fin)
            ->groupBy('productos.id')
            ->findAll();
        return $resultado;
    }

    function ingresosGranel($fecha_inicio, $fecha_fin)
    {
        $modelo_ingresos_granel = new IngresosGranelModel();
        $resultado = $modelo_ingresos_granel
            ->select('productos_granel.nombre AS producto_granel_nombre, cantidad, tipo_movimiento')
            ->join('productos_granel', 'productos_granel.id = ingresos_granel.producto_id')
            ->where('ingresos_granel.created_at >=', $fecha_inicio)
            ->where('ingresos_granel.created_at <=', $fecha_fin)
            ->findAll();
        return $resultado;
    }
    function efectivoArqueo($fecha_hoy)
    {
        $modelo_cierres = new CierreposModel();
        $resultado = $modelo_cierres
            ->select('efectivo_arqueo')
            ->where('updated_at >=', $fecha_hoy . ' 00:00:00')
            ->where('updated_at <=', $fecha_hoy . ' 23:59:59')
            ->orderBy('updated_at', 'DESC')
            ->first();
        return $resultado;
    }
}
