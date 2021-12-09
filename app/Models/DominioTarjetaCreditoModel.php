<?php

namespace App\Models;

use CodeIgniter\Model;

class DominioTarjetaCreditoModel extends Model
{
    protected $table      = 'tarjeta_de_credito';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id', 'id_tarjeta', 'id_usuario'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $skipValidation     = false;



}