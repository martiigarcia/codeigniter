<?php

namespace App\Controllers;

use App\Models\DominioVehiculoModel;
use App\Models\EstadiaModel;
use App\Models\HistorialZonaModel;
use App\Models\MarcaModel;
use App\Models\UserModel;
use App\Models\VentaModel;
use App\Models\ZonaModel;
use DateTime;
use phpDocumentor\Reflection\Types\Boolean;

class Vendedor extends BaseController
{
    private $idHistorialZona;

    public function verVenderEstadiaListadoVehiculo()
    {
        if (!$this->esVendedor()) {
            return redirect()->to(base_url());
        }

        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $dominioModel = new DominioVehiculoModel();
        $data2['dominio_vehiculos'] = $dominioModel->obtenerTodos();
        $data['dominio_vehiculos'] = $data2['dominio_vehiculos'];

        $fechaAcual = (new DateTime())->format('Y-m-d H:i:s');

        $estadiaModel = new EstadiaModel();


        for ($j = 0; $j < sizeof($data2['dominio_vehiculos']); $j++) {

            $id_dominio = $data2['dominio_vehiculos'][$j]['id'];
            $id_vehiculo = $data2['dominio_vehiculos'][$j]['id_vehiculo'];
            $id_usuario = $data2['dominio_vehiculos'][$j]['id_usuario'];

            $estadias = $estadiaModel->buscarPorDominioId($id_dominio);

            if (!empty($estadias)) {
                for ($i = 0; $i < sizeof($estadias); $i++) {
                    if ($estadias[$i]['fecha_fin'] >= $fechaAcual) {
                        $data['dominio_vehiculos'] = array_filter($data['dominio_vehiculos'], function ($valor) use ($id_vehiculo, $id_usuario) {

                            return (($valor['id_vehiculo'] !== $id_vehiculo) && ($valor['id_usuario'] !== $id_usuario));
                        });

                    }
                }
            }
        }

        return view('viewVendedor/viewMasterListadoVehiculos', $data);
    }

    public function verVenderEstadia($id_dominio)
    {
        if (!$this->esVendedor()) {
            return redirect()->to(base_url());
        }

        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $marcaModel = new MarcaModel();
        $data['marcas'] = $marcaModel->findAll();


        $dominioModel = new DominioVehiculoModel();
        $data['dominio'] = $dominioModel->obtenerPorId($id_dominio);

        $zonaModel = new ZonaModel();
        $data['zonas'] = $zonaModel->findAll();


        return view('viewVendedor/viewMasterVender', $data);

    }

