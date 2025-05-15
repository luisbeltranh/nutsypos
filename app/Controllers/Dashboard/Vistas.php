<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\ProductosModel;
use App\Models\MovimientosModel;
use App\Models\VentasModel;
use App\Models\IngresosModel;

class Vistas extends BaseController
{
    public function index() {}
    public function vistaVentasHoyHoras()
    {
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }
        helper('form');
        $modelo = new VentasModel();
        $fecha_hoy = date('Y-m-d');
        $fecha_inicio = date('Y-m-d 00:00:00');
        $fecha_fin = date('Y-m-d 23:59:59');
        if ($this->request->getMethod() == 'POST') {
            $data = $this->request->getPost('fecha');
            $fecha_inicio = date('Y-m-d 00:00:0', strtotime($data));
            $fecha_fin = date('Y-m-d 23:59:59', strtotime($data));
        }
        $ventasPorHora = $modelo->select('HOUR(ventas.created_at) AS horaventa, SUM(total) as ventatotal')->where('ventas.created_at BETWEEN "' . $fecha_inicio . '" AND "' . $fecha_fin . '"')->join('productos', 'productos.id = ventas.producto_id')->groupBy('HOUR(ventas.created_at)')->findAll();
        $array_monto_horas = [];
        $contador_fin = count($ventasPorHora);
        for ($contador_hora = 0; $contador_hora < 24; $contador_hora++) {
            $monto = 0;
            for ($contador_array = 0; $contador_array < $contador_fin; $contador_array++) {
                if ($ventasPorHora[$contador_array]['horaventa'] == $contador_hora) {
                    $monto = $ventasPorHora[$contador_array]['ventatotal'];
                }
            }
            $hora_del_dia = $contador_hora;
            array_push($array_monto_horas, floatval($monto));
        }
        $datos['fecha_hoy'] = date('Y-m-d');
        $datos['montos_lista'] = json_encode($array_monto_horas);
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Ventas por Hora";
        $datos['menu_activo'] = "vistaventashoyhoras";
        $datos['ventas_por_hora'] = $ventasPorHora;
        echo view('dashboard/templates/graph_head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        echo view('dashboard/venta_horas');
        echo view('dashboard/templates/graph_footer');
    }
    public function informeDiario()
    {
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }
        helper('form');
        $modelo_ventas = new VentasModel();
        $fecha_hoy = date('Y-m-d');
        $fecha_inicio = date('Y-m-d 00:00:00');
        $fecha_fin = date('Y-m-d 23:59:59');
        if ($this->request->getMethod() == 'POST') {
            $data = $this->request->getPost('fecha');
            $fecha_inicio = date('Y-m-d 00:00:0', strtotime($data));
            $fecha_fin = date('Y-m-d 23:59:59', strtotime($data));
        }
        $datos['ventas_total'] = $modelo_ventas->ventasTotal($fecha_inicio, $fecha_fin);

        $datos['fecha_hoy'] = date('Y-m-d');
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Ventas por Hora";
        $datos['menu_activo'] = "vistaventashoyhoras";
        echo view('dashboard/templates/graph_head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        echo view('dashboard/informe_diario');
        echo view('dashboard/templates/footer');
        
    }
}
