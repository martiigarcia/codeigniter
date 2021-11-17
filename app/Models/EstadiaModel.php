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

    protected $allowedFields = ['id', 'estado', 'duracion_definida', 'cantidad_horas', 
    'fecha_inicio', 'fecha_fin', 'pago_pendiente', 'monto', 'id_dominio_vehiculo', 'id_zona'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $skipValidation     = false;


    public function buscarPorDominio($id_dominio,$id_zona,$fecha_inicio){
        return $this
            ->select('estadias.*,')
            ->where('id_dominio_vehiculo',$id_dominio )
            ->where('id_zona',$id_zona)
            ->where('fecha_inicio',$fecha_inicio)
            ->get()
            ->getFirstRow();
    }


    //para ver si se muestran las opciones de estacionar o desestacionar
    public function verificarEstadiasExistentesActivasIndefinidas($id_usuario)
    {
        return $this
                ->select('estadias.*,
                dominio_vehiculo.id dominio_vehiculo_id,
                usuarios.id id_usuario')
                ->join('dominio_vehiculo', 'dominio_vehiculo.id = estadias.id_dominio_vehiculo')
                ->join('usuarios', 'usuarios.id = dominio_vehiculo.id_usuario')
                ->where('id_usuario', $id_usuario)
                ->where('estado',true) 
                ->where('duracion_definida', false)
               ->get()->getFirstRow();
    }

    //usada para mostrar en la tabla de pagar estadias pendientes
    public function verificarEstadiasPagoPendiente($id_usuario)
    {
        return $this
                ->select('estadias.*,
                dominio_vehiculo.id dominio_vehiculo_id,

                vehiculos.id vehiculo_id, 
                vehiculos.patente vehiculo_patente, 
                marcas.nombre vehiculo_marca_nombre,
                modelos.nombre vehiculo_modelo_nombre,
                
                usuarios.id id_usuario,

                zonas.id zona_id,
                zonas.nombre zona_nombre,
                zonas.descripcion zona_descripcion')

                ->join('dominio_vehiculo', 'dominio_vehiculo.id = estadias.id_dominio_vehiculo')
                ->join('usuarios', 'usuarios.id = dominio_vehiculo.id_usuario')
                ->join('vehiculos', 'vehiculos.id = dominio_vehiculo.id_vehiculo')
                ->join('marcas', 'marcas.id = vehiculos.marca')
                ->join('modelos', 'modelos.id = vehiculos.modelo')
                ->join('zonas', 'zonas.id = estadias.id_zona')
                
                ->where('id_usuario', $id_usuario)
                ->where('estado',false) 
                ->where('pago_pendiente', true)
                
               ->get()->getResultArray();
    }

    public function estadiasActivas()
    {
        return $this
                ->select('estadias.*,
                dominio_vehiculo.id dominio_vehiculo_id,

                vehiculos.id vehiculo_id, 
                vehiculos.patente vehiculo_patente, 
                marcas.nombre vehiculo_marca_nombre,
                modelos.nombre vehiculo_modelo_nombre,

                usuarios.id id_usuario,

                zonas.id zona_id,
                zonas.nombre zona_nombre,
                zonas.descripcion zona_descripcion')

                ->join('dominio_vehiculo', 'dominio_vehiculo.id = estadias.id_dominio_vehiculo')
                ->join('usuarios', 'usuarios.id = dominio_vehiculo.id_usuario')
                ->join('vehiculos', 'vehiculos.id = dominio_vehiculo.id_vehiculo')
                ->join('marcas', 'marcas.id = vehiculos.marca')
                ->join('modelos', 'modelos.id = vehiculos.modelo')
                ->join('zonas', 'zonas.id = estadias.id_zona')
                

                
               ->get()->getResultArray();
    }

    public function obtenerTodas()
    {
        return $this
                ->select('estadias.*,
                dominio_vehiculo.id dominio_vehiculo_id,

                vehiculos.id vehiculo_id, 
                vehiculos.patente vehiculo_patente, 
                marcas.nombre vehiculo_marca_nombre,
                modelos.nombre vehiculo_modelo_nombre,

                usuarios.id id_usuario,
                usuarios.nombre nombre_usuario,

                zonas.id zona_id,
                zonas.nombre zona_nombre,
                zonas.descripcion zona_descripcion')

                ->join('dominio_vehiculo', 'dominio_vehiculo.id = estadias.id_dominio_vehiculo')
                ->join('usuarios', 'usuarios.id = dominio_vehiculo.id_usuario')
                ->join('vehiculos', 'vehiculos.id = dominio_vehiculo.id_vehiculo')
                ->join('marcas', 'marcas.id = vehiculos.marca')
                ->join('modelos', 'modelos.id = vehiculos.modelo')
                ->join('zonas', 'zonas.id = estadias.id_zona')
                
               ->get()->getResultArray();
    }

    public function obtenerEstadiaById($id)
    {
        return $this
                ->select('estadias.*,
                dominio_vehiculo.id dominio_vehiculo_id,

                vehiculos.id vehiculo_id, 
                vehiculos.patente vehiculo_patente, 
                marcas.nombre vehiculo_marca_nombre,
                modelos.nombre vehiculo_modelo_nombre,

                usuarios.id id_usuario,
                usuarios.nombre nombre_usuario,
                usuarios.apellido apellido_usuario,
                usuarios.dni dni_usuario,

                zonas.id zona_id,
                zonas.nombre zona_nombre,
                zonas.descripcion zona_descripcion')

                ->join('dominio_vehiculo', 'dominio_vehiculo.id = estadias.id_dominio_vehiculo')
                ->join('usuarios', 'usuarios.id = dominio_vehiculo.id_usuario')
                ->join('vehiculos', 'vehiculos.id = dominio_vehiculo.id_vehiculo')
                ->join('marcas', 'marcas.id = vehiculos.marca')
                ->join('modelos', 'modelos.id = vehiculos.modelo')
                ->join('zonas', 'zonas.id = estadias.id_zona')
                
                ->find($id);
    }

}