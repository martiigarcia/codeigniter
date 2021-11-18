<?php

namespace App\Controllers;

use App\Models\DominioVehiculoModel;
use App\Models\EstadiaModel;
use App\Models\HistorialZonaModel;
use App\Models\MarcaModel;
use App\Models\ModeloModel;
use App\Models\UserModel;
use App\Models\VehiculoModel;
use App\Models\ZonaModel;
use DateTime;

class Cliente extends BaseController
{

    public function verRegistroVehiculo()
    {
        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }
        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $marcaModel = new MarcaModel();
        $data['marcas'] = $marcaModel->findAll();

        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->verificarEstadiasExistentesActivasIndefinidas(session('id'));
        //dd($data);

        $dominioVehiculoModel = new DominioVehiculoModel();
        $data['dominio'] = $dominioVehiculoModel->tieneVehiculos(session('id'));

        return view('viewCliente/viewMasterRegistrarVehiculo', $data);
    }

    public function obtenerModelosPorMarca($id)
    {
        $modeloModel = new ModeloModel();
        return json_encode($modeloModel->obtenerModelosPorMarcas($id));
    }

    public function registrarVehiculo()
    {
        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }
        $_POST['patente'] = strtoupper($_POST['patente']);//cambiar formato de patente a mayúsculas
        $validacion = $this->validate([
            'patente' => 'required|alpha_numeric|regex_match[/(^[a-zA-Z]{2}[0-9]{3}[a-zA-Z]{2}$)|(^[a-zA-Z]{3}[0-9]{3}$)|(^[a-zA-Z]{1}[0-9]{3}[a-zA-Z]{3}$)/]',
            'marca' => 'required',
            'modelo' => 'required',

        ]);
        if ($validacion) {
            $vehiculoModel = new VehiculoModel();
            $dominiVehiculoModel = new DominioVehiculoModel();
            $data = $vehiculoModel->obtenerPorPatente($_POST['patente']);

            //comprobar si el vehiculo ya existe
            if (!empty($data)) {
                //si existe comprobar que sean todos sus campos iguales
                if (($data->modelo === $_POST['modelo']) && ($data->marca === $_POST['marca'])) {
                    //comprobar si el vehiculo ya esta asociado al cliente
                    if (empty($dominiVehiculoModel->obtenerPorUsuario(session('id'), $data->id))) {
                        $dominioData = [
                            'id_usuario' => session('id'),
                            'id_vehiculo' => $data->id
                        ];
                        $dominiVehiculoModel->save($dominioData);
                        return redirect()->to(base_url('/home'));
                    } else {
                        return redirect()->back()->with('mensaje', 'Usted ya tiene registrado este vehiculo')
                            ->withInput();
                    }

                } else {
                    return redirect()->back()->with('mensaje', 'Ya existe un vehiculo con esta Patente, pero con Marca y Modelo diferentes')
                        ->withInput();
                }
            } else {

                $vehiculoModel->save($_POST);
                //volver a buscar el vehiculo para optener el id
                $data = $vehiculoModel->obtenerPorPatente($_POST['patente']);
                $dominioData = [
                    'id_usuario' => session('id'),
                    'id_vehiculo' => $data->id
                ];
                $dominiVehiculoModel->save($dominioData);
                session()->setFlashdata('mensaje', 'El vehiculo se registro correctamente');
                return redirect()->to(base_url('/home'));
            }
        } else {
            $error = $this->validator->getErrors();
            session()->setFlashdata($error);
            return redirect()->back()
                ->withInput();

        }

    }

    public function verEstacionar()
    {
        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }
        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->verificarEstadiasExistentesActivasIndefinidas(session('id'));


        $dominioVehiculoModel = new DominioVehiculoModel();
        $data['dominio'] = $dominioVehiculoModel->tieneVehiculos(session('id'));
        $fechaAcual = (new DateTime())->format('Y-m-d H:i:s');


        $i = 0;
        foreach ($data['dominio'] as $dom) {
            $listadoDominio = $dominioVehiculoModel->obtenerDominioPorIdVehiculo($dom['id_vehiculo']);

            foreach ($listadoDominio as $dominio) {
                $estadias = $estadiaModel->buscarPorDominioId($dominio['id']);
                if (!empty($estadias)) {
                    foreach ($estadias as $estadia) {
                        if ($estadia['fecha_fin'] > $fechaAcual) {

                            unset($data['dominio'][$i]);
                        }
                    }
                }
            }
                $i++;

        }

        $marcaModel = new MarcaModel();
        $data['marcas'] = $marcaModel->findAll();

        $zonaModel = new ZonaModel();
        $data['zonas'] = $zonaModel->findAll();

        return view('viewCliente/viewMasterEstacionar', $data);
    }

    public function estacionar()
    {
        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }

        $estadiaModel = new EstadiaModel();

        //crear la estadia en la base
        //agregar los parametros de horas(puede ser nulo)
        //con las horas poner si es definida o no
        //siempre el etado es activa cuando se crea
        //la fecha se pone con la finalizacion
        //ver si el pago esta pendiente o no

        $validacion = $this->validate([
            'dominio_vehiculo' => 'required',
            'id_zona' => 'required'
        ]);
        if ($validacion) {
            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $fechaInicio = (new DateTime())->format('Y-m-d H:i:s');
            $historialZonasModel = new HistorialZonaModel();
            $infoZonas = $historialZonasModel->obtenerZonas($_POST['id_zona']);

            if (sizeof($infoZonas) === 1) {
                if (!($this->esFechaValidaParaEstacionar($fechaInicio, $infoZonas[0]['comienzo'], $infoZonas[0]['final']))) {
                    return redirect()->back()->with('errorHoraDeInicio', 'Se encuentra fuera del horario de estacionamiento el Horario es de Lunes a Viernes de: '
                        . $infoZonas[0]['comienzo'] . 'hs a ' . $infoZonas[0]['final'] . 'hs')
                        ->withInput();
                }
            }

            if (!(($this->esFechaValidaParaEstacionar($fechaInicio, $infoZonas[0]['comienzo'], $infoZonas[0]['final'])) ||
                ($this->esFechaValidaParaEstacionar($fechaInicio, $infoZonas[1]['comienzo'], $infoZonas[1]['final'])))) {
                return redirect()->back()->with('errorHoraDeInicio', 'Se encuentra fuera del horario de estacionamiento el Horario es de Lunes a Viernes de: '
                    . $infoZonas[0]['comienzo'] . 'hs a ' . $infoZonas[0]['final'] . 'hs y de ' . $infoZonas[1]['comienzo'] . 'hs a ' . $infoZonas[1]['final'] . 'hs')
                    ->withInput();
            }

            if (empty($_POST['cantidad_horas'])) {

                $estadoDefinido = false;

                //seleccionar el turno correspondiente para la hora de fin de estadia
                $fechaFin = $this->verificarTurno($fechaInicio, $infoZonas[0]['comienzo'], $infoZonas[0]['final']);
                if ($fechaFin === null) {
                    $fechaFin = $this->verificarTurno($fechaInicio, $infoZonas[1]['comienzo'], $infoZonas[1]['final']);

                }


            } else {
                $estadoDefinido = true;
                $horasFin = explode(':', $_POST['cantidad_horas']);
                $fechaFin = (new DateTime())->setTime($horasFin[0], $horasFin[1])->format('Y-m-d H:i:s');

                if (!(($this->esFechaValidaParaEstacionar($fechaFin, $infoZonas[0]['comienzo'], $infoZonas[0]['final'])) ||
                    ($this->esFechaValidaParaEstacionar($fechaFin, $infoZonas[1]['comienzo'], $infoZonas[1]['final'])))) {
                    return redirect()->back()->with('errorDeCantidadDeHoras', 'El horario seleccionado se encuentra fuera del horario de estacionamiento. El Horario es de Lunes a Viernes de: '
                        . $infoZonas[0]['comienzo'] . 'hs a ' . $infoZonas[0]['final'] . 'hs y de ' . $infoZonas[1]['comienzo'] . 'hs a ' . $infoZonas[1]['final'] . 'hs' . "<br>" .
                        '(La hora seleccionada debe ser mayor a la actual)')
                        ->withInput();

                }

            }
            if ($fechaInicio>=$fechaFin){
                return redirect()->back()->with('errorDeCantidadDeHoras','(La hora seleccionada debe ser mayor a la actual)')
                    ->withInput();
            }
            $estadiaData = [
                'estado' => true,
                'duracion_definida' => $estadoDefinido,
                'fecha_inicio' => $fechaInicio,
                'fecha_fin' => $fechaFin,
                'pago_pendiente' => true, //esto cambiaria cuando se haga la parte de pagar en el estacionar
                'monto' => 0,
                'id_dominio_vehiculo' => $_POST['dominio_vehiculo'],
                'id_zona' => $_POST['id_zona'] //por defecto, cambiar cuando se recuperen las zonas

            ];

            $estadiaModel->save($estadiaData);
            session()->setFlashdata('mensaje', 'El vehiculo se estaciono correctamente');
            return redirect()->to(base_url('/home'));

        } else {
            $error = $this->validator->getErrors();
            session()->setFlashdata($error);
            return redirect()
                ->back()
                ->withInput();
        }


        //verificar si se ingreso a la opcion de pago o no-> se puede hacer con un cartel emergente del template

    }

    public function verDesEstacionar()
    {
        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }
        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->verificarEstadiasExistentesActivasIndefinidas(session('id'));

        //dd($data);

        $dominioVehiculoModel = new DominioVehiculoModel();
        $data['dominio'] = $dominioVehiculoModel->tieneVehiculos(session('id'));

        return view('viewCliente/viewMasterDesEstacionar', $data);
    }

    public function desEstacionar()
    {
        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }

        //poner:
        //estado=false(terminado)
        //duracion_definida =true (esta definida pq ya termino)
        //actualizar la cantidad de horas si no estaba(o sea si era indefinida)
        //actualizar la fecha de fin si no estaba(o sea si era indefinida)

        //actualizar el monto dependiendo de la zona, la hora y el precio x hora en la zona

        //actualizar si se paga o no en el momento de finalizacion(ver como se haria esto)


        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->find($_POST['id_estadia']);

        $data['estadia']['estado'] = false; //cambio el estado a inactiva
        $data['estadia']['duracion_definida'] = true; //cambio la duracion definida a true como definida

        $fechaAcual = (new DateTime())->format('Y-m-d H:i');
        if ($data['estadia']['fecha_fin'] >= $fechaAcual) {

            $data['estadia']['fecha_fin'] = $fechaAcual;
        }


        $estadiaModel->update($_POST['id_estadia'], $data['estadia']);
        session()->setFlashdata('mensaje', 'El vehiculo se desEstaciono correctamente');
        return redirect()->to(base_url('/home'));


    }

    public function verPagarEstadiasPendientes()
    {
        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }
        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->verificarEstadiasExistentesActivasIndefinidas(session('id'));
        $data['estadiasPendientes'] = $estadiaModel->verificarEstadiasPagoPendiente(session('id'));

        //dd($data);

        $dominioVehiculoModel = new DominioVehiculoModel();
        $data['dominio'] = $dominioVehiculoModel->tieneVehiculos(session('id'));

        return view('viewCliente/viewMasterPagarEstadiasPendientes', $data);
    }

    public function PagarEstadiasPendientes($id)
    {

        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }


        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->find($id);
        $data['estadia']['pago_pendiente'] = false;

        $estadiaModel->update($id, $data['estadia']);
        session()->setFlashdata('mensaje', 'Los datos se guardaron con exito');
        return redirect()->to(base_url('/home'));


    }

    private function esCliente()
    {
        if (session('rol') === '4') {
            return true;
        }
        return false;
    }

    private function esFechaValidaParaEstacionar($fecha, $inicio, $fin): bool
    {
        $horaInicio = explode(':', $inicio);
        $horaFin = explode(':', $fin);
        $fechaInicio = (new DateTime())->setTime($horaInicio[0], $horaInicio[1])->format('Y-m-d H:i:s');
        $fechaFin = (new DateTime())->setTime($horaFin[0], $horaFin[1])->format('Y-m-d H:i:s');
        $fechaActual = (new DateTime())->format('Y-m-d H:i');

        if (($fecha > $fechaActual) && ($fecha <= $fechaFin) && ($fecha >= $fechaInicio) && ($fechaActual >= $fechaInicio)
            && (strftime('%A') != 'Saturday') && (strftime('%A') != 'Sunday')) {

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


}