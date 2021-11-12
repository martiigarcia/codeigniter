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

    public function obtenerPorId($id)
    {
           return $this
                ->select('dominio_vehiculo.*')
                ->where('id',$id )
               ->get()->getFirstRow();

    }

    public function tieneVehiculos($id_usuario)
    {
        return $this
        ->select('dominio_vehiculo.*, 
        vehiculos.id vehiculo_id, vehiculos.patente vehiculo_patente, 
        marcas.nombre vehiculo_marca_nombre,
        modelos.nombre vehiculo_modelo_nombre')
        ->join('vehiculos', 'vehiculos.id = dominio_vehiculo.id_vehiculo')
        ->join('marcas', 'marcas.id = vehiculos.marca')
        ->join('modelos', 'modelos.id = vehiculos.modelo')
        ->where('id_usuario',$id_usuario )
       ->get()->getResultArray();
    }

    public function obtenerTodos()
    {
        return $this
        ->select('dominio_vehiculo.*, 
        vehiculos.id vehiculo_id, 
        vehiculos.patente vehiculo_patente, 
        marcas.nombre vehiculo_marca_nombre,
        modelos.nombre vehiculo_modelo_nombre,
        usuarios.nombre vehiculo_usuario_nombre,
        usuarios.apellido vehiculo_usuario_apellido,
        usuarios.dni vehiculo_usuario_dni')
        ->join('vehiculos', 'vehiculos.id = dominio_vehiculo.id_vehiculo')
        ->join('marcas', 'marcas.id = vehiculos.marca')
        ->join('modelos', 'modelos.id = vehiculos.modelo')
        ->join('usuarios', 'usuarios.id = dominio_vehiculo.id_usuario')
       ->get()->getResultArray();
    }

    

    
}