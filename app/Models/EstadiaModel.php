<?php

namespace App\Models;

use CodeIgniter\Model;

class EstadiaModel extends Model
{
    protected $table = 'estadias';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id', 'duracion_definida',
        'fecha_inicio', 'fecha_fin', 'pago_pendiente', 'id_dominio_vehiculo', 'id_historial_zona'];

    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $skipValidation = false;

    //ver si esta funcion se usa en alguna parte
    /*public function buscarPorDominio($id_dominio, $id_zona, $fecha_inicio)
    {
        return $this
            ->select('estadias.*,')
            ->where('id_dominio_vehiculo', $id_dominio)
            ->where('id_zona', $id_zona)
            ->where('fecha_inicio', $fecha_inicio)
            ->get()->getFirstRow();
    }*/

    public
    function obtenerTodas()
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
                
                historial_zonas.comienzo historia_comienzo,
                historial_zonas.final historia_final,
                historial_zonas.precio historia_precio,
                historial_zonas.estado historia_estado,


                zonas.id zona_id,
                zonas.nombre zona_nombre,
                zonas.descripcion zona_descripcion')
            ->join('dominio_vehiculo', 'dominio_vehiculo.id = estadias.id_dominio_vehiculo')
            ->join('usuarios', 'usuarios.id = dominio_vehiculo.id_usuario')
            ->join('vehiculos', 'vehiculos.id = dominio_vehiculo.id_vehiculo')
            ->join('marcas', 'marcas.id = vehiculos.marca')
            ->join('modelos', 'modelos.id = vehiculos.modelo')
            ->join('historial_zonas', 'historial_zonas.id = estadias.id_historial_zona')
            ->join('zonas', 'zonas.id = historial_zonas.id_zona')
            ->get()->getResultArray();
    }

    public
    function obtenerEstadiaById($id)
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

                historial_zonas.comienzo historial_comienzo,
                historial_zonas.final historial_final,
                historial_zonas.precio historial_precio,
                historial_zonas.estado historial_estado,

                zonas.id zona_id,
                zonas.nombre zona_nombre,
                zonas.descripcion zona_descripcion')
            ->join('dominio_vehiculo', 'dominio_vehiculo.id = estadias.id_dominio_vehiculo')
            ->join('usuarios', 'usuarios.id = dominio_vehiculo.id_usuario')
            ->join('vehiculos', 'vehiculos.id = dominio_vehiculo.id_vehiculo')
            ->join('marcas', 'marcas.id = vehiculos.marca')
            ->join('modelos', 'modelos.id = vehiculos.modelo')
            ->join('historial_zonas', 'historial_zonas.id = estadias.id_historial_zona')
            ->join('zonas', 'zonas.id = historial_zonas.id_zona')
            ->find($id);
    }

