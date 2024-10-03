<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\ProductosModel;
use App\Models\MovimientosModel;
use App\Models\VentasModel;
use App\Models\IngresosModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $productos_model = new ProductosModel();
        $cantidad_productos = $productos_model->countAllResults();
        $ventas_model = new VentasModel();
        //$cantidad_ventas = $ventas_model->countAllResults();

        $fecha_inicio = date('Y-m-d 00:00:00');
        $fecha_fin = date('Y-m-d 23:59:59');
        $cantidad_ventas = $ventas_model->where('ventas.created_at BETWEEN "' . $fecha_inicio . '" AND "' . $fecha_fin . '"')->countAllResults();
        $datos['grupo_usuario'] = auth()->getUser()->getGroups();
        //auth()->getUser()->syncGroups('superadmin', 'admin', 'user');
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Enlaces";
        $datos['menu_activo'] = "dashboard";
        $datos['cantidad_productos'] = "$cantidad_productos";
        $datos['cantidad_ventas'] = "$cantidad_ventas";

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
        $productos = $modelo->select('id, categoria, nombre, tamano, costo, precio_venta, cantidad_total')->orderBy('nombre', 'ASC')->findAll();
        $modeloVentas = new VentasModel();
        $numero_venta = $modeloVentas->select('numero_venta')->orderBy('numero_venta', 'desc')->first();
        $datos['estaLogeado'] = auth()->loggedIn();

        $productos_nombre = array_column($productos, 'nombre');
        $productos_categoria = array_column($productos, 'categoria');
        $productos_tamano = array_column($productos, 'tamano');
        array_multisort($productos_categoria, $productos_tamano, $productos_nombre, $productos);

        $datos['productos'] = $productos;

        // echo '<pre>';
        // print_r($datos['productos']);
        // echo '</pre>';
        // die();
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
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }
        $modelo = new ProductosModel();
        $productos = $modelo->findAll();
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Productos";
        $datos['menu_activo'] = "productos";
        $productos_nombre = array_column($productos, 'nombre');
        $productos_categoria = array_column($productos, 'categoria');
        $productos_tamano = array_column($productos, 'tamano');
        array_multisort($productos_categoria, $productos_tamano, $productos_nombre, $productos);
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
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }
        helper('form');
        $modelo = new ProductosModel();
        $modelo_movimientos = new MovimientosModel();
        $modelo_ingresos = new IngresosModel();
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
            $dato_movimiento['productos_id'] = $producto_id['id'] + 1;
            $dato_movimiento['tipo'] = '0'; //0 es tipo NUEVO
            $dato_movimiento['cantidad'] = $data['cantidad'];
            $dato_movimiento['monto'] = $data['precio_venta'];
            $dato_movimiento['user_id'] = $data['user_id'];
            // datos para insertar en la tabla de ingresos
            $numero_ingreso = $modelo_ingresos->select('numero_ingreso')->orderBy('numero_ingreso', 'desc')->first();
            if ($numero_ingreso != null) {
                $datos['numero_ingreso'] = $numero_ingreso['numero_ingreso'] + 1;
            } else {
                $datos['numero_ingreso'] = 0;
            }
            $dato_ingreso['monto'] = $data['costo'];
            $dato_ingreso['cantidad'] = $data['cantidad'];
            $dato_ingreso['total'] = $data['cantidad'] * $data['costo'];
            $dato_ingreso['user_id'] = $data['user_id'];
            // si se validan los datos del formulario se guardan los datos
            // Hay que hacer algo para validar el ingreso a las 3 tablas, caso contrario se deberia realizar un rollback o algo asi para las tablas en las que se realizo el insert
            if ($this->validateData($data, $rules)) {
                $validData = $this->validator->getValidated();
                $modelo->insert($validData);

                $dato_ingreso['producto_id'] = $modelo->getInsertID();

                //$modelo_movimientos->insert($dato_movimiento);
                $modelo_ingresos->insert($dato_ingreso);
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
        $modeloProductos = new ProductosModel();
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
    function verVentas()
    {
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }
        helper('form');
        $modelo = new VentasModel();
        $fecha_hoy = date('Y-m-d');
        $fecha_inicio = date('Y-m-d 00:00:00');
        $fecha_fin = date('Y-m-d 23:59:59');
        if ($this->request->getMethod() == 'POST') {
            $data = $this->request->getPost('fecha');
            $fecha_hoy = date('Y-m-d', strtotime($data));
            $fecha_inicio = date('Y-m-d 00:00:0', strtotime($data));
            $fecha_fin = date('Y-m-d 23:59:59', strtotime($data));
        }
        $ventas = $modelo->where('ventas.created_at BETWEEN "' . $fecha_inicio . '" AND "' . $fecha_fin . '"')->join('productos', 'productos.id = ventas.producto_id')->orderBy('categoria, nombre')->findAll();
        //$ventas = $modelo->findAll();

        $result = array();
        $suma = 0;
        $resultado = array();
        foreach ($ventas as $element) {
            $result[$element['producto_id']]['nombre'][] = $element['nombre'];
            $result[$element['producto_id']]['monto'][] = $element['monto'];
            $result[$element['producto_id']]['cantidad'][] = $element['cantidad'];
            $result[$element['producto_id']]['total'][] = $element['cantidad'] * $element['monto'];
            $result[$element['producto_id']]['created_at'][] = $element['created_at'];
        }
        $inter = 0;
        $monto_total = 0;
        $costo_total = 0;
        foreach ($result as $key => $vector) {
            $datos['ventas'][$inter]['producto_id'] = $key;
            $datos['ventas'][$inter]['nombre'] = $vector['nombre'][0];
            $datos['ventas'][$inter]['cantidad'] = array_sum($vector['cantidad']);
            $datos['ventas'][$inter]['monto'] = array_sum($vector['monto']) / count($vector['monto']);
            $datos['ventas'][$inter]['total'] = array_sum($vector['total']);
            $inter++;
            $monto_total += array_sum($vector['total']);
            $costo_total += array_sum($vector['monto']);
        }
        $datos['monto_total'] = $monto_total;
        $datos['costo_total'] = $costo_total;
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Ventas";
        $datos['menu_activo'] = "verventas";
        $datos['fecha_hoy'] = $fecha_hoy;

        if ($ventas === []) {
            $datos['ventas'] = $ventas;
        }
        //$datos['ventas'] = $ventas;
        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        echo view('dashboard/ventas');
        echo view('dashboard/templates/footer');
    }
    function ver_inventario()
    {
        $modelo_productos = new ProductosModel();
        $productos = $modelo_productos->findAll();
        $modelo_ventas = new VentasModel();
        $ventas = $modelo_ventas->selectSum('cantidad')->select('producto_id, sum(cantidad * monto) AS canti')->groupBy('producto_id')->findAll();
?>
        <pre>
        <?php
        print_r($productos);
        print_r($ventas);

        ?>
        </pre>
<?php
    }
    function editarproducto($producto_id = null)
    {
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }
        helper('form');
        $modelo_producto = new ProductosModel();
        $producto = $modelo_producto->find($producto_id);

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
                'user_id' => [],
                'producto_id' => [],
                'tamano' => [],
            ];

            $data = $this->request->getPost(array_keys($rules));
            if ($this->validateData($data, $rules)) {
                echo 'datos validos';
                $validData = $this->validator->getValidated();
                $modelo_producto->update($validData['producto_id'], $validData);
                return redirect()->to('/dashboard/productos');
            }
            // return redirect()->to('/dashboard/new_link')->withInput();
            //return redirect()->back()->withInput();
        }
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Productos";
        $datos['menu_activo'] = "editar_producto";
        $datos['producto'] = $producto;
        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        echo view('dashboard/editar_producto');
        echo view('dashboard/templates/footer');
    }
}
