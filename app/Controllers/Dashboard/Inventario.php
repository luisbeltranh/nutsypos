<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\ProductosModel;
use App\Models\MovimientosModel;
use App\Models\VentasModel;
use App\Models\IngresosModel;

class Inventario extends BaseController
{
    function index() //verInventario
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
        $this->saldoInventario();

        //echo view('dashboard/dashboard');
        echo view('dashboard/templates/footer');
    }

    function formIngreso($producto_id)
    {
        helper('form');
        $modelo_ingresos = new IngresosModel();
        $modelo_productos = new ProductosModel();
        $producto = $modelo_productos->find($producto_id);
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Ingreso";
        $datos['menu_activo'] = "agregar_ingreso";
        $datos['producto'] = $producto;

        $modeloVentas = new VentasModel();
        $numero_ingreso = $modelo_ingresos->select('numero_ingreso')->orderBy('numero_ingreso', 'desc')->first();
        $datos['estaLogeado'] = auth()->loggedIn();
        if ($numero_ingreso != null) {
            $datos['numero_ingreso'] = $numero_ingreso['numero_venta'] + 1;
        } else {
            $datos['numero_ingreso'] = 0;
        }


        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        echo view('dashboard/nuevo_ingreso');
        echo view('dashboard/templates/footer');
    }


    function guardarIngreso()
    {
        helper('form');
        $modelo_ingresos = new IngresosModel();
        $modelo_productos = new ProductosModel();
        if ($this->request->getMethod() == 'POST') {
            $rules = [
                'numero_ingreso' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Categoría" es requerido',
                    ]
                ],
                'producto_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Producto ID" es requerido',
                    ]
                ],
                'monto' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Monto" es requerido',
                    ]
                ],
                'cantidad' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Cantidad" es requerido',
                    ]
                ],
                'total' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Total" es requerido',
                    ]
                ],
                'user_id' => [],
            ];

            $producto_id = $modelo_ingresos->orderBy('id', 'desc')->first();
            $data = $this->request->getPost(array_keys($rules));
            $data['total'] = $data['cantidad'] * $data['monto'];
            if ($this->validateData($data, $rules)) {
                $validData = $this->validator->getValidated();
                $modelo_ingresos->insert($validData);
                return redirect()->to('/dashboard/verinventario');
            }
            // return redirect()->to('/dashboard/new_link')->withInput();
            //return redirect()->back()->withInput();
        }
    }


    private function saldoInventario()
    {
        $modelo_productos = new ProductosModel();
        $productos = $modelo_productos->findAll();
        $modelo_ventas = new VentasModel();
        $ventas = $modelo_ventas->join('productos', 'productos.id = ventas.producto_id')->orderBy('categoria, nombre')->findAll();
        $modelo_ingresos = new IngresosModel();
        $ingresos = $modelo_ingresos->join('productos', 'productos.id = ingresos.producto_id')->orderBy('categoria, nombre')->findAll();
?>
        <pre>
        <?php
        print_r($productos);
        echo '<hr>';
        print_r($ventas);
        echo '<hr>';
        print_r($ingresos);


        ?>
        </pre>
<?php

    }
}
