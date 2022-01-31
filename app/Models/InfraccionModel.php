<?php

namespace App\Models;

use CodeIgniter\Model;

class InfraccionModel extends Model
{
    protected $table = 'infracciones';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id', 'dia_hora', 'calle', 'altura', 'id_vehiculo', 'id_historial_zona'];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $skipValidation = false;

    public function obtenerTodos()
    {
        return $this
            ->select('infracciones.*, 

                vehiculos.id vehiculo_id, 
                vehiculos.patente vehiculo_patente, 
                marcas.nombre vehiculo_marca_nombre,
                modelos.nombre vehiculo_modelo_nombre,
                
                usuarios.id id_usuario,
                usuarios.nombre usuario_nombre,
                usuarios.apellido usuario_apellido,
                usuarios.dni usuario_dni,
                
                zonas.id zona_id,
                zonas.nombre zona_nombre,
                zonas.descripcion zona_decripcion
                ')

            ->join('vehiculos', 'vehiculos.id = infracciones.id_vehiculo')
            ->join('marcas', 'marcas.id = vehiculos.marca')
            ->join('modelos', 'modelos.id = vehiculos.modelo')
            ->join('usuarios', 'usuarios.id = dominio_vehiculo.id_usuario')
            ->join('historial_zonas', 'historial_zonas.id = infracciones.id_historial_zona')
            ->join('zonas', 'zonas.id = historial_zonas.id_zona')
            ->get()->getResultArray();


    }

    public function obtenerInfraccionesPorVehiculoId($vehiculo)
    {
        return $this
            ->select('infracciones.*, 

                vehiculos.id vehiculo_id, 
                vehiculos.patente vehiculo_patente, 
                marcas.nombre vehiculo_marca_nombre,
                modelos.nombre vehiculo_modelo_nombre,
                
                usuarios.id id_usuario,
                usuarios.nombre usuario_nombre,
                usuarios.apellido usuario_apellido,
                usuarios.dni usuario_dni,
                
                 zonas.id zona_id,
                zonas.nombre zona_nombre,
                zonas.descripcion zona_decripcion
                ')

            ->join('vehiculos', 'vehiculos.id = infracciones.id_vehiculo')
            ->join('marcas', 'marcas.id = vehiculos.marca')
            ->join('modelos', 'modelos.id = vehiculos.modelo')
            ->join('usuarios', 'usuarios.id = dominio_vehiculo.id_usuario')
            ->join('historial_zonas', 'historial_zonas.id = infracciones.id_historial_zona')
            ->join('zonas', 'zonas.id = historial_zonas.id_zona')
            ->where('infracciones.id_vehiculo', $vehiculo)
            ->get()->getResultArray();


    }

    /*public function obtenerInfraccionesPorUsuarioId($id_usuario)
    {
        return $this
            ->select('infracciones.*, 
                usuarios.id id_usuario')
            ->join('usuarios', 'usuarios.id = dominio_vehiculo.id_usuario')
            ->where('usuarios.id', $id_usuario)
            ->get()->getResultArray();

    }*/
}