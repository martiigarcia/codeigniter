<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeloModel extends Model
{
    protected $table      = 'modelos';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_marca','id', 'nombre'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $skipValidation     = false;
    


    public function obtenerModelosPorMarcas($id)
    {
           return $this
                ->select('modelos.*')
                ->where('id_marca',$id)
               ->get()->getResult();

    }

    
}