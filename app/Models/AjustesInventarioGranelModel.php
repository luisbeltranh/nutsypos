<?php

namespace App\Models;

use CodeIgniter\Model;

class AjustesInventarioGranelModel extends Model
{
    protected $table = 'ajustes_inventario_granel';
    protected $primary_key = 'id';
    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields    = [
        'numero_ajuste',
        'producto_id',
        'cantidad_sistema',
        'cantidad_contada',
        'diferencia',
        'total_diferencia',
        'user_id'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'fecha_ajuste';
    protected $updatedField  = '';
}
