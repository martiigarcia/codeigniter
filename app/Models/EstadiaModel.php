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


     //CONSULTA HECHA X EL CONSULTOR DE CONSULTAS (JAJANT):

    protected $queryAll = " 
    SELECT e.*, 
        dv.id AS dominio_vehiculo_id,
        
        v.patente AS vehiculo_patente,
        ma.nombre AS vehiculo_marca_nombre,
        mo.nombre AS vehiculo_modelo_nombre,
        
        u.nombre AS nombre_usuario,
        u.apellido AS apellido_usuario,
        u.dni AS dni_usuario,
        
        hz.comienzo AS historial_comienzo,
        hz.final AS historial_final,
        hz.precio AS historial_precio,
        hz.estado AS historial_estado,
        
        z.id AS zona_id,
        z.nombre AS zona_nombre,
        z.descripcion AS zona_descripcion
    FROM estadias AS e 
        LEFT JOIN dominio_vehiculo AS dv ON e.id_dominio_vehiculo = dv.id 
        LEFT JOIN usuarios AS u ON dv.id_usuario = u.id 
        LEFT JOIN vehiculos AS v ON dv.id_vehiculo = v.id
        LEFT JOIN marcas AS ma ON v.marca = ma.id
        LEFT JOIN modelos AS mo ON v.modelo = mo.id 
        LEFT JOIN historial_zonas AS hz ON e.id_historial_zona = hz.id 
        LEFT JOIN zonas AS z ON hz.id_zona = z.id ";



    public
    function obtenerTodas()
    {
        return $this->db->query($this->queryAll)->getResultArray();

    }


    public
    function obtenerEstadiaById($id)
    {

        $query = $this->queryAll . "WHERE e.id = " . $id . " AND u.id = dv.id_usuario AND v.id = dv.id_vehiculo AND ma.id = v.marca AND mo.id = v.modelo AND hz.id = e.id_historial_zona  AND z.id = hz.id_zona";
        return $this->db->query($query)->getFirstRow();

    }


    public
    function estadiasActivas()
    {
        $query = $this->queryAll . "WHERE e.fecha_fin >= NOW() AND u.id = dv.id_usuario AND v.id = dv.id_vehiculo AND ma.id = v.marca AND mo.id = v.modelo AND hz.id = e.id_historial_zona  AND z.id = hz.id_zona";
        return $this->db->query($query)->getResultArray();

    }


    public
    function buscarPorDominioId($id_dominio)
    {
        $query = $this->queryAll . "WHERE dv.id = " . $id_dominio . " 
        AND u.id = dv.id_usuario AND v.id = dv.id_vehiculo AND ma.id = v.marca 
        AND mo.id = v.modelo AND hz.id = e.id_historial_zona  AND z.id = hz.id_zona";
        return $this->db->query($query)->getResultArray();

    }


    public
    function estadiasActivasPorDominioId($id_dominio)
    {
        $query = $this->queryAll . "WHERE dv.id = " . $id_dominio . " AND e.fecha_fin >= NOW() 
         AND u.id = dv.id_usuario AND v.id = dv.id_vehiculo AND ma.id = v.marca AND mo.id = v.modelo AND hz.id = e.id_historial_zona  AND z.id = hz.id_zona";
        return $this->db->query($query)->getResultArray();


    }


    public
    function obtenerUltimaEstadiaActivaPorDominioId($id_dominio)
    {
        //e.fecha_fin >= NOW() para obtener las activas
        //ORDER BY e.fecha_fin DESC para obtener la mas reciente

        $query = $this->queryAll . "WHERE dv.id = " . $id_dominio . " AND e.fecha_fin >= NOW() 
         AND u.id = dv.id_usuario AND v.id = dv.id_vehiculo AND ma.id = v.marca AND mo.id = v.modelo AND hz.id = e.id_historial_zona  AND z.id = hz.id_zona 
         ORDER BY e.fecha_fin DESC";
        return $this->db->query($query)->getFirstRow();


    }

    public
    function verificarEstadiasPagoPendientePorDominio($id_dominio)
    {
        $query = $this->queryAll . "WHERE dv.id = " . $id_dominio . " AND u.id = dv.id_usuario AND v.id = dv.id_vehiculo AND ma.id = v.marca AND mo.id = v.modelo AND hz.id = e.id_historial_zona  AND z.id = hz.id_zona 
        AND e.pago_pendiente = true";
        return $this->db->query($query)->getResultArray();

    }


    //para ver si se muestran las opciones de estacionar o desestacionar
    public
    function verificarEstadiasExistentesActivasIndefinidas($id_usuario)
    {

        //e.fecha_fin >= NOW() para obtener las activas
        //e.duracion_definida = false para obtener las que esten indefinidas
        //ORDER BY e.fecha_fin DESC para obtener la mas reciente

        $query = $this->queryAll . "WHERE u.id = " . $id_usuario . " AND e.fecha_fin >= NOW() AND e.duracion_definida = false 
         AND v.id = dv.id_vehiculo AND ma.id = v.marca AND mo.id = v.modelo AND hz.id = e.id_historial_zona  AND z.id = hz.id_zona 
         ORDER BY e.fecha_fin DESC";
        return $this->db->query($query)->getFirstRow();

    }

    public
    function verificarEstadiasPagoPendientePorUsuario($id_usuario)
    {
        //e.pago_pendiente = true para obtener las que no hayan sido pagadas (con pago pendiente)

        $query = $this->queryAll . "WHERE u.id = " . $id_usuario . " AND e.pago_pendiente = true 
         AND v.id = dv.id_vehiculo AND ma.id = v.marca AND mo.id = v.modelo AND hz.id = e.id_historial_zona  AND z.id = hz.id_zona";
        return $this->db->query($query)->getResultArray();

    }


    public
    function buscarPorUsuarioId($id_usuario)
    {
        $query = $this->queryAll . "WHERE u.id = " . $id_usuario . " AND v.id = dv.id_vehiculo AND ma.id = v.marca AND mo.id = v.modelo AND hz.id = e.id_historial_zona  AND z.id = hz.id_zona";
        return $this->db->query($query)->getResultArray();

    }
}

