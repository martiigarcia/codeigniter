<?php

namespace App\Models;

use CodeIgniter\Model;

class TarjetaDeCreditoModel extends Model
{
    protected $table      = 'tarjetas_de_credito';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id', 'numero', 'fecha_vencimiento', 'codigo_de_seguridad', 'id_usuario'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $skipValidation     = false;

    public function obtenerTarjetasPorUsuario($id_usuario)
    {
        return $this
            ->select('tarjetas_de_credito.*, 
                usuarios.nombre usuario_nombre,
                usuarios.apellido usuario_apellido,
                usuarios.dni usuario_dni')
            ->join('usuarios', 'usuarios.id = tarjetas_de_credito.id_usuario')
            ->where('id_usuario',$id_usuario )
            ->get()->getResultArray();
    }



}