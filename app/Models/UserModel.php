<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'usuarios';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id','dni', 'nombre', 'apellido', 'fecha_de_nacimiento', 'email', 'id_rol','password'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $skipValidation     = false;
    
    public function obtenerUsuarios()
    {
        return $this->db->table('usuarios')
            ->select('usuarios.*,
            roles.id rol_id,roles.nombre rol_nombre,roles.descripcion rol_descripcion')

            ->join('roles', 'roles.id = usuarios.id_rol')
            ->get()->getResultArray();
    }

    public function obtenerUsuario($id)
    {
        return $this
            ->select('usuarios.*,roles.id rol_id,roles.nombre rol_nombre,roles.descripcion rol_descripcion')
            ->join('roles', "roles.id = usuarios.id_rol")
            ->find($id);
    }

    public function obtenerUsuarioDNI($dni)
    {
           return $this
                ->select('usuarios.*,roles.id rol_id,roles.nombre rol_nombre,roles.descripcion rol_descripcion')
                ->where('dni',$dni)
                ->join('roles', "roles.id = usuarios.id_rol")->get()->getResultArray();

    }
    public function obtenerUsuarioEmail($email)
    {
        return $this
                ->select('usuarios.*,roles.id rol_id,roles.nombre rol_nombre,roles.descripcion rol_descripcion')
                ->where('email',$email)
                ->join('roles', "roles.id = usuarios.id_rol")->get()->getFirstRow('array');
    }

    public function obtenerDatosParaTabla()
    {
            return $this->db->table('usuarios')
                ->select('usuarios.*,roles.id rol_id,roles.nombre rol_nombre,roles.descripcion rol_descripcion')
                ->join('roles', 'roles.id=usuarios.id_rol')
                ->get()->getResult();
    }
    
}