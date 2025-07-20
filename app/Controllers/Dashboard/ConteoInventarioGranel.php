<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\ProductosGranelModel;
use App\Models\IngresosGranelModel;
use App\Models\ConteoInventarioGranelModel;
use App\Models\AjustesInventarioGranelModel;
use App\Models\AjustesResumenGranelModel;

class ConteoInventarioGranel extends BaseController
{
    protected $productosGranelModel;
    protected $ingresosGranelModel;
    protected $conteoInventarioGranelModel;
    protected $ajustesInventarioGranelModel;
    protected $ajustesResumenGranelModel;

    public function __construct()
    {
        // Asumo que estos modelos ya existen
        $this->productosGranelModel = new ProductosGranelModel();
        $this->ingresosGranelModel = new IngresosGranelModel();

        // Nuevos modelos
        $this->conteoInventarioGranelModel = new ConteoInventarioGranelModel();
        $this->ajustesInventarioGranelModel = new AjustesInventarioGranelModel();
        $this->ajustesResumenGranelModel = new AjustesResumenGranelModel();

        helper(['form', 'auth']);
    }

    public function index()
    {
        $userId = auth()->id();

        $resumenes = $this->ajustesResumenGranelModel
            ->select('ajustes_resumen_granel.*, users.username')
            ->join('users', 'users.id = ajustes_resumen_granel.user_id', 'left')
            ->orderBy('ajustes_resumen_granel.numero_ajuste', 'DESC')
            ->findAll();

        $conteoTemporal = $this->conteoInventarioGranelModel
            ->where('user_id', $userId)
            ->orderBy('created_at', 'ASC')
            ->findAll();

        $conteoEnCurso = !empty($conteoTemporal);

        if ($conteoEnCurso) {
            $conteoEnCursoResumen = [
                'numero_ajuste' => 'En curso',
                'fecha_ajuste' => $conteoTemporal[0]['created_at'],
                'username' => auth()->user()->username,
                'total_unidades_diferencia' => '---',
                'total_dinero_diferencia' => '---',
                'en_curso' => true
            ];
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

        $datos['titulo'] = "Ajustes de Inventario a Granel";
        $datos['resumenes'] = $resumenes;
        $datos['conteoEnCurso'] = $conteoEnCurso;
        // $datos = [
        //     'titulo' => 'Ajustes de Inventario a Granel',
        //     'resumenes' => $resumenes,
        //     'conteoEnCurso' => $conteoEnCurso
        // ];

        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs', $datos);
        echo view('dashboard/historial_conteos_granel', $datos);
        echo view('dashboard/templates/footer');
    }

    public function formularioConteo()
    {
        $userId = auth()->id();
        $productos = $this->productosGranelModel->findAll();
        $conteosTemporales = $this->conteoInventarioGranelModel->where('user_id', $userId)->findAll();

        $mapaConteos = [];
        foreach ($conteosTemporales as $conteo) {
            $mapaConteos[$conteo['producto_id']] = $conteo['cantidad_contada'];
        }

        foreach ($productos as &$producto) {
            $producto['cantidad_contada'] = $mapaConteos[$producto['id']] ?? '';
            $producto['contado'] = isset($mapaConteos[$producto['id']]);
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

        $datos['titulo'] = "Nuevo Ajuste de Inventario a Granel";
        $datos['productos'] = $productos;
        // $datos = [
        //     'titulo' => 'Nuevo Ajuste de Inventario a Granel',
        //     'productos' => $productos
        // ];

        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs', $datos);
        echo view('dashboard/conteo_form_granel', $datos);
        echo view('dashboard/templates/footer_conteo_inventario_granel');
    }

    public function guardarConteoTemporal()
    {
        if ($this->request->isAJAX()) {
            $userId = auth()->id();
            $productoId = $this->request->getPost('producto_id');
            $cantidad = $this->request->getPost('cantidad');

            $data = ['user_id' => $userId, 'producto_id' => $productoId, 'cantidad_contada' => $cantidad];
            $existe = $this->conteoInventarioGranelModel->where('user_id', $userId)->where('producto_id', $productoId)->first();

            if ($existe) {
                $this->conteoInventarioGranelModel->update($existe['id'], ['cantidad_contada' => $cantidad]);
            } else {
                $this->conteoInventarioGranelModel->insert($data);
            }
            return $this->response->setJSON(['status' => 'success']);
        }
        return redirect()->to('/dashboard');
    }

    public function eliminarConteoTemporal()
    {
        if ($this->request->isAJAX()) {
            $this->conteoInventarioGranelModel
                ->where('user_id', auth()->id())
                ->where('producto_id', $this->request->getPost('producto_id'))
                ->delete();
            return $this->response->setJSON(['status' => 'success']);
        }
        return redirect()->to('/dashboard');
    }

    public function finalizarAjuste()
    {
        $userId = auth()->id();
        $conteos = $this->conteoInventarioGranelModel->where('user_id', $userId)->findAll();

        if (empty($conteos)) {
            return redirect()->back()->with('error', 'No hay productos contados para ajustar.');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $ultimoAjuste = $this->ajustesInventarioGranelModel->selectMax('numero_ajuste')->first();
            $nuevoNumeroAjuste = ($ultimoAjuste['numero_ajuste'] ?? 0) + 1;

            $ultimoIngreso = $this->ingresosGranelModel->selectMax('numero_ingreso')->first();
            $nuevoNumeroIngreso = ($ultimoIngreso['numero_ingreso'] ?? 0) + 1;

            $totalUnidadesDiferencia = 0;
            $totalDineroDiferencia = 0;

            foreach ($conteos as $conteo) {
                $producto = $this->productosGranelModel->find($conteo['producto_id']);
                if (!$producto) continue;

                $cantidadSistema = $producto['cantidad_total'];
                $cantidadContada = $conteo['cantidad_contada'];
                $diferencia = $cantidadContada - $cantidadSistema;

                $monto = $producto['precio_venta_gramo'];
                $totalDiferenciaItem = $monto * $diferencia;

                $totalUnidadesDiferencia += $diferencia;
                $totalDineroDiferencia += $totalDiferenciaItem;

                if ($diferencia != 0) {
                    $this->productosGranelModel->update($conteo['producto_id'], ['cantidad_total' => $cantidadContada]);
                    $this->ingresosGranelModel->save([
                        'numero_ingreso' => $nuevoNumeroIngreso,
                        'producto_id' => $conteo['producto_id'],
                        'monto' => $monto,
                        'cantidad' => $diferencia,
                        'total' => $totalDiferenciaItem,
                        'tipo_movimiento' => 'AJUSTE_INVENTARIO',
                        'comentario' => 'Ajuste de Inventario a Granel #' . $nuevoNumeroAjuste,
                        'fecha_ingreso' => date('Y-m-d H:i:s'),
                        'user_id' => $userId
                    ]);
                }

                $this->ajustesInventarioGranelModel->save([
                    'numero_ajuste' => $nuevoNumeroAjuste,
                    'producto_id' => $conteo['producto_id'],
                    'cantidad_sistema' => $cantidadSistema,
                    'cantidad_contada' => $cantidadContada,
                    'diferencia' => $diferencia,
                    'total_diferencia' => $totalDiferenciaItem,
                    'user_id' => $userId
                ]);
            }

            $this->ajustesResumenGranelModel->save([
                'numero_ajuste' => $nuevoNumeroAjuste,
                'total_unidades_diferencia' => $totalUnidadesDiferencia,
                'total_dinero_diferencia' => $totalDineroDiferencia,
                'user_id' => $userId
            ]);

            $this->conteoInventarioGranelModel->where('user_id', $userId)->delete();
            $db->transComplete();

            if ($db->transStatus() === false) {
                // Mensaje de error mejorado
                log_message('error', 'Fallo la transacción de ajuste de inventario a granel.');
                return redirect()->back()->withInput()->with('error', 'La transacción falló y no se guardó ningún cambio. Por favor, verifique que los modelos (IngresosGranelModel, ProductosGranelModel) tengan todos los campos necesarios en la propiedad "$allowedFields".');
            }
            return redirect()->to('/dashboard/conteo-inventario-granel/resultadoAjuste/' . $nuevoNumeroAjuste);
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Error excepcional: ' . $e->getMessage());
        }
    }

    public function resultadoAjuste($numero_ajuste)
    {
        $ajustesDetalle = $this->ajustesInventarioGranelModel
            ->select('ajustes_inventario_granel.*, productos_granel.nombre as nombre_producto')
            ->join('productos_granel', 'productos_granel.id = ajustes_inventario_granel.producto_id', 'left')
            ->where('ajustes_inventario_granel.numero_ajuste', $numero_ajuste)
            ->findAll();

        $ajusteResumen = $this->ajustesResumenGranelModel->where('numero_ajuste', $numero_ajuste)->first();

        if (empty($ajustesDetalle) || empty($ajusteResumen)) {
            return redirect()->to('/dashboard/conteo-inventario-granel')->with('error', 'No se encontró el ajuste especificado.');
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
        $datos['titulo'] = "Resultado del Ajuste a Granel #" . esc($numero_ajuste);
        $datos['ajustes'] = $ajustesDetalle;
        $datos['resumen'] = $ajusteResumen;

        // $datos = [
        //     'titulo' => 'Resultado del Ajuste a Granel #' . $numero_ajuste,
        //     'ajustes' => $ajustesDetalle,
        //     'resumen' => $ajusteResumen
        // ];

        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs', $datos);
        echo view('dashboard/resultado_ajuste_granel', $datos);
        echo view('dashboard/templates/footer');
    }
}
