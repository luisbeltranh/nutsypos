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

class Embolsado extends BaseController
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
        $datos['titulo_breadcrumbs'] = "Inventario Granel";
        $datos['menu_activo'] = "dashboard";
        $modelo_embolsados = new EmbolsadosModel();
        $datos['embolsados'] = $modelo_embolsados->findAll();
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

    function nuevo()
    {
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }

        helper('form');
        $modelo_producto_granel = new ProductosGranelModel();
        $modelo_producto = new ProductosModel();

        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Ingreso Granel";
        $datos['menu_activo'] = "agregar_ingreso_granel";
        $datos['productos'] = $modelo_producto->findAll();
        $datos['productos_granel'] = $modelo_producto_granel->findAll();
        $datos['estaLogeado'] = auth()->loggedIn();
        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        // echo '<pre>';
        // echo 'productos granel';
        // print_r($datos['productos_granel']);
        // echo '<br>';
        // echo 'productos';
        // print_r($datos['producto']);
        // echo '</pre>';
        echo view('dashboard/nuevo_embolsado');
        // echo view('dashboard/templates/footer_nuevo_embolsado');
    }
    function obtenerComposicion($producto_id = null)
    {
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }
        $modelo_composicion = new ComposicionEmbolsadosModel();
        if ($producto_id) {
            $composicion = $modelo_composicion->select('composicion_embolsados.cantidad_granel_por_bolsa, productos_granel.id as producto_granel_id, productos_granel.nombre as nombre_granel')
                ->where('producto_embolsado_id', $producto_id)
                ->join('productos_granel', 'productos_granel.id = composicion_embolsados.producto_granel_id')
                ->findAll();
            return $this->response->setJSON($composicion);
        }
        return $this->response->setJSON([]);
    }
}
