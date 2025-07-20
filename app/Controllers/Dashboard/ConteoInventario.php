<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\ProductosModel;
use App\Models\IngresosModel;
use App\Models\ConteoInventarioModel;
use App\Models\AjusteInventarioModel;
use App\Models\AjustesResumenModel; // <-- Modelo añadido

class ConteoInventario extends BaseController
{
    protected $productoModel;
    protected $ingresoModel;
    protected $conteoInventarioModel;
    protected $ajusteInventarioModel;
    protected $ajustesResumenModel; // <-- Propiedad añadida

    public function __construct()
    {
        $this->productoModel = new ProductosModel();
        $this->ingresoModel = new IngresosModel();
        $this->conteoInventarioModel = new ConteoInventarioModel();
        $this->ajusteInventarioModel = new AjusteInventarioModel();
        $this->ajustesResumenModel = new AjustesResumenModel(); // <-- Instancia añadida
        helper(['form']);
    }
    /**
     * Muestra la página principal con el historial de ajustes.
     */
    public function index()
    {
        $userId = auth()->id();

        $resumenes = $this->ajustesResumenModel
            ->select('ajustes_resumen.*, users.username') // Shield usa 'username' por defecto
            ->join('users', 'users.id = ajustes_resumen.user_id', 'left')
            ->orderBy('ajustes_resumen.numero_ajuste', 'DESC')
            ->findAll();

        // Verificar si hay un conteo en curso para el usuario actual
        $conteoTemporal = $this->conteoInventarioModel
            ->where('user_id', $userId)
            ->orderBy('created_at', 'ASC')
            ->findAll();

        $conteoEnCurso = !empty($conteoTemporal);

        if ($conteoEnCurso) {
            // Crear una fila virtual para el conteo en curso
            $conteoEnCursoResumen = [
                'numero_ajuste' => 'En curso',
                'fecha_ajuste' => $conteoTemporal[0]['created_at'], // Fecha del primer producto contado
                'username' => auth()->user()->username,
                'total_unidades_diferencia' => '---',
                'total_dinero_diferencia' => '---',
                'en_curso' => true // Bandera especial para la vista
            ];
            // Añadir el conteo en curso al principio del array de resúmenes
            array_unshift($resumenes, $conteoEnCursoResumen);
        }

        $datos['grupo_usuario'] = auth()->getUser()->getGroups();
        //auth()->getUser()->syncGroups('superadmin', 'admin', 'user');
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->id();
        $datos['titulo_breadcrumbs'] = "Ajustes de Inventario";
        $datos['menu_activo'] = "dashboard";

        $datos['titulo'] = 'Historial de Ajustes de Inventario';
        $datos['resumenes'] = $resumenes;
        $datos['conteoEnCurso'] = $conteoEnCurso;


        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs', $datos);
        echo view('dashboard/historial_conteos', $datos);
        echo view('dashboard/templates/footer');
    }


    /**
     * Prepara los datos de los productos para la vista.
     * @return array
     */
    private function _getPreparedProductData()
    {
        $userId = auth()->id();
        $productos = $this->productoModel->findAll();
        $conteosTemporales = $this->conteoInventarioModel->where('user_id', $userId)->findAll();

        $mapaConteos = [];
        foreach ($conteosTemporales as $conteo) {
            $mapaConteos[$conteo['producto_id']] = $conteo['cantidad_contada'];
        }

        foreach ($productos as &$producto) {
            $producto['cantidad_contada'] = $mapaConteos[$producto['id']] ?? '';
            $producto['contado'] = isset($mapaConteos[$producto['id']]);
        }
        return $productos;
    }


    /**
     * Muestra el formulario para realizar un nuevo conteo.
     */
    // public function formularioConteo()
    // {

    //     $datos['grupo_usuario'] = auth()->getUser()->getGroups();
    //     //auth()->getUser()->syncGroups('superadmin', 'admin', 'user');
    //     $datos['is_admin'] = false;
    //     if (auth()->getUser()->inGroup('admin')) {
    //         $datos['is_admin'] = true;
    //     }
    //     $datos['estaLogeado'] = auth()->loggedIn();
    //     $datos['nombreUsuario'] = auth()->getUser()->username;
    //     $datos['idUsuario'] = auth()->id();
    //     $datos['titulo_breadcrumbs'] = "Enlaces";
    //     $datos['menu_activo'] = "dashboard";

    //     $userId = auth()->id(); // Asegúrate de tener el id del usuario en la sesión

    //     // Obtenemos todos los productos
    //     $productos = $this->productoModel->findAll();

    //     // Obtenemos los conteos temporales del usuario actual
    //     $conteosTemporales = $this->conteoInventarioModel->where('user_id', $userId)->findAll();

    //     // Creamos un mapa de conteos para fácil acceso en la vista
    //     $mapaConteos = [];
    //     foreach ($conteosTemporales as $conteo) {
    //         $mapaConteos[$conteo['producto_id']] = $conteo['cantidad_contada'];
    //     }

