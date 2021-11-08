<?php

namespace App\Models;

use CodeIgniter\Model;

class EstadiaModel extends Model
{
    protected $table      = 'estadias';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id', 'estado', 'duracion_definida', 'cantidad_horas', 'fecha', 'pago_pendiente', 'id_dominio_vehiculo', 'id_zona'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $skipValidation     = false;
    
    public function verificarEstadias($id_usuario){
        return $this
                ->select('estadias.*,
                dominio_vehiculo.id dominio_vehiculo_id,
                usuarios.id id_usuario')
                ->join('dominio_vehiculo', 'dominio_vehiculo.id = estadias.id_dominio_vehiculo')
                ->join('usuarios', 'usuarios.id = dominio_vehiculo.id_usuario')
                ->where('id_usuario',$id_usuario) 
               ->get()->getFirstRow();
    }

}