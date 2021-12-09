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

    protected $allowedFields = ['id', 'dia_hora', 'calle', 'id_estadia'];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $skipValidation = false;

    public function obtenerTodos()
    {
        return $this
            ->select('infracciones.*, 
                dominio_vehiculo.id dominio_vehiculo_id,

                vehiculos.id vehiculo_id, 
                vehiculos.patente vehiculo_patente, 
                marcas.nombre vehiculo_marca_nombre,
                modelos.nombre vehiculo_modelo_nombre,
                
                usuarios.id id_usuario,
                usuarios.nombre usuario_nombre,
                usuarios.apellido usuario_apellido,
                usuarios.dni usuario_dni,
                
                estadias.id estadia_id,
                estadias.monto estadia_monto,
                estadias.pago_pendiente estadia_pago_pendiente,
              
                
                zonas.id zona_id,
                zonas.nombre zona_nombre')

            ->join('estadias', 'estadias.id = infracciones.id_estadia')
            ->join('historial_zonas', 'historial_zonas.id = estadias.id_historial_zona')
            ->join('zonas', 'zonas.id = historial_zonas.id_zona')
            ->join('dominio_vehiculo', 'dominio_vehiculo.id = estadias.id_dominio_vehiculo')
            ->join('vehiculos', 'vehiculos.id = dominio_vehiculo.id_vehiculo')
            ->join('marcas', 'marcas.id = vehiculos.marca')
            ->join('modelos', 'modelos.id = vehiculos.modelo')
            ->join('usuarios', 'usuarios.id = dominio_vehiculo.id_usuario')

            ->get()->getResultArray();


    }

    public function obtenerInfraccionesPorDominioId($dominio)
    {
        return $this
            ->select('infracciones.*, 
                dominio_vehiculo.id dominio_vehiculo_id,

                vehiculos.id vehiculo_id, 
                vehiculos.patente vehiculo_patente, 
                marcas.nombre vehiculo_marca_nombre,
                modelos.nombre vehiculo_modelo_nombre,
                
                usuarios.id id_usuario,
                usuarios.nombre usuario_nombre,
                usuarios.apellido usuario_apellido,
                usuarios.dni usuario_dni,
                
                estadias.id estadia_id,
                estadias.monto estadia_monto,
                estadias.pago_pendiente estadia_pago_pendiente,
              
                
                zonas.id zona_id,
                zonas.nombre zona_nombre')

            ->join('estadias', 'estadias.id = infracciones.id_estadia')
            ->join('historial_zonas', 'historial_zonas.id = estadias.id_historial_zona')
            ->join('zonas', 'zonas.id = historial_zonas.id_zona')
            ->join('dominio_vehiculo', 'dominio_vehiculo.id = estadias.id_dominio_vehiculo')
            ->join('vehiculos', 'vehiculos.id = dominio_vehiculo.id_vehiculo')
            ->join('marcas', 'marcas.id = vehiculos.marca')
            ->join('modelos', 'modelos.id = vehiculos.modelo')
            ->join('usuarios', 'usuarios.id = dominio_vehiculo.id_usuario')

            ->where('estadias.id_dominio_vehiculo', $dominio)

            ->get()->getResultArray();


    }

}