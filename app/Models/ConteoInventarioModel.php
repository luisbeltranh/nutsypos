<?php

namespace App\Models;

use CodeIgniter\Model;

class ConteoInventarioModel extends Model
{
    protected $table            = 'conteo_inventario';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['producto_id', 'cantidad_contada', 'user_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = ''; // No usamos updated_at
}
