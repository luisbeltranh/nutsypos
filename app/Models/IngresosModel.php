<?php

namespace App\Models;

use CodeIgniter\Model;

class IngresosModel extends Model
{
    protected $table = 'ingresos';
    protected $primary_key = 'id';
    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['numero_ingreso', 'producto_id', 'monto', 'cantidad', 'total', 'tipo_ingreso', 'comentario', 'user_id', 'created_at'];

    // Valores posibles para tipo_movimiento (ejemplos):
    //      COMPRA (Ingreso regular de productos comprados)
    //      EMBOLSADO (Ingreso de productos embolsados)
    //      AJUSTE_SOBRANTE (Corrección de inventario por conteo físico - sobrante)
    //      AJUSTE_FALTANTE (Corrección de inventario por conteo físico - faltante)
    //      TRANSFERENCIA_SALIDA (Envío de productos a otro local)
    //      DEVOLUCION_CLIENTE (Producto devuelto por un cliente)
    //      MERMA (Producto dañado, vencido, perdido)
    //      DEVOLUCION_PROVEEDOR (Producto devuelto al proveedor)

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
