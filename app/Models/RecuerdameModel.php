<?php

namespace App\Models;

use CodeIgniter\Model;

class RecuerdameModel extends Model
{
    protected $table      = 'recuerdame_sesion';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id', 'hash', 'fecha_fin', 'id_usuario'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $skipValidation     = false;
    
    
    
}