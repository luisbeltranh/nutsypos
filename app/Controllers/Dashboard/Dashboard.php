<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\ProductosModel;
use App\Models\MovimientosModel;
use App\Models\VentasModel;
use App\Models\IngresosModel;
use App\Models\ProductosGranelModel;
use App\Models\UtilModel;
use App\Models\GastosModel;
use App\Models\FormasPagoModel;
use App\Models\CierreposModel;
use CodeIgniter\Database\RawSql; // Importa RawSql para operaciones directas en SQL

class Dashboard extends BaseController
{
    public function index()
    {
        $productos_model = new ProductosModel();
        $cantidad_productos = $productos_model->countAllResults();
        $ventas_model = new VentasModel();
        $gastos_model = new GastosModel();
        //$cantidad_ventas = $ventas_model->countAllResults();

        $fecha_inicio = date('Y-m-d 00:00:00');
        $fecha_fin = date('Y-m-d 23:59:59');
        $cantidad_ventas = $ventas_model->where('ventas.created_at BETWEEN "' . $fecha_inicio . '" AND "' . $fecha_fin . '"')->countAllResults();
        $total_ventas = $ventas_model->selectSum('total')->where('ventas.created_at BETWEEN "' . $fecha_inicio . '" AND "' . $fecha_fin . '"')->findAll();
        $total_gastos_hoy = $gastos_model->gasto_total_hoy($fecha_inicio, $fecha_fin);
        $ventas_efectivo_hoy = $ventas_model->ventasFormaPago($fecha_inicio, $fecha_fin, 1);
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
        $datos['total_ventas'] = $total_ventas[0]['total'];
        $datos['total_gastos'] = $total_gastos_hoy;
        $datos['total_caja'] = number_format((float)($ventas_efectivo_hoy - $total_gastos_hoy), 2, '.', '');
        // venta en efectivo '1'
        $datos['ventas_efectivo'] = $ventas_efectivo_hoy;
        // venta por qr '2'
        $datos['ventas_qr'] = $ventas_model->ventasFormaPago($fecha_inicio, $fecha_fin, 2);
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

        //$numeroVenta = date('YmdHis') . rand(1000, 9999); // Ejemplo: Generar un número de venta simple

        // Obtener la marca de tiempo actual con microsegundos
        // $timestamp = microtime(true);
        // // Formatear el ID único combinando la marca de tiempo y el ID de la caja
        $idUsuario = auth()->getUser()->id;
        // $numeroVenta = $userId . '-' . str_replace('.', '', $timestamp);
        $datos['numero_venta'] = $this->generarNumeroUnicoPOS($idUsuario);


        $productos_nombre = array_column($productos, 'nombre');
        $productos_categoria = array_column($productos, 'categoria');
        $productos_tamano = array_column($productos, 'tamano');
        //array_multisort($productos_categoria, $productos_tamano, $productos_nombre, $productos);
        array_multisort($productos_categoria, $productos_nombre, SORT_NATURAL, $productos);
        $datos['productos'] = $productos;
        $formas_pago = new FormasPagoModel();
        $formas_pago = $formas_pago->findAll();
        $datos['formas_pago'] = $formas_pago;
        // echo '<pre>'; 17529797249487
        // print_r($datos['productos']);
        // echo '</pre>';
        // die();
        // if ($numero_venta != null) {
        //     $datos['numero_venta'] = $numero_venta['numero_venta'] + 1;
        // } else {
        //     $datos['numero_venta'] = 0;
        // }


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
        $productos = $modelo->withDeleted()->findAll();
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Productos";
        $datos['menu_activo'] = "productos";
        $productos_nombre = array_column($productos, 'nombre');
        $productos_categoria = array_column($productos, 'categoria');
        $productos_tamano = array_column($productos, 'tamano');
        array_multisort($productos_categoria, $productos_nombre, SORT_NATURAL, $productos);
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
                'tamano' => [],
                'tamano_bolsa' => [],
            ];
            //$data son los datos del formulario de ingreso de nuevo producto
            $data = $this->request->getPost(array_keys($rules));
            //seleccionamos el ultimo id de la tabla productos para 
            //obtener el nuevo id del nuevo producto
            //$producto_id = $modelo->orderBy('id', 'desc')->first();
            // NO estamos usando la tabla movimientos porque no podemos validar las 3 tablas y si existe un error
            // no podemos hacer un rollback de las tablas ya cambiadas para que regresen al estado inicial
            //$dato_movimiento['productos_id'] = $producto_id['id'] + 1;
            //$dato_movimiento['tipo'] = '0'; //0 es tipo NUEVO
            //$dato_movimiento['cantidad'] = $data['cantidad'];
            //$dato_movimiento['monto'] = $data['precio_venta'];
            //$dato_movimiento['user_id'] = $data['user_id'];
            // datos para insertar en la tabla de ingresos
            $numero_ingreso = $modelo_ingresos->select('numero_ingreso')->orderBy('numero_ingreso', 'desc')->first();
            if ($numero_ingreso != null) {
                $dato_ingreso['numero_ingreso'] = $numero_ingreso['numero_ingreso'] + 1;
            } else {
                $dato_ingreso['numero_ingreso'] = 1;
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
    function ventaProducto($forma_pago_id = null)
    {
        helper('form'); // Asegúrate de que este helper esté cargado si lo necesitas
        $usuarioId = auth()->getUser()->id; // Obtiene el ID del usuario autenticado

        $modeloProductos = new ProductosModel();
        $modeloVentas = new VentasModel(); // Este modelo debe apuntar a tu tabla de detalle_ventas (ej. 'ventas')

        // --- DEBUG: Log del método de la petición ---
        log_message('debug', 'Request method received in ventaProducto: ' . $this->request->getMethod());

        // Solo procesar peticiones POST
        if (strtolower($this->request->getMethod()) !== 'post') { // Convertir a minúsculas para una comparación robusta
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Método no permitido. Solo se aceptan peticiones POST.'
            ])->setStatusCode(405); // Método no permitido
        }

