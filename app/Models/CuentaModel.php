<?php

namespace App\Models;

use CodeIgniter\Model;

class CuentaModel extends Model
{
    protected $table = 'cuenta';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id', 'monto_total', 'id_usuario'];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $skipValidation = false;

    public function obtenerCuentaDeUsuario($id_usuario)
    {
        return $this
            ->select('cuenta.*, 
                usuarios.nombre usuario_nombre,
                usuarios.apellido usuario_apellido,
                usuarios.dni usuario_dni')
            ->join('usuarios', 'usuarios.id = cuenta.id_usuario')
            ->where('id_usuario', $id_usuario)
            ->get()->getFirstRow();
    }

    public function eliminarCuentaUsuario($id_usuario)
    {
        $query = "DELETE FROM `cuenta` WHERE `id_usuario`=" . $id_usuario;
        $this->db->query($query);
    }


}