//usada para mostrar en la tabla de pagar estadias pendientes

    public
    function estadiasActivas($fechaActual)
    {
        return $this
            ->select('estadias.*,
                dominio_vehiculo.id dominio_vehiculo_id,

                vehiculos.id vehiculo_id, 
                vehiculos.patente vehiculo_patente, 
                marcas.nombre vehiculo_marca_nombre,
                modelos.nombre vehiculo_modelo_nombre,

                usuarios.id id_usuario,
                
                  historial_zonas.comienzo historia_comienzo,
                historial_zonas.final historia_final,
                historial_zonas.precio historia_precio,
                historial_zonas.estado historia_estado,

                zonas.id zona_id,
                zonas.nombre zona_nombre,
                zonas.descripcion zona_descripcion')
            ->join('dominio_vehiculo', 'dominio_vehiculo.id = estadias.id_dominio_vehiculo')
            ->join('usuarios', 'usuarios.id = dominio_vehiculo.id_usuario')
            ->join('vehiculos', 'vehiculos.id = dominio_vehiculo.id_vehiculo')
            ->join('marcas', 'marcas.id = vehiculos.marca')
            ->join('modelos', 'modelos.id = vehiculos.modelo')
            ->join('historial_zonas', 'historial_zonas.id = estadias.id_historial_zona')
            ->join('zonas', 'zonas.id = historial_zonas.id_zona')
            ->where('estadias.fecha_fin <=', $fechaActual)
            ->get()->getResultArray();
    }

    public
    function buscarPorDominioId($id_dominio)
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

                historial_zonas.comienzo historia_comienzo,
                historial_zonas.final historia_final,
                historial_zonas.precio historia_precio,
                historial_zonas.estado historia_estado,

                zonas.id zona_id,
                zonas.nombre zona_nombre,
                zonas.descripcion zona_descripcion')
            ->join('dominio_vehiculo', 'dominio_vehiculo.id = estadias.id_dominio_vehiculo')
            ->join('usuarios', 'usuarios.id = dominio_vehiculo.id_usuario')
            ->join('vehiculos', 'vehiculos.id = dominio_vehiculo.id_vehiculo')
            ->join('marcas', 'marcas.id = vehiculos.marca')
            ->join('modelos', 'modelos.id = vehiculos.modelo')
            ->join('historial_zonas', 'historial_zonas.id = estadias.id_historial_zona')
            ->join('zonas', 'zonas.id = historial_zonas.id_zona')
            ->where('id_dominio_vehiculo', $id_dominio)
            ->get()->getResultArray();
    }

    public
    function estadiasActivasPorDominioId($id_dominio, $fechaActual)
    {
        return $this
            ->select('estadias.*,
                dominio_vehiculo.id dominio_vehiculo_id,

                vehiculos.id vehiculo_id, 
                vehiculos.patente vehiculo_patente, 
                marcas.nombre vehiculo_marca_nombre,
                modelos.nombre vehiculo_modelo_nombre,

                usuarios.id id_usuario,
                
                historial_zonas.comienzo historia_comienzo,
                historial_zonas.final historia_final,
                historial_zonas.precio historia_precio,
                historial_zonas.estado historia_estado,

                zonas.id zona_id,
                zonas.nombre zona_nombre,
                zonas.descripcion zona_descripcion')
            ->join('dominio_vehiculo', 'dominio_vehiculo.id = estadias.id_dominio_vehiculo')
            ->join('usuarios', 'usuarios.id = dominio_vehiculo.id_usuario')
            ->join('vehiculos', 'vehiculos.id = dominio_vehiculo.id_vehiculo')
            ->join('marcas', 'marcas.id = vehiculos.marca')
            ->join('modelos', 'modelos.id = vehiculos.modelo')
            ->join('historial_zonas', 'historial_zonas.id = estadias.id_historial_zona')
            ->join('zonas', 'zonas.id = historial_zonas.id_zona')
            ->where('dominio_vehiculo.id', $id_dominio)
            ->where('estadias.fecha_fin >=', $fechaActual)
            ->get()->getResultArray();
    }

    public
    function obtenerUltimaEstadiaActivaPorDominioId($id_dominio, $fechaActual)
    {

        return $this
            ->select('estadias.*,
                dominio_vehiculo.id dominio_vehiculo_id,

                vehiculos.id vehiculo_id, 
                vehiculos.patente vehiculo_patente, 
                marcas.nombre vehiculo_marca_nombre,
                modelos.nombre vehiculo_modelo_nombre,

                usuarios.id id_usuario,
                
                historial_zonas.comienzo historia_comienzo,
                historial_zonas.final historia_final,
                historial_zonas.precio historia_precio,
                historial_zonas.estado historia_estado,

                zonas.id zona_id,
                zonas.nombre zona_nombre,
                zonas.descripcion zona_descripcion')
            ->join('dominio_vehiculo', 'dominio_vehiculo.id = estadias.id_dominio_vehiculo')
            ->join('usuarios', 'usuarios.id = dominio_vehiculo.id_usuario')
            ->join('vehiculos', 'vehiculos.id = dominio_vehiculo.id_vehiculo')
            ->join('marcas', 'marcas.id = vehiculos.marca')
            ->join('modelos', 'modelos.id = vehiculos.modelo')
            ->join('historial_zonas', 'historial_zonas.id = estadias.id_historial_zona')
            ->join('zonas', 'zonas.id = historial_zonas.id_zona')
            ->where('dominio_vehiculo.id', $id_dominio)
            ->where('estadias.fecha_fin <=', $fechaActual)
            ->orderBy("estadias.fecha_fin", "DESC")
            ->get()->getFirstRow();
    }

    public
    function verificarEstadiasPagoPendientePorDominio($id_dominio, $fechaActual)
    {
        return $this
            ->select('estadias.*,
                dominio_vehiculo.id dominio_vehiculo_id,

                vehiculos.id vehiculo_id, 
                vehiculos.patente vehiculo_patente, 
                marcas.nombre vehiculo_marca_nombre,
                modelos.nombre vehiculo_modelo_nombre,
                
                usuarios.id id_usuario,
                
                historial_zonas.comienzo historial_comienzo,
                historial_zonas.final historial_final,
                historial_zonas.precio historial_precio,
                historial_zonas.estado historial_estado,
                
                zonas.id zona_id,
                zonas.nombre zona_nombre,
                zonas.descripcion zona_descripcion')
            ->join('dominio_vehiculo', 'dominio_vehiculo.id = estadias.id_dominio_vehiculo')
            ->join('usuarios', 'usuarios.id = dominio_vehiculo.id_usuario')
            ->join('vehiculos', 'vehiculos.id = dominio_vehiculo.id_vehiculo')
            ->join('marcas', 'marcas.id = vehiculos.marca')
            ->join('modelos', 'modelos.id = vehiculos.modelo')
            ->join('historial_zonas', 'historial_zonas.id = estadias.id_historial_zona')
            ->join('zonas', 'zonas.id = historial_zonas.id_zona')
            ->where('dominio_vehiculo.id', $id_dominio)
            ->where('estadias.fecha_fin <=', $fechaActual) //?
            ->where('pago_pendiente', true)
            ->get()->getResultArray();
    }

    public
    function verificarEstadiasExistentesActivas($id_usuario, $fechaActual)
    {
        return $this
            ->select('estadias.*,
                dominio_vehiculo.id dominio_vehiculo_id,
                usuarios.id id_usuario')
            ->join('dominio_vehiculo', 'dominio_vehiculo.id = estadias.id_dominio_vehiculo')
            ->join('usuarios', 'usuarios.id = dominio_vehiculo.id_usuario')
            ->where('id_usuario', $id_usuario)
            ->where('estadias.fecha_fin <=', $fechaActual)
            ->get()->getFirstRow();
    }

//para ver si se muestran las opciones de estacionar o desestacionar
    public
    function verificarEstadiasExistentesActivasIndefinidas($id_usuario, $fechaActual)
    {
        return $this
            ->select('estadias.*,
                dominio_vehiculo.id dominio_vehiculo_id,
                usuarios.id id_usuario')
            ->join('dominio_vehiculo', 'dominio_vehiculo.id = estadias.id_dominio_vehiculo')
            ->join('usuarios', 'usuarios.id = dominio_vehiculo.id_usuario')
            ->where('id_usuario', $id_usuario)

            ->where('estadias.fecha_fin >=', $fechaActual)
            ->orderBy("estadias.fecha_fin", "DESC")
            ->get()->getFirstRow();
    }

    public
    function verificarEstadiasPagoPendiente($id_usuario, $fechaActual)
    {
        return $this
            ->select('estadias.*,
                dominio_vehiculo.id dominio_vehiculo_id,

                vehiculos.id vehiculo_id, 
                vehiculos.patente vehiculo_patente, 
                marcas.nombre vehiculo_marca_nombre,
                modelos.nombre vehiculo_modelo_nombre,
                
                usuarios.id id_usuario,
                
                historial_zonas.comienzo historial_comienzo,
                historial_zonas.final historial_final,
                historial_zonas.precio historial_precio,
                historial_zonas.estado historial_estado,
                
                zonas.id zona_id,
                zonas.nombre zona_nombre,
                zonas.descripcion zona_descripcion')
            ->join('dominio_vehiculo', 'dominio_vehiculo.id = estadias.id_dominio_vehiculo')
            ->join('usuarios', 'usuarios.id = dominio_vehiculo.id_usuario')
            ->join('vehiculos', 'vehiculos.id = dominio_vehiculo.id_vehiculo')
            ->join('marcas', 'marcas.id = vehiculos.marca')
            ->join('modelos', 'modelos.id = vehiculos.modelo')
            ->join('historial_zonas', 'historial_zonas.id = estadias.id_historial_zona')
            ->join('zonas', 'zonas.id = historial_zonas.id_zona')
            ->where('id_usuario', $id_usuario)
            ->where('pago_pendiente', true)
            ->where('estadias.fecha_fin <=', $fechaActual)
            ->get()->getResultArray();
    }

}