        // Decodificar los datos JSON enviados desde el frontend
        $data = json_decode(file_get_contents('php://input'), true);

        // Verificar si hay artículos para vender
        if (empty($data)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'No hay artículos en la venta para procesar.'
            ])->setStatusCode(400); // Bad Request
        }

        $db = \Config\Database::connect();
        $db->transStart(); // *** INICIA LA TRANSACCIÓN ***

        try {
            $ventaBatch = []; // Array para el insertBatch de la tabla de ventas (detalle_ventas)
            $productosAActualizar = []; // Array para almacenar productos y cantidades a descontar
            $productosInfo = []; // Para almacenar info del producto (costo) sin re-consultar

            // --- PASO 1: Pre-verificación de stock para todos los artículos ---
            // Esto se hace antes de cualquier operación de DB para asegurar que todo el pedido es válido
            foreach ($data as $valor) {
                $productoId = (int)$valor['id'];
                $cantidadVendida = (int)$valor['cantidad'];

                // Buscar el producto para obtener su stock actual
                $productoActual = $modeloProductos->find($productoId);

                // Si el producto no existe o el stock es insuficiente, lanzar una excepción
                // if (!$productoActual || $productoActual['cantidad_total'] < $cantidadVendida) {
                //     throw new \Exception('Stock insuficiente para el producto: ' . ($productoActual['nombre'] ?? 'ID ' . $productoId) . '. Cantidad disponible: ' . ($productoActual['cantidad_total'] ?? 0) . 'g, Cantidad solicitada: ' . $cantidadVendida . 'g.');
                // }
                if (!$productoActual) {
                    // Si el producto NO existe en la DB, eso sí es un error grave.
                    throw new \Exception('Producto no encontrado en el sistema: ID ' . $productoId);
                }
                // Si el producto existe, permitimos la venta incluso si el stock es 0 o negativo.
                // No hay verificación de stock insuficiente aquí, ya que se permite vender en negativo.
                // Almacenar info del producto para usarla más adelante
                $productosInfo[$productoId] = $productoActual;

                // Acumular la cantidad a descontar por producto (por si un mismo producto aparece varias veces)
                $productosAActualizar[$productoId] = ($productosAActualizar[$productoId] ?? 0) + $cantidadVendida;
            }

            // --- PASO 2: Preparar y registrar los detalles de la venta ---
            // Asumo que 'numero_venta' se genera en el frontend o es un campo de agrupación.
            // Si necesitas un ID de venta principal, deberías insertarlo aquí y obtener el insertID.
            //$numeroVenta = date('YmdHis') . rand(1000, 9999); // Ejemplo: Generar un número de venta simple

            foreach ($data as $valor) {
                $productoId = (int)$valor['id'];
                $cantidadVendida = (int)$valor['cantidad'];
                $precioUnitario = (float)$valor['precio_venta'];
                $costoProducto = (float)($productosInfo[$productoId]['costo'] ?? 0.00); // Obtener el costo del producto
                $numeroVenta = (int)$valor['numero_venta'];

                $ventaBatch[] = [
                    'producto_id'   => $productoId,
                    'numero_venta'  => $numeroVenta, // Usar el número de venta generado
                    'monto'         => $precioUnitario, // Precio unitario del producto
                    'cantidad'      => $cantidadVendida,
                    'total'         => $precioUnitario * $cantidadVendida, // Total por línea de producto
                    'costo'         => $costoProducto, // Costo del producto
                    'forma_pago_id' => $forma_pago_id,
                    'user_id'       => $usuarioId,
                    'fecha_venta'   => date('Y-m-d H:i:s'), // Fecha y hora actual de la venta
                    // ... añade aquí otros campos que tengas en tu tabla de ventas/detalle_ventas
                ];
            }

            // Insertar todos los detalles de la venta en lote
            $modeloVentas->insertBatch($ventaBatch);

            // --- PASO 3: Descontar el stock de los productos en la tabla 'productos' ---
            foreach ($productosAActualizar as $productoId => $cantidadADescontar) {
                $modeloProductos->update($productoId, [
                    // Usa RawSql para realizar la operación matemática directamente en la DB
                    'cantidad_total' => new RawSql("cantidad_total - " . $cantidadADescontar)
                ]);
            }

            $db->transComplete(); // *** COMPLETA LA TRANSACCIÓN (COMMIT o ROLLBACK automático) ***

            // --- PASO 4: Verificar el estado final de la transacción ---
            if ($db->transStatus() === FALSE) {
                // Si transStatus es FALSE, significa que algo falló y la transacción fue revertida automáticamente.
                // Esto podría ser por una restricción de DB, un deadlock, etc.
                log_message('error', 'Transacción de venta fallida: ' . $db->error()['message']);
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Error en la base de datos al procesar la venta. La operación ha sido revertida.'
                ])->setStatusCode(500); // Internal Server Error
            } else {
                // La transacción fue exitosa
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Venta registrada y stock actualizado correctamente.'
                ])->setStatusCode(200); // OK
            }
        } catch (\Exception $e) {
            // Si se lanza una excepción (ej. stock insuficiente, error de validación, etc.)
            $db->transRollback(); // *** REVierte la transacción explícitamente ***
            log_message('error', 'Excepción durante la transacción de venta: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Error al procesar la venta: ' . $e->getMessage()
            ])->setStatusCode(400); // Bad Request (o 500 si es un error inesperado del servidor)
        }

        // helper('form');
        // $usuario['id'] = auth()->getUser()->id;
        // $modeloProductos = new ProductosModel();
        // $modeloVentas = new VentasModel();

        // if ($this->request->getMethod() == 'POST') {
        //     $data = json_decode(file_get_contents('php://input'), true);
        //     $indice = 0;
        //     foreach ($data as $valor) {
        //         $venta[$indice]['producto_id'] = $valor['id'];
        //         $venta[$indice]['numero_venta'] = $valor['numero_venta'];
        //         $venta[$indice]['monto'] = $valor['precio_venta'];
        //         $venta[$indice]['cantidad'] = $valor['cantidad'];
        //         $venta[$indice]['total'] = $valor['precio_venta'] * $valor['cantidad'];
        //         $venta[$indice]['forma_pago_id'] = $forma_pago_id;
        //         $venta[$indice]['user_id'] = $usuario['id'];
        //         $indice++;
        //     }
        //     $modeloVentas->insertBatch($venta);

        //     // print_r($data);
        // }
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
            $result[$element['producto_id']]['costo'][] = $element['costo'];
            $result[$element['producto_id']]['cantidad'][] = $element['cantidad'];
            $result[$element['producto_id']]['total'][] = $element['cantidad'] * $element['monto'];
            $result[$element['producto_id']]['created_at'][] = $element['created_at'];
        }
        $inter = 0;
        $monto_total = 0;
        $costo_total = 0;
        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // die();


        foreach ($result as $key => $vector) {
            $datos['ventas'][$inter]['producto_id'] = $key;
            $datos['ventas'][$inter]['nombre'] = $vector['nombre'][0];
            $datos['ventas'][$inter]['cantidad'] = array_sum($vector['cantidad']);
            $datos['ventas'][$inter]['costo'] = $vector['costo'][0];
            $datos['ventas'][$inter]['monto'] = array_sum($vector['monto']) / count($vector['monto']); //monto es el precio de venta
            $datos['ventas'][$inter]['tcosto'] = array_sum($vector['cantidad']) * $vector['costo'][0];
            $datos['ventas'][$inter]['total'] = array_sum($vector['total']);
            $inter++;
            $monto_total += array_sum($vector['total']);
            $costo_total += array_sum($vector['cantidad']) * $vector['costo'][0];
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
    //     function ver_inventario()
    //     {
    //         $modelo_productos = new ProductosModel();
    //         $productos = $modelo_productos->findAll();
    //         $modelo_ventas = new VentasModel();
    //         $ventas = $modelo_ventas->selectSum('cantidad')->select('producto_id, sum(cantidad * monto) AS canti')->groupBy('producto_id')->findAll();
    //     }
    function editarproducto($producto_id = null)
    {
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }
        helper('form');
        $modelo_producto = new ProductosModel();
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
                'minimo' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Minimo" es requerido',
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
                'producto_embolsado' => [],
                'habilitado' => [],
                'user_id' => [],
                'producto_id' => [],
                'tamano' => [],
                'tamano_bolsa' => [],
            ];

            $data = $this->request->getPost(array_keys($rules));
            if ($this->validateData($data, $rules)) {
                echo 'datos validos';
                $validData = $this->validator->getValidated();
                if (isset($validData['habilitado'])) {
                    $validData['deleted_at'] = null;
                } else {
                    $validData['deleted_at'] = date('Y-m-d H:i:s');
                }
                if (!isset($validData['producto_embolsado'])) {
                    $validData['producto_embolsado'] = 0;
                }
                $modelo_producto->update($validData['producto_id'], $validData);
                return redirect()->to('/dashboard/productos');
            }
            // return redirect()->to('/dashboard/new_link')->withInput();
            //return redirect()->back()->withInput();
        }
        //verificar que el producto que deseamos editar tenga un producto a granel afiliado a este, si es null el programa daria error
        // al no encontrar los datos para rellenar el formulario de edicion, es por eso que nosotros asignamos el valor de '' a id y 
        // el nombre de No tiene producto a Granel al array producto
        // $verificar_producto = $modelo_producto->find($producto_id);
        // if ($verificar_producto['productos_granel_id'] != null) {
        //  $producto = $modelo_producto->find($producto_id);
        // } else {
        //     $producto = $verificar_producto;
        //     $producto['productos_granel_id'] = '';
        //     $producto['nombre_granel'] = 'No tiene producto a Granel';
        // }
        $producto = $modelo_producto->withDeleted()->find($producto_id);
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
        //  echo '<pre>';
        // print_r($producto);
        // echo $producto_id;
        // echo '</pre>';
        echo view('dashboard/editar_producto');
        echo view('dashboard/templates/footer');
    }

    function eliminarProducto($producto_id = null)
    {
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
            $modelo_producto = new ProductosModel();
            $modelo_producto->delete($producto_id);
            return redirect()->to('/dashboard/productos');
        }
        echo $producto_id;
    }
    function verVentasPeriodo()
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
            $data = $this->request->getPost();
            $fecha_hoy = date('Y-m-d', strtotime($fecha_hoy));
            $fecha_inicio = date('Y-m-d 00:00:01', strtotime($data['fecha_inicio']));
            $fecha_fin = date('Y-m-d 23:59:59', strtotime($data['fecha_fin']));
        }
        $ventas = $modelo->select('ventas.id, numero_venta, producto_id, monto, cantidad, total, ventas.user_id, ventas.created_at AS venta_creada,ventas.updated_at, productos.id, categoria, nombre, tamano, productos.costo, precio_venta, productos.created_at, productos.updated_at ')->where('ventas.created_at BETWEEN "' . $fecha_inicio . '" AND "' . $fecha_fin . '"')->join('productos', 'productos.id = ventas.producto_id')->orderBy('ventas.created_at')->findAll();

        // echo '<pre>';
        // print_r($ventas);
        // echo '</pre>';
        //$ventas = $modelo->findAll();
        //$fecha = strtotime('2024-10-01 00:00:00');
        //$fecha = date('Y-m-d', $fecha);
        //echo $fecha;
        $result = array();
        foreach ($ventas as $element) {
            $fecha = strtotime($element['venta_creada']);
            $fecha = date('Y-m-d', $fecha);
            $result[$fecha]['nombre'][] = $element['nombre'];
            $result[$fecha]['precio'][] = $element['monto'];
            $result[$fecha]['costo'][] = $element['costo'];
            $result[$fecha]['cantidad'][] = $element['cantidad'];
            $result[$fecha]['total_precio'][] = $element['cantidad'] * $element['monto'];
            $result[$fecha]['total_costo'][] = $element['cantidad'] * $element['costo'];
            $result[$fecha]['producto_id'][] = $element['producto_id'];
        }
        // echo '<pre>';
        // print_r($result);
        // echo '</pre>';

        $inter = 0;
        $monto_total = 0;
        $costo_total = 0;
        foreach ($result as $key => $vector) {
            $datos['ventas'][$inter]['fecha'] = $key;
            $datos['ventas'][$inter]['nombre'] = $vector['nombre'][0];
            $datos['ventas'][$inter]['cantidad'] = array_sum($vector['cantidad']);
            $datos['ventas'][$inter]['costo'] = $vector['costo'][0];
            $datos['ventas'][$inter]['precio'] = array_sum($vector['precio']) / count($vector['precio']); //monto es el precio de venta
            $datos['ventas'][$inter]['total_costo'] = array_sum($vector['total_costo']);
            $datos['ventas'][$inter]['total_precio'] = array_sum($vector['total_precio']);
            $datos['ventas'][$inter]['ganancia'] = array_sum($vector['total_precio']) - array_sum($vector['total_costo']);
            // echo 'Cantidad:' . array_sum($vector['cantidad']) . 'Costo:' . $vector['costo'][0];
            $inter++;
        }
        if (!isset($datos['ventas'])) {
            $datos['ventas'] = array();            # code...
        }
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Ventas por Periodo";
        $datos['menu_activo'] = "verventasperiodo";
        $datos['fecha_hoy'] = $fecha_hoy;

        //$datos['ventas'] = $ventas;
        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        echo view('dashboard/verventasperiodo');
        echo view('dashboard/templates/footer');
    }
    function verVentasDetalladas()
    {
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }
        helper('form');
        $modelo_ventas = new VentasModel();
        $fecha_hoy = date('Y-m-d');
        $fecha_inicio = date('Y-m-d 00:00:00');
        $fecha_fin = date('Y-m-d 23:59:59');
        if ($this->request->getMethod() == 'POST') {
            $data = $this->request->getPost('fecha');
            $fecha_hoy = date('Y-m-d', strtotime($data));
            $fecha_inicio = date('Y-m-d 00:00:01', strtotime($data));
            $fecha_fin = date('Y-m-d 23:59:59', strtotime($data));
        }
        $formas_pago = new FormasPagoModel();
        $formas_pago = $formas_pago->findAll();
        foreach ($formas_pago as $forma_pago) {
            $datos['venta_forma_nombre'][$forma_pago['id']] = $forma_pago['nombre'];
            $datos['venta_forma_total'][$forma_pago['id']] = $modelo_ventas->ventasFormaPago($fecha_inicio, $fecha_fin, $forma_pago['id']);
        }
        $ventas = $modelo_ventas->obtenerVentas($fecha_inicio, $fecha_fin);
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Ventas Detalladas";
        $datos['menu_activo'] = "verventasdetalladas";
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['ventas'] = $ventas;
        $datos['fecha_hoy'] = $fecha_hoy;
        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        // echo '<pre>';
        // print_r($ventas);
        // echo '</pre>';
        echo view('dashboard/ver_ventas_detalladas');
        echo view('dashboard/templates/footer');
    }
    function verMasVendido()
    {
        $utilitario_model = new UtilModel();
        //$cantidad_ventas = $ventas_model->countAllResults();

        $fecha_inicio_hoy = date('Y-m-d 00:00:00');
        $fecha_fin_hoy = date('Y-m-d 23:59:59');
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
        $datos['productos'] = $utilitario_model->listarMasVendidos('hoy');
        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        echo view('dashboard/ver_mas_vendido');
        echo view('dashboard/templates/footer');
    }
    function nuevoGasto()
    {
        $modelo_gastos = new GastosModel();
        helper('form');
        if ($this->request->getMethod() == 'POST') {
            $rules = [
                'numero_gasto' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Numero de Gasto" es requerido',
                    ]
                ],
                'monto' => [
                    'rules' => 'required|is_natural_no_zero',
                    'errors' => [
                        'required' => 'El campo "Monto" es requerido',
                        'is_natural_no_zero' => 'El campo "Monto" debe ser un numero natural mayor que cero',
                    ]
                ],
                'descripcion' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "Descripcion" es requerido',
                    ]
                ],
                'user_id' => [],
            ];

            $data = $this->request->getPost(array_keys($rules));
            if ($this->validateData($data, $rules)) {
                $validData = $this->validator->getValidated();
                $modelo_gastos->insert($validData);
                return redirect()->to('/dashboard');
            }
            // return redirect()->to('/dashboard/new_link')->withInput();
            //return redirect()->back()->withInput();

        }
        $datos['grupo_usuario'] = auth()->getUser()->getGroups();
        //auth()->getUser()->syncGroups('superadmin', 'admin', 'user');
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }
        $numero_gasto = $modelo_gastos->numero_gasto();
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['id_usuario'] = auth()->getUser()->id;
        $datos['titulo_breadcrumbs'] = "Enlaces";
        $datos['menu_activo'] = "dashboard";
        $datos['numero_gasto'] = $numero_gasto;

        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        echo view('dashboard/nuevo_gasto');
        echo view('dashboard/templates/footer');
    }
    function eliminarVenta($venta_id)
    {
        $modelo_productos = new ProductosModel();
        $modelo_ventas = new VentasModel();
        $venta = $modelo_ventas->find($venta_id);
        $producto = $modelo_productos->find($venta['producto_id']);
        //Actualizar el inventario sumando la cantidad del producto que se elimino de la venta
        $db = \Config\Database::connect();
        $db->transStart(); // *** INICIA LA TRANSACCIÓN ***
        try {
            $modelo_productos->update($producto['id'], [
                // Usa RawSql para realizar la operación matemática directamente en la DB
                'cantidad_total' => new RawSql("cantidad_total + " . $venta['cantidad'])
            ]);
            //Eliminar la venta
            $modelo_ventas->delete($venta_id);

            $db->transComplete(); // *** COMPLETA LA TRANSACCIÓN (COMMIT o ROLLBACK automático) ***
            if ($db->transStatus() === FALSE) {
                // Si transStatus es FALSE, significa que algo falló y la transacción fue revertida automáticamente.
                log_message('error', 'Transacción de eliminación de venta fallida: ' . $db->error()['message']);
                return redirect()->to('/dashboard/verventasdetalladas')->with('error', 'Error al eliminar la venta. La operación ha sido revertida.');
            } else {
                // La transacción fue exitosa
                return redirect()->to('/dashboard/verventasdetalladas')->with('success', 'Venta eliminada y stock actualizado correctamente.');
            }
        } catch (\Exception $e) {
            // Si se lanza una excepción (ej. error de validación, etc.)
            $db->transRollback(); // *** REVierte la transacción explícitamente ***
            log_message('error', 'Excepción durante la transacción de eliminación de venta: ' . $e->getMessage());
            return redirect()->to('/dashboard/verventasdetalladas')->with('error', 'Error al eliminar la venta: ' . $e->getMessage());
        }
    }

    function cerrarPos()
    {
        helper('form');
        $modelo_cierre = new CierreposModel();
        if ($this->request->getMethod() == 'POST') {
            $rules = [
                'total_ventas_registrado' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "VENTAS" es requerido',
                    ]
                ],
                'total_ventas_efectivo' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "PAGOS EN EFECTIVO" es requerido',
                    ]
                ],
                'total_ventas_qr' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "VENTAS POR QR" es requerido',
                    ]
                ],
                'total_gastos' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "GASTOS" es requerido',
                    ]
                ],
                'total_efectivo' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "TOTAL EFECTIVO" es requerido',
                    ]
                ],
                'efectivo_arqueo' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "EFECTIVO ARQUEO" es requerido',
                    ]
                ],
                'arqueo_diferencia' => [],
                'user_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo "ID DE USUARIO" es requerido',
                    ]
                ],
                'validado' => [],
                'guardar_datos' => [],
            ];

            $data = $this->request->getPost(array_keys($rules));
            if ($this->validateData($data, $rules)) {
                $validData = $this->validator->getValidated();
                if (isset($validData['validado'])) {
                    $datos = $validData;
                    $datos['total_ventas_registrado'] = $validData['total_ventas_registrado'];;
                    $datos['total_ventas_efectivo'] = $validData['total_ventas_efectivo'];
                    $datos['total_ventas_qr'] = $datos['total_ventas_qr'];
                    $datos['total_gastos'] = $validData['total_gastos'];
                    $datos['total_efectivo'] = $validData['total_efectivo'];
                    $datos['efectivo_arqueo'] = $validData['efectivo_arqueo'];
                    $datos['arqueo_diferencia'] = $validData['efectivo_arqueo'] - $validData['total_efectivo'];

                    $datos['color_tabla'] = 'table-success';
                    $datos['arqueo_mensaje'] = 'Arqueo de caja realizado correctamente';
                    if ($datos['arqueo_diferencia'] < 0) {
                        $datos['color_tabla'] = 'table-warning';
                        $datos['arqueo_mensaje'] = 'Arqueo de caja realizado con diferencia, FALTA EFECTIVO. Es probable que se haya registrado una venta por demas o no se haya registrado un gasto. Tambien puede haberse registrado una venta por QR como venta en efectivo.';
                    } elseif ($datos['arqueo_diferencia'] > 0) {
                        $datos['color_tabla'] = 'table-info';
                        $datos['arqueo_mensaje'] = 'Arqueo de caja realizado con diferencia, SOBRA EFECTIVO. Es probable que no se haya registrado una venta en el sistema o se registro un gasto de mas. Tambien puede haberse registrado una venta en efectivo como venta por QR.';
                    }

                    if ($datos['arqueo_diferencia'] <> 0) {
                        $datos['color_tabla'] = 'table-danger';
                    }


                    $datos['is_admin'] = false;
                    if (auth()->getUser()->inGroup('admin')) {
                        $datos['is_admin'] = true;
                    }
                    $datos['estaLogeado'] = auth()->loggedIn();
                    $datos['nombreUsuario'] = auth()->getUser()->username;
                    $datos['idUsuario'] = auth()->getUser()->id;
                    $datos['titulo_breadcrumbs'] = "Enlaces";
                    $datos['menu_activo'] = "dashboard";
                    echo view('dashboard/templates/head', $datos);
                    echo view('dashboard/templates/topmenu');
                    echo view('dashboard/templates/sidebar');
                    echo view('dashboard/templates/breadcrumbs');
                    echo view('dashboard/confirmar_cerrarpos');
                    echo view('dashboard/templates/footer');
                } elseif ($validData['guardar_datos'] == 'guardar') {
                    $modelo_cierre->insert($validData);
                    return redirect()->to('/logout');
                }


                // $modelo_producto->update($validData['producto_id'], $validData);
                // return redirect()->to('/dashboard/productos');
            }
            // return redirect()->to('/dashboard/new_link')->withInput();
            //return redirect()->back()->withInput();
        } else {


            $fecha_inicio = date('Y-m-d 00:00:00');
            $fecha_fin = date('Y-m-d 23:59:59');
            $ventas_model = new VentasModel();
            $gastos_model = new GastosModel();
            $datos['total_ventas_hoy'] = $ventas_model->ventasTotal($fecha_inicio, $fecha_fin);
            $datos['total_gastos_hoy'] = $gastos_model->gasto_total_hoy($fecha_inicio, $fecha_fin);
            $datos['total_ventas_qr'] = $ventas_model->ventasFormaPago($fecha_inicio, $fecha_fin, 2);
            $datos['total_ventas_efectivo'] = $ventas_model->ventasFormaPago($fecha_inicio, $fecha_fin, 1);
            $datos['efectivo_arqueo'] = $datos['total_ventas_efectivo'] - $datos['total_gastos_hoy'];
            // echo '<pre>';
            // print_r($datos['ventas_qr']);
            // echo '</pre>';
            // die();
            $datos['is_admin'] = false;
            if (auth()->getUser()->inGroup('admin')) {
                $datos['is_admin'] = true;
            }

            $datos['estaLogeado'] = auth()->loggedIn();
            $datos['nombreUsuario'] = auth()->getUser()->username;
            $datos['idUsuario'] = auth()->getUser()->id;
            $datos['titulo_breadcrumbs'] = "Enlaces";
            $datos['menu_activo'] = "dashboard";
            echo view('dashboard/templates/head', $datos);
            echo view('dashboard/templates/topmenu');
            echo view('dashboard/templates/sidebar');
            echo view('dashboard/templates/breadcrumbs');
            echo view('dashboard/cerrarpos');
            echo view('dashboard/templates/footer');
        }
    }
    function generarNumeroUnicoPOS(int $idUsuario): int
    {
        if ($idUsuario < 0 || $idUsuario > 999) {
            throw new \InvalidArgumentException("El ID debe estar entre 0 y 999.");
        }

        // 1. Timestamp
        $microtime = microtime(true);
        $segundos = floor($microtime);
        $microsegundos = sprintf('%06d', ($microtime - $segundos) * 1000000);

        // 2. Fecha base YYMMDDHHMM (10 dígitos)
        $fechaHora = date('ymdHi', $segundos);

        // 3. Microsegundos (5 dígitos)
        $microParte = substr($microsegundos, 0, 4);

        // 4. ID Usuario (3 dígitos)
        $idParte = str_pad($idUsuario, 3, '0', STR_PAD_LEFT);

        // 5. Concatenar (18 dígitos)
        $numero = $fechaHora . $microParte . $idParte;

        return $numero;
    }
}