    //     // Añadimos la información del conteo a cada producto
    //     foreach ($productos as &$producto) {
    //         if (isset($mapaConteos[$producto['id']])) {
    //             $producto['cantidad_contada'] = $mapaConteos[$producto['id']];
    //             $producto['contado'] = true;
    //         } else {
    //             $producto['cantidad_contada'] = '';
    //             $producto['contado'] = false;
    //         }
    //     }

    //     $datos['titulo'] = 'Ajuste de Inventario';
    //     $datos['productos'] = $productos;

    //     echo view('dashboard/templates/head', $datos);
    //     echo view('dashboard/templates/topmenu');
    //     echo view('dashboard/templates/sidebar');
    //     echo view('dashboard/templates/breadcrumbs');
    //     echo view('dashboard/conteo_form'); // La vista principal
    //     echo view('dashboard/templates/footer_conteo_inventario'); // Footer con JS específico
    // }
    //nueva funcion para recargar el formulario de conteo con ajax
    public function formularioConteo()
    {

        $datos['grupo_usuario'] = auth()->getUser()->getGroups();
        //auth()->getUser()->syncGroups('superadmin', 'admin', 'user');
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->id();
        $datos['titulo_breadcrumbs'] = "Enlaces";
        $datos['menu_activo'] = "dashboard";

        $datos['titulo'] = 'Ajuste de Inventario';
        $datos['productos'] = $this->_getPreparedProductData();

        //     $datos = [
        //         'titulo' => 'Nuevo Ajuste de Inventario',
        //         'productos' => $this->_getPreparedProductData()
        //     ];

        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs', $datos);
        echo view('dashboard/conteo_form', $datos);
        echo view('dashboard/templates/footer_conteo_inventario');
    }
    /**
     * NUEVO: Devuelve el cuerpo de la tabla HTML actualizado vía AJAX.
     */
    public function ajaxObtenerTabla()
    {
        if ($this->request->isAJAX()) {
            $datos['productos'] = $this->_getPreparedProductData();
            $html = view('dashboard/_tabla_conteo_body', $datos);
            return $this->response->setJSON(['html' => $html]);
        }
        return redirect()->to('/dashboard');
    }


    /**
     * Guarda o actualiza un conteo temporal. Llamado por AJAX.
     */
    public function guardarConteoTemporal()
    {
        if ($this->request->isAJAX()) {
            $userId = auth()->id();
            $productoId = $this->request->getPost('producto_id');
            $cantidad = $this->request->getPost('cantidad');

            $data = [
                'user_id' => $userId,
                'producto_id' => $productoId,
                'cantidad_contada' => $cantidad
            ];

            // Buscamos si ya existe un conteo para este producto y usuario
            $existe = $this->conteoInventarioModel
                ->where('user_id', $userId)
                ->where('producto_id', $productoId)
                ->first();

            if ($existe) {
                // Si existe, lo actualizamos
                $this->conteoInventarioModel->update($existe['id'], ['cantidad_contada' => $cantidad]);
            } else {
                // Si no existe, lo insertamos
                $this->conteoInventarioModel->insert($data);
            }

            return $this->response->setJSON(['status' => 'success', 'message' => 'Conteo guardado.']);
        }
        return redirect()->to('/dashboard');
    }

    /**
     * Elimina un conteo temporal. Llamado por AJAX.
     */
    public function eliminarConteoTemporal()
    {
        if ($this->request->isAJAX()) {
            $userId = auth()->id();
            $productoId = $this->request->getPost('producto_id');

            $this->conteoInventarioModel
                ->where('user_id', $userId)
                ->where('producto_id', $productoId)
                ->delete();

            return $this->response->setJSON(['status' => 'success', 'message' => 'Conteo eliminado.']);
        }
        return redirect()->to('/dashboard');
    }

