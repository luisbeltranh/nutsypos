<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\ProductosModel;
use App\Models\MovimientosModel;
use App\Models\VentasModel;
use App\Models\IngresosModel;
use App\Models\UtilModel;
use App\Models\IngresosGranelModel;

class Inventario extends BaseController
{
    function index($ordenar = null) //verInventario
    {
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }

        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Inventario";
        $datos['menu_activo'] = "inventario";
        $datos['orden_lista'] = $ordenar;
        $datos['productos'] = $this->saldoInventario($ordenar);
        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        echo view('dashboard/ver_inventario');
        echo view('dashboard/templates/footer');
    }

    function formIngreso($producto_id)
    {
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }

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
        //$datos['fecha_hoy'] = date('Y-m-d\TH:i');
        if ($numero_ingreso != null) {
            $datos['numero_ingreso'] = $numero_ingreso['numero_ingreso'] + 1;
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
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }

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
                'created_at' => [],
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
    function verIngresos()
    {
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }
        $modelo_veringresos = new IngresosModel();
        $ingresos = $modelo_veringresos->select('ingresos.id, numero_ingreso, productos.nombre, cantidad, monto, total, users.username, ingresos.created_at')->join('users', 'users.id = ingresos.user_id')->join('productos', 'productos.id = ingresos.producto_id')->orderBy('created_at', 'DESC')->findAll();
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Ver Ingresos";
        $datos['menu_activo'] = "veringresos";
        $datos['ingresos'] = $ingresos;
        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        echo view('dashboard/ver_ingresos');
        echo view('dashboard/templates/footer');
    }
    public function verIngresosGranel()
    {
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }
        $modelo_ingreso_granel = new IngresosGranelModel();
        $ingresos = $modelo_ingreso_granel->select('numero_ingreso, producto_id, productos_granel.nombre, cantidad, monto, total, users.username, ingresos_granel.created_at')
        ->join('users', 'users.id = ingresos_granel.user_id')
        ->join('productos_granel', 'productos_granel.id = ingresos_granel.producto_id')
        ->orderBy('created_at', 'DESC')
        ->findAll();
        // echo "<pre>";
        // print_r($ingresos);
        // echo "</pre>";
        // die();
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Ver Ingresos";
        $datos['menu_activo'] = "veringresos";
        $datos['ingresos'] = $ingresos;
        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        echo view('dashboard/ver_ingresos_granel');
        echo view('dashboard/templates/footer');
    }
    function conteoInventario()
    {
        helper('form');
        $funciones =  new UtilModel();

        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Inventario";
        $datos['menu_activo'] = "inventario";
        $datos['productos'] = $funciones->listarInventario();
        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        echo view('dashboard/ver_conteo_inventario');
        echo view('dashboard/templates/footer');
    }
    private function saldoInventario($ordenar = null)
    {
        $modelo_productos = new ProductosModel();
        $productos = $modelo_productos->findAll();
        $modelo_ventas = new VentasModel();
        $ventas = $modelo_ventas->select('producto_id, cantidad, nombre, descripcion, categoria, tamano, monto, costo, precio_venta, ventas.updated_at, producto_embolsado')->join('productos', 'productos.id = ventas.producto_id')->orderBy('categoria, nombre')->where('productos.deleted_at', null)->findAll();
        // echo "<pre>";
        // print_r($ventas);
        // echo "</pre>";
        // die();
        $ventas_array = $this->sumarArray($ventas, -1);
        $modelo_ingresos = new IngresosModel();
        $ingresos = $modelo_ingresos->select('producto_id, cantidad, nombre, descripcion, categoria, tamano, monto, costo, precio_venta, ingresos.updated_at, producto_embolsado')->join('productos', 'productos.id = ingresos.producto_id')->orderBy('categoria, nombre')->where('productos.deleted_at', null)->findAll();
        $ingresos_array = $this->sumarArray($ingresos, 1);
        $total_array = array_merge_recursive($ventas_array, $ingresos_array);
        $suma_total = $this->sumarArray($total_array, 1);
        // seleccionamos la columna categoria de nuestro array multidimensional
        $array_nombre = array_column($suma_total, 'nombre');
        $array_catagoria = array_column($suma_total, 'categoria');
        $array_tamano = array_column($suma_total, 'tamano');
        $array_cantidad = array_column($suma_total, 'cantidad');
        // ordenamos el array suma_total con el orden del array catogoria        
        //array_multisort($array_catagoria, $array_tamano, $array_nombre, $suma_total, SORT_ASC);
        if ($ordenar == 'nombre' || $ordenar == NULL) {
            array_multisort($array_catagoria, $array_nombre, SORT_NATURAL, $suma_total);
        }
        if ($ordenar == 'invmenos') {
            array_multisort($array_cantidad, $array_catagoria, $array_nombre, $suma_total, SORT_DESC);
        }
        if ($ordenar == 'invmas') {
            array_multisort($array_cantidad, SORT_DESC, $suma_total);
        }

        //array_multisort($array_cantidad, $suma_total);
        return $suma_total;
?>
        <pre>
        <?php
        // print_r($suma_total);


        // echo 'ventas_array';
        // print_r($ventas_array);
        //echo '<hr>';
        // echo 'ingresos_array';
        //print_r($suma_total);
        // echo '<hr>';
        // echo 'array_merge';
        // print_r(array_merge_recursive($ventas_array, $ingresos_array));
        // echo '<hr>';
        // echo 'suma total';
        // print_r($suma_total);
        // echo '<hr>';
        // echo 'suma total';
        // print_r($suma_total);
        // echo '<hr>';
        ?>
        </pre>
<?php
        //        die();
    }
    function sumarArray($array_datos, $factor)
    {
        $datos = array();
        $result = array();
        $suma = 0;
        $resultado = array();
        foreach ($array_datos as $element) {
            $result[$element['producto_id']]['categoria'][] = $element['categoria'];
            $result[$element['producto_id']]['nombre'][] = $element['nombre'];
            $result[$element['producto_id']]['tamano'][] = $element['tamano'];
            $result[$element['producto_id']]['monto'][] = $element['monto'];
            $result[$element['producto_id']]['costo'][] = $element['costo'];
            $result[$element['producto_id']]['cantidad'][] = $element['cantidad'];
            $result[$element['producto_id']]['total'][] = $element['cantidad'] * $element['costo'];
            $result[$element['producto_id']]['producto_embolsado'][] = $element['producto_embolsado'];
            // $result[$element['producto_id']]['updated_at'][] = $element['updated_at'];
        }
        $inter = 0;
        $monto_total = 0;
        foreach ($result as $key => $vector) {
            $datos[$inter]['producto_id'] = $key;
            $datos[$inter]['categoria'] = $vector['categoria'][0];
            $datos[$inter]['nombre'] = $vector['nombre'][0];
            $datos[$inter]['tamano'] = $vector['tamano'][0];
            $datos[$inter]['cantidad'] = $factor * array_sum($vector['cantidad']);
            $datos[$inter]['monto'] = array_sum($vector['monto']) / count($vector['monto']);
            $datos[$inter]['costo'] = array_sum($vector['costo']) / count($vector['costo']);
            $datos[$inter]['total'] = number_format(array_sum($vector['total']), 2);
            $datos[$inter]['producto_embolsado'] = $vector['producto_embolsado'][0];

            $inter++;
            $monto_total += array_sum($vector['total']);
        }
        return $datos;
    }
}
