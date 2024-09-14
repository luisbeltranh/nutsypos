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
        $ventas = $modelo_ventas->select('producto_id, cantidad, nombre, descripcion, categoria, monto, precio_venta, ventas.updated_at')->join('productos', 'productos.id = ventas.producto_id')->orderBy('categoria, nombre')->findAll();
        $nuevo_array = $this->sumarArray($ventas);

        foreach ($ventas as $key => $venta) {
        }
        print_r($nuevo_array);
        echo '<br>';

        $modelo_ingresos = new IngresosModel();
        $ingresos = $modelo_ingresos->select('producto_id, cantidad, nombre, descripcion, categoria, monto, precio_venta, ingresos.updated_at')->join('productos', 'productos.id = ingresos.producto_id')->orderBy('categoria, nombre')->findAll();
?>
        <pre>
        <?php
        // print_r($productos);
        // echo '<hr>';
        //print_r($ventas);
        // echo '<hr>';
        // print_r($ingresos);
        ?>
        </pre>
<?php

    }
    function sumarArray($array_datos)
    {
        $result = array();
        $suma = 0;
        $resultado = array();
        foreach ($array_datos as $element) {
            $result[$element['producto_id']]['nombre'][] = $element['nombre'];
            $result[$element['producto_id']]['monto'][] = $element['monto'];
            $result[$element['producto_id']]['cantidad'][] = $element['cantidad'];
            $result[$element['producto_id']]['total'][] = $element['cantidad'] * $element['monto'];
            $result[$element['producto_id']]['created_at'][] = $element['created_at'];
        }
        $inter = 0;
        $monto_total = 0;
        foreach ($result as $key => $vector) {
            $datos['ventas'][$inter]['producto_id'] = $key;
            $datos['ventas'][$inter]['nombre'] = $vector['nombre'][0];
            $datos['ventas'][$inter]['cantidad'] = array_sum($vector['cantidad']);
            $datos['ventas'][$inter]['monto'] = array_sum($vector['monto']) / count($vector['monto']);
            $datos['ventas'][$inter]['total'] = array_sum($vector['total']);
            $inter++;
            $monto_total += array_sum($vector['total']);
        }
    }
}