    /**
     * Procesa y finaliza el ajuste de inventario.
     */
    public function finalizarAjuste()
    {
        $userId = auth()->id();
        $conteos = $this->conteoInventarioModel->where('user_id', $userId)->findAll();

        if (empty($conteos)) {
            return redirect()->back()->with('error', 'No hay productos contados para ajustar.');
        }

        // Iniciamos una transacción para asegurar la integridad de los datos
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Obtenemos el último número de ajuste y le sumamos 1
            $ultimoAjuste = $this->ajusteInventarioModel->selectMax('numero_ajuste')->first();
            $nuevoNumeroAjuste = ($ultimoAjuste['numero_ajuste'] ?? 0) + 1;

            // **CORRECCIÓN: Obtener el siguiente número de INGRESO (para la tabla de ingresos)**
            $ultimoIngreso = $this->ingresoModel->selectMax('numero_ingreso')->first();
            $nuevoNumeroIngreso = ($ultimoIngreso['numero_ingreso'] ?? 0) + 1;

            // Variables para el resumen
            $totalUnidadesDiferencia = 0;
            $totalDineroDiferencia = 0;

            foreach ($conteos as $conteo) {
                $producto = $this->productoModel->find($conteo['producto_id']);
                if (!$producto) continue;

                $cantidadSistema = $producto['cantidad_total'];
                $cantidadContada = $conteo['cantidad_contada'];
                $diferencia = $cantidadContada - $cantidadSistema;

                $monto = $producto['precio_venta'];
                $totalDiferenciaItem = $monto * $diferencia;

                // Acumulamos los totales para el resumen
                $totalUnidadesDiferencia += $diferencia;
                $totalDineroDiferencia += $totalDiferenciaItem;

                // Solo procesamos si hay una diferencia
                if ($diferencia != 0) {
                    // 1. Actualizamos el stock en la tabla de productos
                    $this->productoModel->update($conteo['producto_id'], ['cantidad_total' => $cantidadContada]);

                    // 2. Registramos el movimiento en la tabla de ingresos
                    $this->ingresoModel->save([
                        'numero_ingreso' => $nuevoNumeroIngreso, // O un número de referencia si lo tienes
                        'producto_id' => $conteo['producto_id'],
                        'monto' => 0, // El ajuste no tiene un costo monetario directo
                        'cantidad' => $diferencia,
                        'total' => 0,
                        'tipo_ingreso' => 'AJUSTE_INVENTARIO', // El nuevo tipo
                        'comentario' => 'Ajuste. Sistema: ' . $cantidadSistema . ', Conteo: ' . $cantidadContada,
                        'fecha_ingreso' => date('Y-m-d H:i:s'),
                        'user_id' => $userId
                    ]);
                }

                // 3. Guardamos el registro histórico del ajuste
                $this->ajusteInventarioModel->save([
                    'numero_ajuste' => $nuevoNumeroAjuste,
                    'producto_id' => $conteo['producto_id'],
                    'cantidad_sistema' => $cantidadSistema,
                    'cantidad_contada' => $cantidadContada,
                    'diferencia' => $diferencia,
                    'total_diferencia' => $totalDiferenciaItem, // Guardamos el detalle
                    'user_id' => $userId
                ]);
            }
            // 3.5 Guardamos el registro de resumen
            $this->ajustesResumenModel->save([
                'numero_ajuste' => $nuevoNumeroAjuste,
                'total_unidades_diferencia' => $totalUnidadesDiferencia,
                'total_dinero_diferencia' => $totalDineroDiferencia,
                'user_id' => $userId
            ]);

            // 4. Limpiamos la tabla de conteo temporal para este usuario
            $this->conteoInventarioModel->where('user_id', $userId)->delete();
            $db->transComplete();

            if ($db->transStatus() === false) {
                return redirect()->back()->with('error', 'Hubo un error al procesar el ajuste.');
            }

            // Redirección actualizada a la nueva página de resultados
            return redirect()->to('/dashboard/conteo-inventario/resultadoAjuste/' . $nuevoNumeroAjuste)
                ->with('success', 'Ajuste de inventario finalizado correctamente.');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Error excepcional: ' . $e->getMessage());
        }
    }
    /**
     * Muestra la página con el resumen del ajuste realizado.
     */
    public function resultadoAjuste($numero_ajuste)
    {
        // Obtenemos los detalles del ajuste
        $ajustesDetalle = $this->ajusteInventarioModel
            ->select('ajustes_inventario.*, productos.nombre as nombre_producto')
            ->join('productos', 'productos.id = ajustes_inventario.producto_id', 'left')
            ->where('ajustes_inventario.numero_ajuste', $numero_ajuste)
            ->findAll();

        // Obtenemos el resumen del ajuste
        $ajusteResumen = $this->ajustesResumenModel
            ->where('numero_ajuste', $numero_ajuste)
            ->first();

        if (empty($ajustesDetalle) || empty($ajusteResumen)) {
            return redirect()->to('/dashboard/conteo-inventario')->with('error', 'No se encontró el ajuste especificado.');
        }

        $datos['grupo_usuario'] = auth()->getUser()->getGroups();
        //auth()->getUser()->syncGroups('superadmin', 'admin', 'user');
        $datos['is_admin'] = false;
        if (auth()->getUser()->inGroup('admin')) {
            $datos['is_admin'] = true;
        }
        $datos['estaLogeado'] = auth()->loggedIn();
        $datos['nombreUsuario'] = auth()->getUser()->username;
        $datos['idUsuario'] = auth()->id();
        $datos['titulo_breadcrumbs'] = "Enlaces";
        $datos['menu_activo'] = "dashboard";

        // $datos = [
        //     'titulo' => 'Resultado del Ajuste de Inventario #' . $numero_ajuste,
        //     'ajustes' => $ajustes,
        //     'numero_ajuste' => $numero_ajuste
        // ];
        $datos['titulo'] = 'Resultado del Ajuste de Inventario #' . $numero_ajuste;
        $datos['ajustes'] = $ajustesDetalle;
        $datos['resumen'] = $ajusteResumen;
        $datos['numero_ajuste'] = $numero_ajuste;

        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        echo view('dashboard/resultado_ajuste'); // La nueva vista de resultados
        echo view('dashboard/templates/footer'); // Usamos el footer general
    }
}
