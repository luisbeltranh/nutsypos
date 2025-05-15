<?php

namespace App\Models;

use CodeIgniter\Model;

class VentasModel extends Model
{
    protected $table = 'ventas';
    protected $primary_key = 'id';
    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['numero_venta', 'producto_id', 'monto', 'cantidad', 'total', 'forma_pago_id', 'user_id'];

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
    public function ventasTotal($fecha_inicio, $fecha_fin)
    {
        $total_ventas = $this->selectSum('total')->where('ventas.created_at BETWEEN "' . $fecha_inicio . '" AND "' . $fecha_fin . '"')->findAll();
        if ($total_ventas[0]['total'] == '') {
            return 0;
        }
        return $total_ventas[0]['total'];
    }

    public function ventasFormaPago($fecha_inicio, $fecha_fin, $forma_pago_id)
    {
        $total_ventas = $this->selectSum('total')->where('ventas.created_at BETWEEN "' . $fecha_inicio . '" AND "' . $fecha_fin . '"')->where('forma_pago_id', $forma_pago_id)->findAll();
        if ($total_ventas[0]['total'] == '') {
            return 0;
        }
        return $total_ventas[0]['total'];
    }
    public function obtenerVentas($fecha_inicio, $fecha_fin)
    {
        return $this->select('* ,productos.nombre AS producto_nombre, formas_pago.nombre AS forma_pago_nombre')->where('ventas.created_at BETWEEN "' . $fecha_inicio . '" AND "' . $fecha_fin . '"')->join('productos', 'productos.id = ventas.producto_id')->join('formas_pago', 'formas_pago.id = forma_pago_id')->orderBy('numero_venta', 'ASC')->findAll();
    }
}
