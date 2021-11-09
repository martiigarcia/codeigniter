<?php

namespace App\Models;

use CodeIgniter\Model;

class VehiculoModel extends Model
{
    protected $table      = 'vehiculos';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id','patente','marca','modelo'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $skipValidation     = false;
    
    public function obtenerPorPatente($patente)
    {
        return $this
            ->select('vehiculos.*')
            ->where('patente',$patente)
            ->get()->getFirstRow();

    }

    public function obtenerTodos()
    {
        return $this
            ->select('vehiculos.*')
            ->get()->getFirstRow();

    }


}