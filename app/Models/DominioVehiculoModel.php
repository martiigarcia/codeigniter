<?php

namespace App\Models;

use CodeIgniter\Model;

class DominioVehiculoModel extends Model
{
    protected $table      = 'dominio_vehiculo';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id','id_usuario', 'id_vehiculo'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $skipValidation     = false;
    


    public function obtenerPorUsuario($id_usuario, $id_vehiculo)
    {
           return $this
                ->select('dominio_vehiculo.*')
                ->where('id_usuario',$id_usuario )
               ->where('id_vehiculo',$id_vehiculo)
               ->get()->getFirstRow();

    }

    public function tieneVegiculos(){
        return true;
    }

    
}