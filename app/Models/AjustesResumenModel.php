<?php

namespace App\Models;

use CodeIgniter\Model;

class AjustesResumenModel extends Model
{
    protected $table            = 'ajustes_resumen';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'numero_ajuste',
        'total_unidades_diferencia',
        'total_dinero_diferencia',
        'user_id',
        'fecha_ajuste'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'fecha_ajuste';
    protected $updatedField  = '';
}
