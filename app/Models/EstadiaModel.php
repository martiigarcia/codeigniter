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
        /* return $this
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
             ->get()->getResultArray();*/
    }


    public
    function obtenerEstadiaById($id)
    {

        $query = $this->queryAll . "WHERE e.id = " . $id . " AND u.id = dv.id_usuario AND v.id = dv.id_vehiculo AND ma.id = v.marca AND mo.id = v.modelo AND hz.id = e.id_historial_zona  AND z.id = hz.id_zona";
        return $this->db->query($query)->getFirstRow();
        /*return $this
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
            ->find($id);*/
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
        /*return $this
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
            ->get()->getResultArray();*/
    }


    public
    function estadiasActivasPorDominioId($id_dominio)
    {
        $query = $this->queryAll . "WHERE dv.id = " . $id_dominio . " AND e.fecha_fin >= NOW() 
         AND u.id = dv.id_usuario AND v.id = dv.id_vehiculo AND ma.id = v.marca AND mo.id = v.modelo AND hz.id = e.id_historial_zona  AND z.id = hz.id_zona";
        return $this->db->query($query)->getResultArray();

        /* return $this
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
            ->get()->getResultArray();*/
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

       /* return $this
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
            ->orderBy("estadias.fecha_fin", "DESC")
            ->get()->getFirstRow();*/
    }

    public
    function verificarEstadiasPagoPendientePorDominio($id_dominio)
    {
        $query = $this->queryAll . "WHERE dv.id = " . $id_dominio . " AND u.id = dv.id_usuario AND v.id = dv.id_vehiculo AND ma.id = v.marca AND mo.id = v.modelo AND hz.id = e.id_historial_zona  AND z.id = hz.id_zona 
        AND e.pago_pendiente = true";
        return $this->db->query($query)->getResultArray();
        /*return $this
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
            ->where('estadias.fecha_fin >=', $fechaActual) //?
            ->where('pago_pendiente', true)
            ->get()->getResultArray();*/
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

       /* return $this
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
            ->where('estadias.fecha_fin >=', $fechaActual)
            ->get()->getResultArray();*/
    }


    public
    function buscarPorUsuarioId($id_usuario)
    {
        $query = $this->queryAll . "WHERE u.id = " . $id_usuario . " AND v.id = dv.id_vehiculo AND ma.id = v.marca AND mo.id = v.modelo AND hz.id = e.id_historial_zona  AND z.id = hz.id_zona";
        return $this->db->query($query)->getResultArray();

        /*return $this
            ->select('estadias.*,
            dominio_vehiculo.id dominio_vehiculo_id,usuarios.id id_usuario')
            ->join('dominio_vehiculo', 'dominio_vehiculo.id = estadias.id_dominio_vehiculo')
            ->join('usuarios', 'usuarios.id = dominio_vehiculo.id_usuario')
            ->where('usuarios.id', $id_usuario)
            ->get()->getResultArray();*/
    }
}



/*protected $queryAll = "SELECT estadias.*,

dominio_vehiculo.id AS dominio_vehiculo_id,

vehiculos.patente AS vehiculo_patente,
marcas.nombre AS vehiculo_marca_nombre,
modelos.nombre AS vehiculo_modelo_nombre,

usuarios.nombre AS nombre_usuario,
usuarios.apellido AS apellido_usuario,
usuarios.dni AS dni_usuario,

historial_zonas.comienzo AS historia_comienzo,
historial_zonas.final AS historia_final,
historial_zonas.precio AS historia_precio,
historial_zonas.estado AS historia_estado,

zonas.id AS zona_id,
zonas.nombre AS zona_nombre,
zonas.descripcion AS zona_descripcion

FROM estadias, dominio_vehiculo, vehiculos, marcas, modelos, usuarios, historial_zonas, zonas
";*/


/* public function eliminarCuentaUsuario($id_usuario)

 {
     //$query = "DELETE FROM `estadias` WHERE `id_usuario`=" . $id_usuario;
    // $query = "SELECT FROM " + $this->selectQueryAll + $this->joinsQueryAll;
     $this->db->query($query);
 }*/

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

/* no se encontraron usos?
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
            ->where('estadias.fecha_fin >=', $fechaActual)
            ->get()->getFirstRow();
    }*/