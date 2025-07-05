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

class Gastos extends BaseController
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
    public function vergastos()
    {

        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Listas de Gastos";
        $datos['menu_activo'] = "gastos";
        $modelo_gastos = new GastosModel();
        $datos['gastos'] = $modelo_gastos
            ->select('*')
            ->where('created_at >=', date('Y-m-d') . ' 00:00:00')
            ->findAll();
        $fecha = Time::now('America/La_Paz', 'es_ES');
        $datos['fecha'] = $fecha->toLocalizedString('dd - MMMM - yyyy');
        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        // echo '<pre>';
        // echo 'index - Ver a Granel';
        // echo '<br>';
        // print_r($datos['productos_granel']);
        // echo '</pre>';
        echo view('dashboard/ver_gastos');
        echo view('dashboard/templates/footer');
    }
    public function eliminarGasto($id)
    {
        $modelo_gastos = new GastosModel();
        $gasto = $modelo_gastos->find($id);
        if ($gasto) {
            $modelo_gastos->delete($id);
            return redirect()->to('/dashboard/vergastos')->with('success', 'Gasto eliminado correctamente.');
        } else {
            return redirect()->to('/dashboard/vergastos')->with('error', 'Gasto no encontrado.');
        }
    }
    public function editarGasto($id = null)
    {
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }
        $modelo_gastos = new GastosModel();
        helper('form');
        if ($this->request->getMethod() == 'POST') {
            $rules = [
                'monto' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Monto" es requerido',
                    ]
                ],
                'descripcion' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Descripcion" es requerido',
                    ]
                ],
                'gasto_id' => [],
            ];

            $data = $this->request->getPost(array_keys($rules));
            if ($this->validateData($data, $rules)) {
                $validData = $this->validator->getValidated();
                $modelo_gastos->update($validData['gasto_id'], $validData);
                return redirect()->to('/dashboard/vergastos')->with('success', 'Gasto actualizado correctamente.');
            }
            // return redirect()->to('/dashboard/new_link')->withInput();
            //return redirect()->back()->withInput();
        }

        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Editar Gasto";
        $datos['menu_activo'] = "gastos";
        $gasto = $modelo_gastos->find($id);
        if (!$gasto) {
            return redirect()->to('/dashboard/vergastos')->with('error', 'Gasto no encontrado.');
        }
        $datos['gasto'] = $gasto;
        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        echo view('dashboard/editar_gasto');
        echo view('dashboard/templates/footer');
    }
}
