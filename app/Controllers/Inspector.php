<?php

namespace App\Controllers;

use App\Models\DominioVehiculoModel;
use App\Models\EstadiaModel;
use App\Models\HistorialZonaModel;
use App\Models\InfraccionModel;
use App\Models\UserModel;
use App\Models\ZonaModel;
use DateTime;

class Inspector extends BaseController
{
    //funcionalidad del inspector
    public function verConsultaEstacionamiento()
    {
        if (!$this->esInspector()) {
            return redirect()->to(base_url());
        }

        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $estadiaModel = new EstadiaModel();

        $dominioVehiculoModel = new DominioVehiculoModel();
        $data['dominiosTotales'] = $dominioVehiculoModel->obtenerTodos();

        $data['estadias'] = $estadiaModel->obtenerTodas();
        $estados[] = null;
        $i = 0;
        foreach ($data['estadias'] as $infoEstadia) {
            $estados[$i] = $this->verificarEstados( $infoEstadia['fecha_fin']);
            $i++;
        }
        $data['estados'] = $estados;

        $cantidadDeHoras[] = null;
        $i = 0;
        foreach ($data['estadias'] as $infoEstadia) {
            $cantidadDeHoras[$i] = $this->calcularHoras($infoEstadia['fecha_inicio'], $infoEstadia['fecha_fin']);
            $i++;
        }
        $data['cantidad_horas'] = $cantidadDeHoras;

        return view('viewInspector/viewMasterConsultarEstacionamiento', $data);
    }

    public function verDetalleEstacionamiento($id)
    {
        if ((!$this->esInspector())) {
            return redirect()->to(base_url());
        }

        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $estadiaModel = new EstadiaModel();

        $dominioVehiculoModel = new DominioVehiculoModel();
        $data['dominiosTotales'] = $dominioVehiculoModel->obtenerTodos();

        $data['estadiaSeleccionada'] = $estadiaModel->obtenerEstadiaById($id);

        $data['estadiaSeleccionada']['monto'] = $this->calcularMontoDeEstadia($data['estadiaSeleccionada']['fecha_inicio'],
            $data['estadiaSeleccionada']['fecha_fin'],
            $data['estadiaSeleccionada']['historial_precio']);

        $cantidadDeHoras = $this->calcularHoras($data['estadiaSeleccionada']['fecha_inicio'], $data['estadiaSeleccionada']['fecha_fin']);
        $data['cantidad_horas'] = $cantidadDeHoras;

        $estado = $this->verificarEstados( $data['estadiaSeleccionada']['fecha_fin']);
        $data['estado'] = $estado;

        return view('detalleEstacionamiento', $data);
    }

    public function verRegistrarInfraccion($dominio)
    {
        if (!$this->esInspector()) {
            return redirect()->to(base_url());
        }

        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $zonaModel = new ZonaModel();

        $data['dominio'] = $dominio;

        $data['zonas'] = $zonaModel->findAll();

        $dominioVehiculoModel = new DominioVehiculoModel();
        $data['dominiosTotales'] = $dominioVehiculoModel->obtenerTodos();

        return view('viewInspector/viewMasterRegistrarInfraccion', $data);
    }

    public function registrarInfraccion()
    {
        if (!$this->esInspector()) {
            return redirect()->to(base_url());
        }


        $validacion = $this->validate([
            'calle' => 'required',
            'altura' => 'required',
            'dominio' => 'required',
            'id_zona' => 'required',
            'historial_zona' => 'required',
        ]);

        if ($validacion) {

            $infraccionModel = new InfraccionModel();
            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $fechaInicio = (new DateTime())->format('Y-m-d H:i:s');
            $data = [
                'dia_hora' => $fechaInicio,
                'calle' => $_POST['calle'],
                'altura' => $_POST['altura'],
                'id_dominio_vehiculo' => $_POST['dominio'],
                'id_historial_zona' => $_POST['historial_zona']
            ];
            $infraccionModel->save($data);
            session()->setFlashdata('mensaje', 'La infraccion se registro exitosamente');
            return redirect()->to(base_url('/home'));

        } else {

            $error = $this->validator->getErrors();
            session()->setFlashdata($error);
            return redirect()
                ->back()
                ->withInput();

        }

    }

    public function consultarEstadiaVehiculo($dominio)
    {
        if (!$this->esInspector()) {
            return redirect()->to(base_url());
        }

        $fechaAcual = (new DateTime())->format('Y-m-d H:i:s');

        $estadiasModel = new EstadiaModel();
        $tieneEstadias = $estadiasModel->estadiasActivasPorDominioId($dominio, $fechaAcual);

        if ($tieneEstadias == NULL) {
            return json_encode(true);

        } else
            return json_encode(false);


    }

    private function esInspector()
    {
        if (session('rol') === '3') {
            return true;
        }
        return false;
    }

    public function obtenerHistoralZona($idZona)
    {
        if (!$this->esInspector()) {
            return redirect()->to(base_url());
        }

        $historalZonaModel = new HistorialZonaModel();
        return json_encode($historalZonaModel->obtenerZonas($idZona));

    }

    private function calcularHoras($fecha_inicio, $fecha_fin): string
    {
        $fechaDeInicio = new DateTime($fecha_inicio);
        $fechaDeFin = new DateTime($fecha_fin);

        $diferenciaDeHoras = $fechaDeInicio->diff($fechaDeFin);
        $hora = $diferenciaDeHoras->h . ':' . $diferenciaDeHoras->i . ':' . $diferenciaDeHoras->s;

        return $hora;
    }

    private function calcularMontoDeEstadia($fecha_inicio, $fecha_fin, $precio): string
    {


        $fechaDeInicio = new DateTime($fecha_inicio);
        $fechaDeFin = new DateTime($fecha_fin);

        $diferenciaDeHoras = $fechaDeInicio->diff($fechaDeFin);
        $hora = $diferenciaDeHoras->h * 3600;
        $min = $diferenciaDeHoras->i * 60;
        $seg = $diferenciaDeHoras->s;
        $monto = (($hora + $min + $seg) * $precio) / 3600;

        return number_format($monto, 2, '.', '');

    }

    private function verificarEstados($fecha_fin){
        $fechaActual = (new DateTime())->format('Y-m-d H:i:s');

        if($fecha_fin>$fechaActual){
            return true; //esta activa
        }else{
            return false; //termino
        }
    }
}