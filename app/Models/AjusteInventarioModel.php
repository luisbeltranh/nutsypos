<?php

namespace App\Models;

use CodeIgniter\Model;

class AjusteInventarioModel extends Model
{
    protected $table            = 'ajustes_inventario';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'numero_ajuste',
        'producto_id',
        'cantidad_sistema',
        'cantidad_contada',
        'diferencia',
        'user_id',
        'fecha_ajuste'
    ];

    // Dates
    protected $useTimestamps = false; // Controlamos la fecha manualmente
}
