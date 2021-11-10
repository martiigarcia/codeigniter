<?php

namespace App\Models;

use CodeIgniter\Model;

class HistorialZonaModel extends Model
{
    protected $table      = 'historial_zonas';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id','comienzo', 'final', 'precio', 'id_zona'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $skipValidation     = false;



}