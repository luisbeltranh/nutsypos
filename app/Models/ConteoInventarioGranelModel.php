<?php

namespace App\Models;

use CodeIgniter\Model;

class ConteoInventarioGranelModel extends Model
{
    protected $table = 'conteo_inventario_granel';
    protected $primary_key = 'id';
    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields    = ['producto_id', 'cantidad_contada', 'user_id'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
}
