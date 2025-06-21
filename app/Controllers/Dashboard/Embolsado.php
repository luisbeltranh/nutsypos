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
        $datos['embolsados'] = $modelo_embolsados
            ->select('*,productos.nombre AS producto_nombre,productos_granel.nombre AS producto_granel_nombre')
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

    function nuevoEmbolsar($producto_id = null)
    {
        $session = session();
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }

        helper('form');
        $modelo_composicion = new ComposicionEmbolsadosModel();
        $modelo_producto_granel = new ProductosGranelModel();
        $modelo_producto = new ProductosModel();
        $modelo_utilitario = new UtilModel();
        if ($this->request->getMethod() == 'POST') {
            if ($this->request->getPost('confirmar') == 'true') {
                $cantidad = $this->request->getPost('cantidad');
                $cantidad_productos = $this->request->getPost('cantidad_bolsas_producidas');
                $datos_embolsado['producto_id'] = $producto_id;
                $datos_embolsado['composicion'] = $cantidad;
                $datos_embolsado['cantidad_embolsar'] = $cantidad_productos;
                $datos_embolsado['user_id'] = auth()->getUser()->id;
                if ($modelo_utilitario->guardaEmbolsado($datos_embolsado)) {
                    $session->setFlashdata('exito', 'Se ha registrado el embolsado correctamente.');
                    return redirect()->to(base_url('dashboard/verembolsados'));
                } else {
                    $session->setFlashdata('error', 'No se ha podido registrar el embolsado.');
                    return redirect()->to(base_url('dashboard/verembolsados'));
                }

                // foreach ($cantidad as $key => $can) {
                //     echo 'Producto Granel ID = ' . $key . ' -> Cantidad [kg]= -' . $can;
                //     echo '<br>';
                // }
                // echo 'ID de Productos a Agregar -> ' . $producto_id;
                // echo '<br>';
                // echo 'Cantidad de Productos a Agregar = ' . $cantidad_productos;
                // echo '<br>';

                // die();
            }
            $cantidad_productos = $this->request->getPost('cantidad_bolsas_producidas');
            $datos['composicion'] = $modelo_composicion->select('composicion_embolsados.cantidad_por_bolsa, productos_granel.id as producto_granel_id, productos_granel.nombre as nombre_granel')
                ->where('producto_id', $producto_id)
                ->join('productos_granel', 'productos_granel.id = composicion_embolsados.producto_granel_id')
                ->findAll();
            $datos['cantidad_embolsar'] = $cantidad_productos;
            $datos['estaLogeado'] = auth()->loggedIn();
            $datos['nombreUsuario'] = auth()->getUser()->username;
            $datos['idUsuario'] = auth()->getUser()->id;
            $datos['titulo_breadcrumbs'] = "Ingreso Granel";
            $datos['menu_activo'] = "agregar_ingreso_granel";
            $datos['producto'] = $modelo_producto->find($producto_id);
            echo view('dashboard/templates/head', $datos);
            echo view('dashboard/templates/topmenu');
            echo view('dashboard/templates/sidebar');
            echo view('dashboard/templates/breadcrumbs');
            echo view('dashboard/confirmar_embolsado');
            echo view('dashboard/templates/footer');
        } else {
            // Aqui empieza el proceso de embolsado en el sistema
            $datos['estaLogeado'] = auth()->loggedIn();
            $datos['nombreUsuario'] = auth()->getUser()->username;
            $datos['idUsuario'] = auth()->getUser()->id;
            $datos['titulo_breadcrumbs'] = "Ingreso Granel";
            $datos['menu_activo'] = "agregar_ingreso_granel";
            $composicion_producto = $modelo_composicion->select('composicion_embolsados.id, composicion_embolsados.cantidad_por_bolsa, productos_granel.id as producto_granel_id, productos_granel.nombre as nombre_granel')
                ->where('producto_id', $producto_id)
                ->join('productos_granel', 'productos_granel.id = composicion_embolsados.producto_granel_id')
                ->findAll();
            $producto_embolsable = $modelo_producto->find($producto_id);
            if (!empty($composicion_producto)) {
                $datos['existe_composicion'] = true;
            }

            $datos['composicion'] = $composicion_producto;
            $datos['producto'] = $modelo_producto->find($producto_id);

            echo view('dashboard/templates/head', $datos);
            echo view('dashboard/templates/topmenu');
            echo view('dashboard/templates/sidebar');
            echo view('dashboard/templates/breadcrumbs');
            // echo '<pre>';
            // echo 'productos granel';
            // print_r($datos['productos_granel']);
            // echo '<br>';
            // echo 'productos';
            // print_r($datos['composicion']);
            // echo '</pre>';
            echo view('dashboard/nuevo_embolsado');
            echo view('dashboard/templates/footer');
        }
    }
    function obtenerComposicion($producto_id = null)
    {
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }
        $modelo_composicion = new ComposicionEmbolsadosModel();
        if ($producto_id) {
            $composicion = $modelo_composicion->select('composicion_embolsados.cantidad_por_bolsa, productos_granel.id as producto_granel_id, productos_granel.nombre as nombre_granel')
                ->where('producto_id', $producto_id)
                ->join('productos_granel', 'productos_granel.id = composicion_embolsados.producto_granel_id')
                ->findAll();
            return $this->response->setJSON($composicion);
        }
        return $this->response->setJSON([]);
    }
    function agregarEmbolsadoGranel()
    {
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }
        $modelo_productos = new ProductosModel();
        $productos_embolsar = $modelo_productos->select('productos.id, productos.categoria, productos.nombre, productos.producto_embolsado')
            ->where('productos.producto_embolsado', 1)
            ->orderBy('productos.nombre', 'asc')
            ->findAll();

        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Elegir Producto a Embolsar";
        $datos['menu_activo'] = "dashboard";
        $datos['embolsados'] = $productos_embolsar;
        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        // echo '<pre>';
        // echo 'index - Ver a Granel';
        // echo '<br>';
        // print_r($datos['productos_granel']);
        // echo '</pre>';
        echo view('dashboard/ver_productos_embolsar');
        echo view('dashboard/templates/footer');


        // echo '<pre>';
        // echo 'productos granel';
        // print_r($productos_embolsar);
        // echo '</pre>';
        // die();
    }
    function crearComposicion($producto_id = null)
    {
        $session = session();
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }

        helper('form');
        $modelo_composicion = new ComposicionEmbolsadosModel();
        $modelo_producto_granel = new ProductosGranelModel();
        $modelo_producto = new ProductosModel();
        $modelo_utilitario = new UtilModel();
        if ($this->request->getMethod() == 'POST') {
            $rules = [
                'producto_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Numero de ingreso" es requerido',
                    ]
                ],
                'producto_granel_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Producto ID" es requerido',
                    ]
                ],
                'cantidad_por_bolsa' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Monto" es requerido',
                    ]
                ],
                'user_id' => [],
            ];

            //$producto_id = $modelo_ingresos->orderBy('id', 'desc')->first();
            $data = $this->request->getPost(array_keys($rules));
            //$data['total'] = $data['cantidad'] * $data['monto'];
            if ($this->validateData($data, $rules)) {
                $validData = $this->validator->getValidated();
                //                 echo $validData['producto_id'];
                // echo '<br>';
                // echo $validData['producto_granel_id'];
                // echo '<br>';
                // echo $validData['cantidad_por_bolsa'];
                // echo '<br>';
                // echo $validData['user_id'];
                // echo '<br>';
                // die();


                $modelo_composicion->insert($validData);
                return redirect()->to('/dashboard/crear_composicion/' . $validData['producto_id']);
            }
            // return redirect()->to('/dashboard/new_link')->withInput();
            //return redirect()->back()->withInput();
        }



        // Aqui empieza el proceso de embolsado en el sistema
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Crear Composición de Producto Embolsado";
        $datos['menu_activo'] = "agregar_ingreso_granel";
        $datos['productos_granel'] = $modelo_producto_granel->findAll();
        $datos['composicion'] = $modelo_producto
            ->select('composicion_embolsados.id, composicion_embolsados.cantidad_por_bolsa, productos_granel.id as producto_granel_id, productos_granel.nombre as nombre_granel')
            ->where('productos.id', $producto_id)
            ->join('composicion_embolsados', 'composicion_embolsados.producto_id = productos.id')
            ->join('productos_granel', 'productos_granel.id = composicion_embolsados.producto_granel_id')
            ->findAll();
        $datos['producto'] = $modelo_producto->find($producto_id);

        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        // echo '<pre>';
        // echo $producto_id;
        // echo '<br>';
        // echo 'productos granel';
        // print_r($datos['productos_granel']);
        // echo '<br>';
        // echo 'productos';
        // print_r($datos['composicion']);
        // echo '</pre>';
        echo view('dashboard/crear_composicion');
        echo view('dashboard/templates/footer');
    }
}
