<?php

namespace App\Models;

use CodeIgniter\Model;

class AjustesResumenGranelModel extends Model
{
    protected $table = 'ajustes_resumen_granel';
    protected $primary_key = 'id';
    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields    = [
        'numero_ajuste',
        'total_unidades_diferencia',
        'total_dinero_diferencia',
        'user_id'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'fecha_ajuste';
    protected $updatedField  = '';
}
