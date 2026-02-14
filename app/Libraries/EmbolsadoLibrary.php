<?php

namespace App\Libraries; // O App\Services si prefieres

use App\Models\IngresosModel;
use App\Models\EmbolsadosModel;
use App\Models\IngresosGranelModel;
use App\Models\ProductosGranelModel;
use App\Models\ProductosModel;
use CodeIgniter\Database\RawSql;

class EmbolsadoLibrary
{
    // Propiedades para almacenar las instancias de los modelos y la conexión a la DB
    protected $db;
    protected $ingresosModel;
    protected $ingresosGranelModel;
    protected $embolsadosModel;
    protected $productosGranelModel;
    protected $productosModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->ingresosModel = new IngresosModel();
        $this->ingresosGranelModel = new IngresosGranelModel();
        $this->embolsadosModel = new EmbolsadosModel();
        $this->productosGranelModel = new ProductosGranelModel();
        $this->productosModel = new ProductosModel();
    }

    /**
     * Procesa el embolsado de productos, registrando el ingreso del producto terminado,
     * el detalle del embolsado, y el consumo de productos a granel.
     * No realiza pre-verificación de stock, ya que se asume que esta lógica se maneja antes
     * de llamar a esta función, o que el embolsado debe registrarse incluso si el stock
     * del sistema se vuelve negativo debido a tolerancias físicas.
     * Todas las operaciones se realizan dentro de una transacción para asegurar atomicidad.
     *
     * @param array $data Array con los datos del embolsado:
     * - 'producto_id': ID del producto embolsado (producto terminado).
     * - 'cantidad_embolsar': Cantidad de unidades del producto terminado a embolsar.
     * - 'user_id': ID del usuario que realiza el embolsado.
     * - 'composicion': Array asociativo [producto_granel_id => cantidad_granel_usado].
     * - 'fecha_embolsado': Fecha y hora del embolsado (ej. 'YYYY-MM-DD HH:MM:SS').
     * - 'comentario_embolsado': Comentario general sobre el embolsado.
     * @return bool True si la operación fue exitosa, false si falló (la transacción se revierte).
     * @throws \Exception Si ocurre un error de validación de datos de entrada o base de datos.
     */

    public function guardaEmbolsado(array $data): int|bool
    {
        // La conexión a la DB y los modelos ya están disponibles a través de $this->
        $this->db->transStart(); // *** INICIA LA TRANSACCIÓN ***

        try {
            // --- Validaciones iniciales de los datos de entrada (formato y existencia básica) ---
            if (empty($data['producto_id']) || !is_numeric($data['producto_id'])) {
                throw new \Exception('ID de producto embolsado inválido.');
            }
            if (empty($data['cantidad_embolsar']) || !is_numeric($data['cantidad_embolsar']) || $data['cantidad_embolsar'] <= 0) {
                throw new \Exception('Cantidad a embolsar inválida.');
            }
            if (empty($data['user_id']) || !is_numeric($data['user_id'])) {
                throw new \Exception('ID de usuario inválido.');
            }
            if (empty($data['composicion']) || !is_array($data['composicion'])) {
                throw new \Exception('Composición del embolsado inválida o vacía.');
            }
            if (empty($data['fecha_embolsado']) || !strtotime($data['fecha_embolsado'])) {
                throw new \Exception('Fecha de embolsado inválida.');
            }

            // Obtener datos del producto terminado (para costo)
            $data_productos = $this->productosModel->find($data['producto_id']);
            if (!$data_productos) {
                throw new \Exception('El producto terminado con ID ' . $data['producto_id'] . ' no existe.');
            }
            if (!isset($data_productos['costo'])) {
                throw new \Exception('El producto terminado no tiene un costo definido.');
            }

            // --- 1. Generar número de ingreso para el producto terminado ---
            // Se asume que 'numero_ingreso' es un campo numérico en la tabla 'ingresos'.
            $ultimoNumeroIngreso = $this->ingresosModel->selectMax('numero_ingreso')->first();
            $numeroIngreso = ($ultimoNumeroIngreso['numero_ingreso'] ?? 0) + 1;

            // --- 2. Generar número de embolsado ---
            // Se asume que 'numero_embolsado' es un campo numérico en la tabla 'embolsados'.
            $ultimoNumeroEmbolsado = $this->embolsadosModel->selectMax('numero_embolsado')->first();
            $numeroEmbolsado = ($ultimoNumeroEmbolsado['numero_embolsado'] ?? 0) + 1;

            // --- 3. Generar número de ingreso a granel ---
            // Se asume que 'numero_ingreso' es un campo numérico en la tabla 'ingresos_granel'.
            $ultimoIngresoGranel = $this->embolsadosModel->selectMax('numero_embolsado')->first();
            $numeroEmbolsado = ($ultimoNumeroEmbolsado['numero_embolsado'] ?? 0) + 1;

            // --- INSERCIÓN Y ACTUALIZACIÓN DE DATOS ---

            // --- A. Insertar en la tabla 'ingresos' (para el producto terminado) ---
            $data_ingreso_terminado = [
                'numero_ingreso' => $numeroIngreso,
                'producto_id' => $data['producto_id'],
                'monto' => $data_productos['costo'], // Costo unitario del producto terminado
                'cantidad' => $data['cantidad_embolsar'], // Cantidad de unidades terminadas
                'total' => $data_productos['costo'] * $data['cantidad_embolsar'],
                'comentario' => $data['comentario_embolsado'] ?? 'Ingreso por producción (embolsado)',
                'fecha_ingreso' => $data['fecha_embolsado'], // Fecha real del embolsado
                'user_id' => $data['user_id'],
                'tipo_ingreso' => 'embolsado', // Nuevo tipo de movimiento
            ];

            $this->ingresosModel->insert($data_ingreso_terminado);

            // --- B. Insertar en la tabla 'embolsados' y actualizar 'productos_granel' y 'ingresos' (para consumo de granel) ---
            foreach ($data['composicion'] as $producto_granel_id => $cantidad_granel_usado) {
                if (!is_numeric($producto_granel_id) || !is_numeric($cantidad_granel_usado) || $cantidad_granel_usado <= 0) {
                    throw new \Exception('Cantidad o ID de producto a granel inválido en la composición.');
                }

                // Insertar en tabla embolsados (registro del uso de granel para este embolsado)
                $data_embolsados = [
                    'numero_embolsado' => $numeroEmbolsado,
                    'producto_granel_id' => $producto_granel_id,
                    'producto_id' => $data['producto_id'], // El producto terminado al que contribuyó este granel
                    'cantidad_granel_usado' => $cantidad_granel_usado,
                    'cantidad_producto_embolsado' => $data['cantidad_embolsar'],
                    'user_id' => $data['user_id'],
                    // Puedes añadir 'fecha_embolsado' aquí también si es relevante para esta tabla
                ];

                $this->embolsadosModel->insert($data_embolsados);

                // Actualizar tabla productos_granel (descontar la cantidad usada)
                // NO se verifica stock aquí, el sistema registrará el consumo incluso si el stock se vuelve negativo.
                $this->productosGranelModel->update($producto_granel_id, [
                    'cantidad_total' => new RawSql("cantidad_total - " . (int)$cantidad_granel_usado)
                ]);

                // Insertar en tabla ingresos_granel (para el consumo de granel, con cantidad negativa)
                $granel_info = $this->productosGranelModel->find($producto_granel_id); // Re-obtener para el costo
                $data_ingreso_granel = [
                    'numero_ingreso' => $numeroIngreso, // Usar el mismo número de ingreso para agrupar
                    'producto_id' => $producto_granel_id, // El ID del producto a granel
                    'monto' => $granel_info['costo'] ?? 0, // Costo unitario del granel (si existe)
                    'cantidad' => -$cantidad_granel_usado, // Cantidad negativa para representar salida
                    'total' => - ($granel_info['costo'] ?? 0) * $cantidad_granel_usado,
                    'tipo_movimiento' => 'salida_embolsado', // Nuevo tipo de movimiento para consumo en producción
                    'comentario' => 'Consumo para producción de ' . $data_productos['nombre'] . ' (Embolsado #' . $numeroEmbolsado . ')',
                    'fecha_ingreso' => $data['fecha_embolsado'], // Fecha real del embolsado
                    'user_id' => $data['user_id'],
                ];
                $this->ingresosGranelModel->insert($data_ingreso_granel);
            }

            // --- C. Actualizar la tabla 'productos' (incrementar stock del producto terminado) ---
            // NO se verifica stock negativo aquí para el producto terminado, solo se incrementa.
            $this->productosModel->update($data['producto_id'], [
                'cantidad_total' => new RawSql("cantidad_total + " . (int)$data['cantidad_embolsar'])
            ]);

            $this->db->transComplete(); // *** COMPLETA LA TRANSACCIÓN (COMMIT o ROLLBACK automático) ***

            // --- Verificar el estado final de la transacción ---
            if ($this->db->transStatus() === FALSE) {
                // Si transStatus es FALSE, significa que algo falló y la transacción fue revertida automáticamente.
                log_message('error', 'Transacción de embolsado fallida: ' . $this->db->error()['message']);
                return false; // Indica fallo
            } else {
                // La transacción fue exitosa
                log_message('info', 'Transacción de embolsado completada con éxito. Número de embolsado: ' . $numeroEmbolsado);
                //return true; // Indica éxito
                return $numeroEmbolsado;
            }
        } catch (\Exception $e) {
            // Si se lanza una excepción (ej. datos de entrada inválidos, producto no existe, error de DB)
            $this->db->transRollback(); // *** REVierte la transacción explícitamente ***
            log_message('error', 'Excepción durante la transacción de embolsado: ' . $e->getMessage());
            return false; // Indica fallo
        }
    }
}