    public function estacionar($valor)
    {
        $this->idHistorialZona = 0;
        if (!$this->esVendedor()) {
            return redirect()->to(base_url());
        }

        $validacion = $this->validate([
            'id_zona' => 'required',
            'cantidad_horas' => 'required'
        ]);
        if ($validacion) {


            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $fechaInicio = (new DateTime())->format('Y-m-d H:i:s');
            $historialZonasModel = new HistorialZonaModel();
            $infoZonas = $historialZonasModel->obtenerZonas($_POST['id_zona']);

            //dependiendo de cuantas zonas traiga se usa 1 o 2 validaciones, porque pueden ser hasta 2 turnos
            if (sizeof($infoZonas) === 1) {
                if (!($this->esFechaValidaParaEstacionar($fechaInicio, $infoZonas[0]['comienzo'], $infoZonas[0]['final'], $infoZonas[0]['id']))) {

                    return (json_encode('Se encuentra fuera del horario de estacionamiento el Horario es de Lunes a Viernes de: ' . $infoZonas[0]['comienzo'] . 'hs a ' . $infoZonas[0]['final'] . 'hs'));

                }
            }

            if (!(($this->esFechaValidaParaEstacionar($fechaInicio, $infoZonas[0]['comienzo'], $infoZonas[0]['final'], $infoZonas[0]['id'])) ||
                ($this->esFechaValidaParaEstacionar($fechaInicio, $infoZonas[1]['comienzo'], $infoZonas[1]['final'], $infoZonas[1]['id'])))) {

                return json_encode('Se encuentra fuera del horario de estacionamiento el Horario es de Lunes a Viernes de: '
                    . $infoZonas[0]['comienzo'] . 'hs a ' . $infoZonas[0]['final'] . 'hs y de ' . $infoZonas[1]['comienzo'] . 'hs a ' . $infoZonas[1]['final'] . 'hs');
            }

            $estadiaModel = new EstadiaModel();

            if (empty($_POST['cantidad_horas'])) {

                $duracionDefinida = false;

                //seleccionar el turno correspondiente para la hora de fin de estadia
                $fechaFin = $this->verificarTurno($fechaInicio, $infoZonas[0]['comienzo'], $infoZonas[0]['final']);
                if ($fechaFin === null) {
                    $fechaFin = $this->verificarTurno($fechaInicio, $infoZonas[1]['comienzo'], $infoZonas[1]['final']);
                }

            } else {

                $duracionDefinida = false;
                $horasFin = explode(':', $_POST['cantidad_horas']);
                $fechaFin = (new DateTime())->setTime($horasFin[0], $horasFin[1])->format('Y-m-d H:i:s');

                if (!(($this->esFechaValidaParaEstacionar($fechaFin, $infoZonas[0]['comienzo'], $infoZonas[0]['final'], $infoZonas[0]['id'])) ||
                    ($this->esFechaValidaParaEstacionar($fechaFin, $infoZonas[1]['comienzo'], $infoZonas[1]['final'], $infoZonas[1]['id'])))) {


                    return json_encode('El horario seleccionado se encuentra fuera del horario de estacionamiento. El Horario es de Lunes a Viernes de: '
                        . $infoZonas[0]['comienzo'] . 'hs a ' . $infoZonas[0]['final'] . 'hs y de ' . $infoZonas[1]['comienzo'] . 'hs a ' . $infoZonas[1]['final'] . 'hs' .
                        '(La hora seleccionada debe ser mayor a la actual)');
                }
            }


            $estadiaData = [

                'duracion_definida' => $duracionDefinida,
                'fecha_inicio' => $fechaInicio,
                'fecha_fin' => $fechaFin,
                'pago_pendiente' => !filter_var($valor, FILTER_VALIDATE_BOOLEAN),
                'id_dominio_vehiculo' => $_POST['dominio_vehiculo'],
                'id_historial_zona' => $this->idHistorialZona

            ];
            $estadiaModel->save($estadiaData);

            $listadoDeEstadias = $estadiaModel->obtenerUltimaEstadiaActivaPorDominioId($_POST['dominio_vehiculo']);
            $idEstadia = $listadoDeEstadias->id;

            $infoVenta = [
                'esta_pago' => !filter_var($valor, FILTER_VALIDATE_BOOLEAN),
                'id_vendedor' => session('id'),
                'id_estadia' => $idEstadia
            ];

            $ventaModel = new VentaModel();
            $ventaModel->save($infoVenta);

            session()->setFlashdata('mensaje', 'El vehiculo se estaciono correctamente');
            return (json_encode(true));

        } else {

            return (json_encode("La zona y la cantidad de horas son requeridas"));
        }
    }

    public function verListadoVentas()
    {
        if (!$this->esVendedor()) {
            return redirect()->to(base_url());
        }

        $userModel = new UserModel();
        $ventaModel = new VentaModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session('username'));
        $data['ventas'] = $ventaModel->obtenerPorVendedor(session('id'));

        return view('viewVendedor/viewMasterListadoVentas', $data);
    }

    private function esFechaValidaParaEstacionar($fecha, $inicio, $fin, $idHistorialZona): bool
    {
        $horaInicio = explode(':', $inicio);
        $horaFin = explode(':', $fin);
        $fechaInicio = (new DateTime())->setTime($horaInicio[0], $horaInicio[1])->format('Y-m-d H:i:s');
        $fechaFin = (new DateTime())->setTime($horaFin[0], $horaFin[1])->format('Y-m-d H:i:s');
        $fechaActual = (new DateTime())->format('Y-m-d H:i');

        if (($fecha >= $fechaActual) && ($fecha <= $fechaFin) && ($fecha >= $fechaInicio) && ($fechaActual >= $fechaInicio)
            && (strftime('%A') != 'Saturday') && (strftime('%A') != 'Sunday')) {
            $this->idHistorialZona = $idHistorialZona;
            return true;
        }
        return false;
    }

    private function verificarTurno($fecha, $inicio, $fin): ?string
    {
        $horaInicio = explode(':', $inicio);
        $horaFin = explode(':', $fin);
        $fechaInicio = (new DateTime())->setTime($horaInicio[0], $horaInicio[1])->format('Y-m-d H:i:s');
        $fechaFin = (new DateTime())->setTime($horaFin[0], $horaFin[1])->format('Y-m-d H:i:s');


        if (($fecha <= $fechaFin) && ($fecha >= $fechaInicio)) {

            return $fechaFin;
        }
        return null;
    }

    private function esVendedor()
    {
        if (session('rol') === '2') {
            return true;
        }
        return false;
    }
}