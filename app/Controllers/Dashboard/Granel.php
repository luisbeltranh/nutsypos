<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\GranelEmbolsadosModel;
use App\Models\ProductosModel;
use App\Models\MovimientosModel;
use App\Models\VentasModel;
use App\Models\IngresosModel;
use App\Models\IngresosGranelModel;
use App\Models\ProductosGranelModel;
use App\Models\VentasGranelModel;
use App\Models\UtilModel;

class Granel extends BaseController
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
        $modelo_productos_granel = new ProductosGranelModel();
        $datos['productos_granel'] = $modelo_productos_granel->findAll();
        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        // echo '<pre>';
        // echo 'index - Ver a Granel';
        // echo '<br>';
        // print_r($datos['productos_granel']);
        // echo '</pre>';
        echo view('dashboard/ver_productos_granel');
        echo view('dashboard/templates/footer');
    }

    function formIngresogranel($producto_id)
    {
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }

        helper('form');
        $modelo_ingresos_granel = new IngresosGranelModel();
        $modelo_productos_granel = new ProductosGranelModel();
        $producto_granel = $modelo_productos_granel->find($producto_id);
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Ingreso Granel";
        $datos['menu_activo'] = "agregar_ingreso_granel";
        $datos['producto'] = $producto_granel;
        $numero_ingreso = $modelo_ingresos_granel->select('numero_ingreso')->orderBy('numero_ingreso', 'desc')->first();
        $datos['estaLogeado'] = auth()->loggedIn();
        if ($numero_ingreso != null) {
            $datos['numero_ingreso'] = $numero_ingreso['numero_ingreso'] + 1;
        } else {
            $datos['numero_ingreso'] = 1;
        }
        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        echo view('dashboard/nuevo_ingreso_granel');
        echo view('dashboard/templates/footer');
    }
    function agregarEmbolsadoGranel()
    {
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }

        helper('form');
        $utilitario = new UtilModel();
        $modelo_productos_granel = new ProductosGranelModel();
        $productos_granel = $modelo_productos_granel->findAll();
        $modelo_productos = new ProductosModel();
        $productos = $modelo_productos->findAll();

        if ($this->request->getMethod() == 'POST') {
            $rules = [
                'numero_embolsado' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Número de Embolsado" es requerido',
                    ]
                ],
                'producto_granel_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Debe seleccionar un Producto a Granel',
                    ]
                ],
                'producto_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Debe seleccionar un Producto Embolsado',
                    ]
                ],
                'cantidad_granel' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Cantidad a Granel" es requerido',
                    ]
                ],
                'cantidad_embolsado' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Cantidad de Embolsados" es requerido',
                    ]
                ],
                'user_id' => [],
            ];

            $data = $this->request->getPost(array_keys($rules));
            //$data['total'] = $data['cantidad'] * $data['monto'];
            if ($this->validateData($data, $rules)) {
                $validData = $this->validator->getValidated();
                print_r($validData);
                echo '<br>';
                echo '----------------------------';
                echo '<br>';
                $utilitario->guardaEmbolsado($validData);
                die();
                //$modelo_ingresos->insert($validData);
                // return redirect()->to('/dashboard/verinventario');
            }
        }

        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['menu_activo'] = "agregar_ingreso";
        $datos['productos'] = $productos;
        $datos['productos_granel'] = $productos_granel;
        $modelo_granel_embolsados = new GranelEmbolsadosModel();
        $numero_embolsado = $modelo_granel_embolsados->select('numero_embolsado')->orderBy('numero_embolsado', 'desc')->first();
        if ($numero_embolsado != null) {
            $datos['numero_embolsado'] = $numero_embolsado['numero_embolsado'] + 1;
        } else {
            $datos['numero_embolsado'] = 1;
        }
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['titulo_breadcrumbs'] = "Embolsar Productos de Granel - Embolsado #" . $datos['numero_embolsado'];
        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        echo view('dashboard/embolsado_granel');
        echo view('dashboard/templates/footer');
    }
    function guardarEmbolsadoGranel()
    {
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }
        helper('form');
        $modelo_granel_embolsados = new ProductosGranelModel();
        $modelo_ingresos = new IngresosModel();
        if ($this->request->getMethod() == 'POST') {
            $rules = [
                'numero_embolsado' => [
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
                'producto_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Monto" es requerido',
                    ]
                ],
                'cantidad_granel' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Cantidad a Granel" es requerido',
                    ]
                ],
                'cantidad_embolsado' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Cantidad de Embolsados" es requerido',
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

            $numero_ingreso = $modelo_ingresos->select('numero_ingreso')->orderBy('numero_ingreso', 'desc')->first();
            if ($numero_ingreso != null) {
                $dato_ingreso['numero_ingreso'] = $numero_ingreso['numero_ingreso'] + 1;
            } else {
                $dato_ingreso['numero_ingreso'] = 0;
            }

            //$producto_id = $modelo_ingresos->orderBy('id', 'desc')->first();
            $data = $this->request->getPost(array_keys($rules));
            //$data['total'] = $data['cantidad'] * $data['monto'];
            if ($this->validateData($data, $rules)) {

                $validData = $this->validator->getValidated();
                print_r($validData);
                die();
                //$modelo_ingresos->insert($validData);
                // return redirect()->to('/dashboard/verinventario');
            }
            // return redirect()->to('/dashboard/new_link')->withInput();
            //return redirect()->back()->withInput();
        }
    }


    function guardarIngresoGranel()
    {
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }

        helper('form');
        $modelo_ingresos_granel = new IngresosGranelModel();
        $modelo_productos = new ProductosGranelModel();
        if ($this->request->getMethod() == 'POST') {
            $rules = [
                'numero_ingreso' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Numero de ingreso" es requerido',
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

            //$producto_id = $modelo_ingresos->orderBy('id', 'desc')->first();
            $data = $this->request->getPost(array_keys($rules));
            $data['total'] = $data['cantidad'] * $data['monto'];
            if ($this->validateData($data, $rules)) {
                $validData = $this->validator->getValidated();
                $modelo_ingresos_granel->insert($validData);
                return redirect()->to('/dashboard/verinventariogranel');
            }
            // return redirect()->to('/dashboard/new_link')->withInput();
            //return redirect()->back()->withInput();
        }
    }
    function verProductosGranel()
    {
        $modelo_productos_granel = new ProductosGranelModel();
        $productos_granel = $modelo_productos_granel->findAll();
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Productos a Granel";
        $datos['menu_activo'] = "productos_granel";
        $datos['productos_granel'] = $productos_granel;
        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        echo view('dashboard/ver_productos_granel');
        echo view('dashboard/templates/footer');
    }
    function nuevoproductogranel()
    {
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }
        helper('form');
        $modelo_productos_granel = new ProductosGranelModel();
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
                'costo_gramo' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Costo" es requerido',
                    ]
                ],
                'precio_venta_gramo' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Precio de Venta" es requerido',
                    ]
                ],
                'cantidad_total' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Cantidad Total" es requerido',
                    ]
                ],
                'minimo' => [],
                'user_id' => [],
            ];
            //$data son los datos del formulario de ingreso de nuevo producto
            $data = $this->request->getPost(array_keys($rules));
            if ($this->validateData($data, $rules)) {
                $validData = $this->validator->getValidated();
                $modelo_productos_granel->insert($validData);
                return redirect()->to('/dashboard/verproductosgranel');
            }
            // return redirect()->to('/dashboard/new_link')->withInput();
            //return redirect()->back()->withInput();
        }
        $productos_granel = $modelo_productos_granel->findAll();
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Productos Granel";
        $datos['menu_activo'] = "nuevo_producto";
        $datos['productos'] = $productos_granel;
        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        echo view('dashboard/nuevo_producto_granel');
        echo view('dashboard/templates/footer');
    }

    function editarProductoGranel($id = null)
    {
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }
        helper('form');
        $modelo_productos_granel = new ProductosGranelModel();
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
                'costo_gramo' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Costo" es requerido',
                    ]
                ],
                'precio_venta_gramo' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Precio de Venta" es requerido',
                    ]
                ],
                'producto_granel_id' => [],
                'minimo' => [],
                'user_id' => [],
            ];
            //$data son los datos del formulario de ingreso de nuevo producto
            $data = $this->request->getPost(array_keys($rules));
            if ($this->validateData($data, $rules)) {
                $validData = $this->validator->getValidated();

                $modelo_productos_granel->update($validData['producto_granel_id'], $validData);
                return redirect()->to('/dashboard/verproductosgranel');
            }
            // return redirect()->to('/dashboard/new_link')->withInput();
            //return redirect()->back()->withInput();
        }
        $producto_granel = $modelo_productos_granel->find($id);
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Productos Granel";
        $datos['menu_activo'] = "editar_producto_granel";
        $datos['producto'] = $producto_granel;
        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        echo view('dashboard/editar_producto_granel');
        echo view('dashboard/templates/footer');
    }
    function eliminarProductoGranel($producto_granel_id)
    {
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            echo 'eliminar ' . $producto_granel_id;
            die();
            // $datos['is_admin'] = true;
            // $modelo_productos_granel = new ProductosGranelModel();
            // $modelo_productos_granel->delete($producto_granel_id);
            // return redirect()->to('/dashboard/verproductosgranel');
        }
        echo $producto_granel_id;
    }

    private function saldoInventario($ordenar = null)
    {
        $modelo_productos_granel = new ProductosGranelModel();
        $modelo_granel_embolsados = new GranelEmbolsadosModel();
        $modelo_ventas_granel = new VentasGranelModel();
        $modelo_ingresos_granel = new IngresosGranelModel();
        $embolsados_total = $modelo_granel_embolsados->findAll();
        $ingresos = $modelo_ingresos_granel->select('producto_id, costo_gramo, cantidad, total, categoria, productos_granel.nombre, minimo')->join('productos_granel', 'productos_granel.id = ingresos_granel.producto_id')->orderBy('categoria, nombre')->findAll();
        $ventas = $modelo_ventas_granel->select('producto_id, monto, cantidad, total, categoria, productos_granel.nombre, minimo')->join('productos_granel', 'productos_granel.id = ventas_granel.producto_id')->orderBy('categoria, nombre')->findAll();
        $embolsados = $modelo_granel_embolsados->select('productos_granel.id as producto_id, producto_granel_id, productos_granel.costo_gramo, cantidad, total, categoria, productos_granel.nombre, minimo')->join('productos_granel', 'productos_granel.id = producto_granel_id')->orderBy('categoria, nombre')->findAll();
        // $embolsados = $modelo_granel_embolsados->select('*')->join('productos_granel', 'productos_granel.id = producto_granel_id')->findAll();
        //$prueba = $this->sumaValoresArrayPorId($ingresos, 'producto_id', ['cantidad', 'total'], true);

        $ingresos_array = $this->sumaValoresArrayPorId($ingresos, 'producto_id', ['cantidad', 'total'], false);
        $ventas_array = $this->sumaValoresArrayPorId($ventas, 'producto_id', ['cantidad', 'total'], true);
        $embolsados_array = $this->sumaValoresArrayPorId($embolsados, 'producto_granel_id', ['cantidad', 'total'], true);
        // echo '<pre>';
        // print_r($ingresos_array);
        // echo '<br>';
        // print_r($ventas_array);
        // echo '<br>';
        // print_r($embolsados_array);
        // echo '<br>';

        $total_array = array_merge_recursive($ingresos_array, $ventas_array, $embolsados_array);
        // print_r($total_array);
        // echo '<br>';
        $suma_total = $this->sumaValoresArrayPorId($total_array, 'producto_id', ['cantidad', 'total'], false);
        // echo 'suma total';
        // print_r($suma_total);
        // echo '<br>';
        // echo '</pre>';

        // die();
        // $suma_total = $this->sumarArray($total_array, 1);

        $array_nombre = array_column($suma_total, 'nombre');
        $array_catagoria = array_column($suma_total, 'categoria');
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

        //$productos_granel = $modelo_productos_granel->findAll();

        // echo '<pre>';
        // echo 'Ingresos-';
        // print_r($ingresos);
        // echo 'Embolsados-';
        // print_r($embolsados);
        // echo 'Ventas-';
        // print_r($ventas);
        // echo 'Array-';
        // print_r($total_array);
        // echo 'suma-';
        // print_r($suma_total);

        // die();
        // echo '</pre>';
        // $ventas = $modelo_ventas->select('producto_id, cantidad, nombre, descripcion, categoria, monto, costo, precio_venta, ventas.updated_at')->join('productos', 'productos.id = ventas.producto_id')->orderBy('categoria, nombre')->findAll();
        // $ventas_array = $this->sumarArray($ventas, -1);
        // $modelo_ingresos = new IngresosModel();
        // $ingresos = $modelo_ingresos->select('producto_id, cantidad, nombre, descripcion, categoria, monto, costo, precio_venta, ingresos.updated_at')->join('productos', 'productos.id = ingresos.producto_id')->orderBy('categoria, nombre')->findAll();
        // $ingresos_array = $this->sumarArray($ingresos, 1);
        // $total_array = array_merge_recursive($ventas_array, $ingresos_array);
        // $suma_total = $this->sumarArray($total_array, 1);
        // // seleccionamos la columna categoria de nuestro array multidimensional
        // $array_nombre = array_column($suma_total, 'nombre');
        // $array_catagoria = array_column($suma_total, 'categoria');
        // // ordenamos el array suma_total con el orden del array catogoria        
        // array_multisort($array_catagoria, $array_nombre, $suma_total, SORT_ASC);

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
            $result[$element['producto_id']]['monto'][] = $element['monto'];
            $result[$element['producto_id']]['costo'][] = $element['costo'];
            $result[$element['producto_id']]['cantidad'][] = $element['cantidad'];
            $result[$element['producto_id']]['total'][] = $element['cantidad'] * $element['costo'];
            // $result[$element['producto_id']]['updated_at'][] = $element['updated_at'];
        }
        $inter = 0;
        $monto_total = 0;
        foreach ($result as $key => $vector) {
            $datos[$inter]['producto_id'] = $key;
            $datos[$inter]['categoria'] = $vector['categoria'][0];
            $datos[$inter]['nombre'] = $vector['nombre'][0];
            $datos[$inter]['cantidad'] = $factor * array_sum($vector['cantidad']);
            $datos[$inter]['monto'] = array_sum($vector['monto']) / count($vector['monto']);
            $datos[$inter]['costo'] = array_sum($vector['costo']) / count($vector['costo']);
            $datos[$inter]['total'] = array_sum($vector['total']);
            $inter++;
            $monto_total += array_sum($vector['total']);
        }
        return $datos;
    }


    // Funcion generada por deepseek el 30/01/25 13:30
    function sumaValoresArrayPorId(array $array, string $keyField, array $sumFields, bool $invertSign = false): array
    {
        $result = [];

        foreach ($array as $item) {
            $key = $item[$keyField]; // El campo por el cual agrupar (por ejemplo, 'id')

            if (isset($result[$key])) {
                // Si la clave ya existe, suma los campos especificados
                foreach ($sumFields as $field) {
                    if (isset($item[$field])) {
                        $result[$key][$field] += $item[$field];
                    }
                }
            } else {
                // Si la clave no existe, crea una nueva entrada
                $result[$key] = $item; // Copia todos los campos del ítem original
            }
        }

        // Si se solicita invertir el signo, multiplicamos los campos sumados por -1
        if ($invertSign) {
            foreach ($result as &$item) {
                foreach ($sumFields as $field) {
                    if (isset($item[$field])) {
                        $item[$field] *= -1;
                    }
                }
            }
        }

        // Convertir el array asociativo en un array indexado numéricamente (opcional)
        return array_values($result);
    }
}
