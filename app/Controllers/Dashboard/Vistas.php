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
        $fecha_inicio = date('Y-m-d 00:00:00', strtotime("-1 days"));
        $fecha_fin = date('Y-m-d 23:59:59', strtotime("-1 days"));
        if ($this->request->getMethod() == 'POST') {
            $data = $this->request->getPost('fecha');
            $fecha_inicio = date('Y-m-d 00:00:0', strtotime($data));
            $fecha_fin = date('Y-m-d 23:59:59', strtotime($data));
        }
        $ventasPorHora = $modelo->select('HOUR(ventas.created_at), SUM(total)')->where('ventas.created_at BETWEEN "' . $fecha_inicio . '" AND "' . $fecha_fin . '"')->join('productos', 'productos.id = ventas.producto_id')->groupBy('HOUR(ventas.created_at)')->findAll();

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
}
