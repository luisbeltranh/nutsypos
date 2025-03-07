<?php

namespace App\Models;

use CodeIgniter\Model;

class GastosModel extends Model
{
    protected $table = 'gastos';
    protected $primary_key = 'id';
    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['numero_gasto', 'monto', 'descripcion', 'user_id'];

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
    public function numero_gasto()
    {
        $numero = $this->select('numero_gasto')->orderBy('numero_gasto', 'desc')->first();
        if ($numero == null) {
            return 0;
        }
        $numero['numero_gasto']++;
        return $numero['numero_gasto'];
    }
    public function gasto_total_hoy($fecha_inicio, $fecha_fin)
    {
        $gasto_total = $this->selectSum('monto')->where('created_at BETWEEN "' . $fecha_inicio . '" AND "' . $fecha_fin . '"')->findAll();
        if ($gasto_total[0]['monto'] == '') {
            $gasto = 0;
            return $gasto;
        }
        $gasto = $gasto_total[0]['monto'];
        return $gasto;
    }
}
