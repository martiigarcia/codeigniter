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
            ->select('ventas.*,            
            vehiculos.patente patente,
            estadias.fecha_inicio fecha_inicio,
            estadias.fecha_fin fecha_fin,
            usuarios.nombre nombre,
            usuarios.apellido apellido')
            ->join('estadias','estadias.id = ventas.id_estadia')
            ->join('dominio_vehiculo',' dominio_vehiculo.id=estadias.id_dominio_vehiculo')
            ->join('usuarios','usuarios.id=dominio_vehiculo.id_usuario')
            ->join('vehiculos','vehiculos.id=dominio_vehiculo.id_vehiculo')
            ->where('id_vendedor',$id_vendedor)
            ->get()->getResultArray();
    }


}