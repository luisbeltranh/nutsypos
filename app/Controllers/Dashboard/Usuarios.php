<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\ProductosModel;
use App\Models\MovimientosModel;
use App\Models\VentasModel;
use App\Models\IngresosModel;

class Usuarios extends BaseController
{
    function index() //verInventario
    {
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Inventario";
        $datos['menu_activo'] = "dashboard";
        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
?>
        <pre>
        <?php
        // echo 'suma total';
        // print_r($datos['productos']);
        // echo '<hr>';
        ?>
        </pre>
<?php
        echo view('dashboard/ver_inventario');
        echo view('dashboard/templates/footer');
    }
    function verUsuarios()
    {
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Ver Usuarios";
        $datos['menu_activo'] = "verusuarios";
        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        //cho view('dashboard/dashboard');
        echo 'Ver Usuarios';
        echo view('dashboard/templates/footer');
    }
}
