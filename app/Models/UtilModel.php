<?php

namespace App\Models;

use CodeIgniter\Model;

use App\Models\GranelEmbolsadosModel;
use App\Models\IngresosGranelModel;
use App\Models\ProductosModelModel;
use App\Models\ProductosGranelModelModel;
use App\Models\VentasModel;


class UtilModel extends Model
{
    function guardaEmbolsado($data = null)
    {
        $tabla_granel_embolsados = new GranelEmbolsadosModel();
        $tabla_ingresos = new IngresosModel();

        $tabla_productos = new ProductosModel();
        $tabla_productos_granel = new ProductosGranelModel();
        $data_productos = $tabla_productos->find($data['producto_id']);
        $data_productos_granel = $tabla_productos_granel->find($data['producto_granel_id']);


        $numero_ingreso = $tabla_ingresos->select('numero_ingreso')->orderBy('numero_ingreso', 'desc')->first();
        $data_ingreso = [
            'numero_ingreso' => $numero_ingreso['numero_ingreso'] + 1,
            'producto_id' => $data['producto_id'],
            'monto' => $data_productos['costo'],
            'cantidad' => $data['cantidad_embolsado'],
            'total' => $data_productos['costo'] * $data['cantidad_embolsado'],
            'user_id' => $data['user_id'],
        ];

        $data_granel_embolsados = [
            'numero_embolsado' => $data['numero_embolsado'],
            'producto_granel_id' => $data['producto_granel_id'],
            'producto_id' => $data['producto_id'],
            'tipo' => 2,
            'cantidad' => $data['cantidad_granel'],
            'costo' => $data_productos_granel['costo_gramo'],
            'total' => $data_productos_granel['costo_gramo'] * $data['cantidad_granel'],
            'user_id' => $data['user_id'],
        ];



        // $data_granel_embolsados['numero_embolsado'] = $data['numero_embolsado'];
        // $data_granel_embolsados['producto_granel_id'] = $data['producto_granel_id'];
        // $data_granel_embolsados['producto_id'] = $data['producto_id'];
        // $data_granel_embolsados['tipo'] = 2;
        // $data_granel_embolsados['cantidad'] = $data['cantidad_granel'];
        //$data_granel_embolsados['costo'] = $data['costo_granel'];

        $data_granel_embolsados['user_id'] = $data['user_id'];
        //$this->db->table('ingresos')->insert($data_ingreso);

        $this->db->transStart();
        $tabla_ingresos->insert($data_ingreso);
        $tabla_granel_embolsados->insert($data_granel_embolsados);
        $this->db->transComplete();

        print_r($data_productos);
        echo '<br>';
        print_r($data_productos_granel);
        echo '<br>';

        print_r($data_ingreso);
        echo '<br>';
        print_r($data_granel_embolsados);

        return true;
    }
    public function listarMasVendidos($periodo = null, $fecha_inicio = null, $fecha_fin = null)
    {
        $ventas_modelo = new VentasModel();

        switch ($periodo) {
            case 'hoy':
                $fecha_inicio = date('Y-m-d 00:00:00');
                $fecha_fin = date('Y-m-d 23:59:59');
                $ventas = $ventas_modelo->select('producto_id, categoria, nombre, monto, costo, cantidad, total')->where('ventas.created_at BETWEEN "' . $fecha_inicio . '" AND "' . $fecha_fin . '"')->join('productos', 'productos.id = producto_id')->findAll();
                break;

            default:
                $ventas = $ventas_modelo->select('producto_id, categoria, nombre, monto, costo, cantidad, total')->join('productos', 'productos.id = producto_id')->findAll();
                break;
        }
        $suma_ventas = $this->sumarArrayPorClave($ventas, 'producto_id', ['cantidad', 'total'], false);

        $ventas_cantidad = array_column($suma_ventas, 'cantidad');
        array_multisort($ventas_cantidad, SORT_DESC, $suma_ventas);


        // $cantidad_ventas = $ventas_model->where('ventas.created_at BETWEEN "' . $fecha_inicio . '" AND "' . $fecha_fin . '"')->countAllResults();
        // $total_ventas = $ventas_model->selectSum('total')->where('ventas.created_at BETWEEN "' . $fecha_inicio . '" AND "' . $fecha_fin . '"')->findAll();

        $ventasMasVendido = $suma_ventas;
        return $ventasMasVendido;
    }
    function sumarArrayPorClave(array $array, string $Clave, array $suma_campos, bool $invertir_signo = false): array
    {
        $result = [];

        foreach ($array as $item) {
            $key = $item[$Clave]; // El campo por el cual agrupar (por ejemplo, 'id')

            if (isset($result[$key])) {
                // Si la clave ya existe, suma los campos especificados
                foreach ($suma_campos as $field) {
                    if (isset($item[$field])) {
                        $result[$key][$field] += $item[$field];
                    }
                }
            } else {
                // Si la clave no existe, crea una nueva entrada
                $result[$key] = $item; // Copia todos los campos del ítem original
            }
        }

        // Si se solicita invertir el signo, multiplicamos los campos sumados por -1
        if ($invertir_signo) {
            foreach ($result as &$item) {
                foreach ($suma as $field) {
                    if (isset($item[$field])) {
                        $item[$field] *= -1;
                    }
                }
            }
        }

        // Convertir el array asociativo en un array indexado numéricamente (opcional)
        return array_values($result);
    }
}
