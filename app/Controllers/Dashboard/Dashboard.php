<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\ProductosModel;
use App\Models\MovimientosModel;
use App\Models\VentasModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Enlaces";
        $datos['menu_activo'] = "dashboard";
        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        echo view('dashboard/dashboard');
        echo view('dashboard/templates/footer');
    }
    public function pos()
    {
        $modelo = new ProductosModel();
        $productos = $modelo->findAll();
        $modeloVentas = new VentasModel();
        $numero_venta = $modeloVentas->orderBy('numero_venta', 'desc')->first();
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['productos'] = $productos;
        if ($numero_venta != null) {
            $datos['numero_venta'] = $numero_venta['numero_venta'] + 1;
        } else {
            $datos['numero_venta'] = 0;
        }


        echo view('dashboard/pos', $datos);

        // $modelo = new EnlaceModel();
        // $enlaces = $modelo->findAll();
        // $datos['estaLogeado'] = auth()->loggedIn();
        // $datos['nombreUsuario'] = auth()->getUser()->username;
        // $datos['titulo_breadcrumbs'] = "Enlaces";
        // $datos['menu_activo'] = "dashboard";
        // $datos['enlaces'] = $enlaces;
        // echo view('dashboard/templates/head', $datos);
        // echo view('dashboard/templates/topmenu');
        // echo view('dashboard/templates/sidebar');
        // echo view('dashboard/templates/breadcrumbs');
        // echo view('dashboard/links');
        // echo view('dashboard/templates/footer');

    }
    function productos()
    {
        $modelo = new ProductosModel();
        $productos = $modelo->findAll();
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Productos";
        $datos['menu_activo'] = "productos";
        $datos['productos'] = $productos;
        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        echo view('dashboard/productos');
        echo view('dashboard/templates/footer');
    }
    function nuevoproducto()
    {
        helper('form');
        $modelo = new ProductosModel();
        $modeloMovimientos = new MovimientosModel();
        if ($this->request->getMethod() == 'POST') {
            $rules = [
                'categoria' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Categoría" es requerido',
                    ]
                ],
                'nombre' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Nombre" es requerido',
                    ]
                ],
                'descripcion' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Descripcion" es requerido',
                    ]
                ],
                'costo' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Costo" es requerido',
                    ]
                ],
                'precio_venta' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Precio de Venta" es requerido',
                    ]
                ],
                'cantidad' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Cantidad" es requerido',
                    ]
                ],
                'user_id' => [],
            ];

            $producto_id = $modelo->orderBy('id', 'desc')->first();
            $data = $this->request->getPost(array_keys($rules));
            $datoMovimiento['producto_id'] = $producto_id['id'] + 1;
            $datoMovimiento['tipo'] = '0'; //0 es tipo NUEVO
            $datoMovimiento['cantidad'] = $data['cantidad'];
            $datoMovimiento['monto'] = $data['precio_venta'];
            $datoMovimiento['user_id'] = $data['user_id'];
            if ($this->validateData($data, $rules)) {
                $validData = $this->validator->getValidated();
                $modelo->insert($validData);
                $modeloMovimientos->insert($datoMovimiento);
                return redirect()->to('/dashboard/productos');
            }
            // return redirect()->to('/dashboard/new_link')->withInput();
            //return redirect()->back()->withInput();
        }
        $productos = $modelo->findAll();
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Productos";
        $datos['menu_activo'] = "nuevo_producto";
        $datos['productos'] = $productos;
        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        echo view('dashboard/nuevo_producto');
        echo view('dashboard/templates/footer');
    }
    function ventaProducto()
    {
        helper('form');
        $usuario['id'] = auth()->getUser()->id;
        $modelo = new ProductosModel();
        $modeloMovimientos = new VentasModel();

        if ($this->request->getMethod() == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $indice = 0;
            foreach ($data as $valor) {
                $venta[$indice]['producto_id'] = $valor['id'];
                $venta[$indice]['numero_venta'] = $valor['numero_venta'];
                $venta[$indice]['monto'] = $valor['precio_venta'];
                $venta[$indice]['cantidad'] = $valor['cantidad'];
                $venta[$indice]['total'] = $valor['precio_venta'] * $valor['cantidad'];
                $venta[$indice]['user_id'] = $usuario['id'];
                $indice++;
            }
            $modeloMovimientos->insertBatch($venta);
            // print_r($data);
        }
    }
}
