<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\ComposicionEmbolsadosModel;
use App\Models\EmbolsadosModel;
use App\Models\GranelEmbolsadosModel;
use App\Models\ProductosModel;
use App\Models\MovimientosModel;
use App\Models\VentasModel;
use App\Models\IngresosModel;
use App\Models\IngresosGranelModel;
use App\Models\ProductosGranelModel;
use App\Models\VentasGranelModel;
use App\Models\UtilModel;
use App\Models\GastosModel;
use CodeIgniter\I18n\Time;

class Informes extends BaseController
{
    function index($ordenar = null) //verInventarioGRanel
    {
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Registro de Productos Embolsados";
        $datos['menu_activo'] = "dashboard";
        $modelo_embolsados = new EmbolsadosModel();
        $datos['embolsados'] = $modelo_embolsados
            ->select('*, embolsados.created_at AS embolsados_created_at,productos.nombre AS producto_nombre,productos_granel.nombre AS producto_granel_nombre')
            ->join('productos', 'producto_id = productos.id')
            ->join('productos_granel', 'producto_granel_id = productos_granel.id')
            ->findAll();
        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        // echo '<pre>';
        // echo 'index - Ver a Granel';
        // echo '<br>';
        // print_r($datos['productos_granel']);
        // echo '</pre>';
        echo view('dashboard/ver_embolsados_granel');
        echo view('dashboard/templates/footer');
    }
    public function reporteDiario($fecha = null)
    {
        if ($fecha == null) {
            $fecha = date('Y-m-d');
        }
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Informe Diario Resumido";
        $datos['menu_activo'] = "reportediario";
        $modelo_ventas = new VentasModel();
        $datos['ventas'] = $modelo_ventas->obtenerVentas($fecha . ' 00:00:00', $fecha . ' 23:59:59');
        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        echo '<pre>';
        echo 'index - Ver a Granel';
        echo '<br>';
        print_r($datos);
        echo '</pre>';
        echo view('dashboard/templates/footer');
    }
}
