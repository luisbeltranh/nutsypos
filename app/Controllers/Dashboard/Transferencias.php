<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\ProductosModel;
use App\Models\IngresosModel;

class Transferencias extends BaseController
{
    protected $productoModel;
    protected $ingresoModel;

    public function __construct()
    {
        $this->productoModel = new ProductosModel();
        $this->ingresoModel = new IngresosModel();
        helper(['form', 'auth']);
    }

    /**
     * Muestra el formulario para registrar una transferencia de salida.
     * @param int $id El ID del producto a transferir.
     */
    public function salida($id = null)
    {
        $producto = $this->productoModel->find($id);

        if ($producto === null) {
            return redirect()->back()->with('error', 'Producto no encontrado.');
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
        $datos['titulo'] = "Transferencia de Salida: " . esc($producto['nombre']);
        $datos['producto'] = $producto;

        // $datos = [
        //     'titulo' => 'Transferencia de Salida: ' . $producto['nombre'],
        //     'producto' => $producto
        // ];

        echo view('dashboard/templates/head', $datos);
        echo view('dashboard/templates/topmenu');
        echo view('dashboard/templates/sidebar');
        echo view('dashboard/templates/breadcrumbs');
        echo view('dashboard/transferencia_salida_form');
        echo view('dashboard/templates/footer');
    }

    /**
     * Procesa la transferencia de salida y actualiza el inventario.
     */
    public function procesarSalida()
    {
        $productoId = $this->request->getPost('producto_id');
        $cantidadSalida = (float) $this->request->getPost('cantidad');
        $comentario = $this->request->getPost('comentario');

        // Validación básica
        if ($cantidadSalida <= 0) {
            return redirect()->back()->withInput()->with('error', 'La cantidad debe ser mayor que cero.');
        }

        $producto = $this->productoModel->find($productoId);

        if ($producto === null) {
            return redirect()->back()->with('error', 'El producto ya no existe.');
        }

        // Verificar si hay stock suficiente
        if ($producto['cantidad_total'] < $cantidadSalida) {
            return redirect()->back()->withInput()->with('error', 'No hay stock suficiente para la transferencia. Stock actual: ' . $producto['cantidad_total']);
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // 1. Calcular nuevo stock y actualizar tabla de productos
            $nuevoStock = $producto['cantidad_total'] - $cantidadSalida;
            $this->productoModel->update($productoId, ['cantidad_total' => $nuevoStock]);

            // 2. Preparar y guardar el registro en la tabla de ingresos
            $ultimoIngreso = $this->ingresoModel->selectMax('numero_ingreso')->first();
            $nuevoNumeroIngreso = ($ultimoIngreso['numero_ingreso'] ?? 0) + 1;

            $monto = $producto['precio_venta'];
            // La cantidad y el total son negativos porque es una salida
            $total = $monto * (-$cantidadSalida);

            $this->ingresoModel->save([
                'numero_ingreso' => $nuevoNumeroIngreso,
                'producto_id' => $productoId,
                'monto' => $monto,
                'cantidad' => -$cantidadSalida, // Guardamos la cantidad en negativo
                'total' => $total,
                'tipo_ingreso' => 'TRANSFERENCIA_SALIDA',
                'comentario' => 'Transferencia a otro local. ' . $comentario,
                'fecha_ingreso' => date('Y-m-d H:i:s'),
                'user_id' => auth()->id()
            ]);

            $db->transComplete();

            if ($db->transStatus() === false) {
                return redirect()->back()->with('error', 'Hubo un error al procesar la transferencia.');
            }

            // Asumo que tienes una ruta para ver el listado de productos
            return redirect()->to('/dashboard/verinventario')->with('success', 'Transferencia registrada y stock actualizado correctamente.');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Error excepcional: ' . $e->getMessage());
        }
    }
}
