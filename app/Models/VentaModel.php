<?php

namespace App\Models;

use CodeIgniter\Model;

class VentaModel extends Model
{
    protected $table      = 'ventas';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id','esta_pago', 'id_vendedor', 'id_estadia'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $skipValidation     = false;

    public function obtenerPorVendedor($id_vendedor)
    {
        return $this
            ->select('ventas.*')
            ->where('patente',$id_vendedor)
            ->get()->getResultArray();
    }

}