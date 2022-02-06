<?php

namespace App\Controllers;

use App\Models\CuentaModel;
use App\Models\DominioVehiculoModel;
use App\Models\EstadiaModel;
use App\Models\HistorialZonaModel;
use App\Models\InfraccionModel;
use App\Models\MarcaModel;
use App\Models\ModeloModel;
use App\Models\TarjetaDeCreditoModel;
use App\Models\UserModel;
use App\Models\VehiculoModel;
use App\Models\ZonaModel;
use DateTime;

class Cliente extends BaseController
{


    private $idHistorialZona;
    private const DEUDA_MAXIMA_PERMITIDA = 500;


    //registrar vehiculo:
    public function verRegistroVehiculo()
    {
        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }
        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $cuentaModel = new CuentaModel();
        $cuenta = $cuentaModel->obtenerCuentaDeUsuario(session('id'));
        $data['montoTotalDeCuenta'] = $cuenta->monto_total;

        $marcaModel = new MarcaModel();
        $data['marcas'] = $marcaModel->findAll();


        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->verificarEstadiasExistentesActivasIndefinidas(session('id'));
        $data['estadiasPendientes'] = $estadiaModel->verificarEstadiasPagoPendientePorUsuario(session('id'));

        $dominioVehiculoModel = new DominioVehiculoModel();
        $data['dominio'] = $dominioVehiculoModel->tieneVehiculos(session('id'));

        $tarjetaModel = new TarjetaDeCreditoModel();
        $data['tarjetas'] = $tarjetaModel->obtenerTarjetasPorUsuario(session('id'));

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
                        return redirect()->back()->with('mensajeError', 'Usted ya tiene registrado este vehiculo')
                            ->withInput();
                    }

                } else {
                    return redirect()->back()->with('mensajeError', 'Ya existe un vehiculo con esta patente, pero con marca y modelo diferentes')
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


    //estacionar:
    public function verEstacionar()
    {
        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }

        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $cuentaModel = new CuentaModel();
        $cuenta = $cuentaModel->obtenerCuentaDeUsuario(session('id'));
        $data['montoTotalDeCuenta'] = $cuenta->monto_total;

        $fechaAcual = (new DateTime())->format('Y-m-d H:i:s');

        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->verificarEstadiasExistentesActivasIndefinidas(session('id'));
        $data['estadiasPendientes'] = $estadiaModel->verificarEstadiasPagoPendientePorUsuario(session('id'));

        if (!empty($data['estadia'])) {
            return redirect()->to(base_url());
        }

        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->verificarEstadiasExistentesActivasIndefinidas(session('id'));
        $data['estadiasPendientes'] = $estadiaModel->verificarEstadiasPagoPendientePorUsuario(session('id'));

        $dominioVehiculoModel = new DominioVehiculoModel();
        $data['dominio'] = $dominioVehiculoModel->tieneVehiculos(session('id'));
        //recupera una lista de dominios segun el usuario actual

        $i = 0;
        foreach ($data['dominio'] as $dom) {
            $listadoDominio = $dominioVehiculoModel->obtenerDominioPorIdVehiculo($dom['id_vehiculo']);
            //recupera un listado de dominios segun el vehiculo

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


        $tarjetaModel = new TarjetaDeCreditoModel();
        $data['tarjetas'] = $tarjetaModel->obtenerTarjetasPorUsuario(session('id'));

        return view('viewCliente/viewMasterEstacionar', $data);
    }

    public function estacionar()
    {

        $this->idHistorialZona = 0;
        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }

        $estadiaModel = new EstadiaModel();

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
                if (!($this->esFechaValidaParaEstacionar($fechaInicio, $infoZonas[0]['comienzo'], $infoZonas[0]['final'], $infoZonas[0]['id']))) {
                    return redirect()->back()->with('errorHoraDeInicio', 'Se encuentra fuera del horario de estacionamiento el Horario es de Lunes a Viernes de: '
                        . $infoZonas[0]['comienzo'] . 'hs a ' . $infoZonas[0]['final'] . 'hs')
                        ->withInput();
                }
            }

            if (!(($this->esFechaValidaParaEstacionar($fechaInicio, $infoZonas[0]['comienzo'], $infoZonas[0]['final'], $infoZonas[0]['id'])) ||
                ($this->esFechaValidaParaEstacionar($fechaInicio, $infoZonas[1]['comienzo'], $infoZonas[1]['final'], $infoZonas[1]['id'])))) {
                return redirect()->back()->with('errorHoraDeInicio', 'Se encuentra fuera del horario de estacionamiento el Horario es de Lunes a Viernes de: '
                    . $infoZonas[0]['comienzo'] . 'hs a ' . $infoZonas[0]['final'] . 'hs y de ' . $infoZonas[1]['comienzo'] . 'hs a ' . $infoZonas[1]['final'] . 'hs')
                    ->withInput();
            }


            if (empty($_POST['cantidad_horas'])) {

                $duracionDefinida = false; //porque es indefinido entonces se va a terminar cuando finalice el turno actual

                //seleccionar el turno correspondiente para la hora de fin de estadia
                $fechaFin = $this->verificarTurno($fechaInicio, $infoZonas[0]['comienzo'], $infoZonas[0]['final']);
                if ($fechaFin === null) {
                    $fechaFin = $this->verificarTurno($fechaInicio, $infoZonas[1]['comienzo'], $infoZonas[1]['final']);

                }

            } else {

                $duracionDefinida = true; //porque es definido por ende va a terminar a la hora que se haya seleccionado

                $horasFin = explode(':', $_POST['cantidad_horas']);
                $fechaFin = (new DateTime())->setTime($horasFin[0], $horasFin[1])->format('Y-m-d H:i:s');

                if (!(($this->esFechaValidaParaEstacionar($fechaFin, $infoZonas[0]['comienzo'], $infoZonas[0]['final'], $infoZonas[0]['id'])) ||
                    ($this->esFechaValidaParaEstacionar($fechaFin, $infoZonas[1]['comienzo'], $infoZonas[1]['final'], $infoZonas[1]['id'])))) {
                    return redirect()->back()->with('errorDeCantidadDeHoras', 'El horario seleccionado se encuentra fuera del horario de estacionamiento. El Horario es de Lunes a Viernes de: '
                        . $infoZonas[0]['comienzo'] . 'hs a ' . $infoZonas[0]['final'] . 'hs y de ' . $infoZonas[1]['comienzo'] . 'hs a ' . $infoZonas[1]['final'] . 'hs' . "<br>" .
                        '(La hora seleccionada debe ser mayor a la actual)')
                        ->withInput();

                }


            }
            if ($fechaInicio >= $fechaFin) {
                return redirect()->back()->with('errorDeCantidadDeHoras', '(La hora seleccionada debe ser mayor a la actual)')
                    ->withInput();
            }
            $estadiaData = [
                'duracion_definida' => $duracionDefinida, //false: horario indefinido || true: horario definido
                'fecha_inicio' => $fechaInicio,
                'fecha_fin' => $fechaFin,
                'pago_pendiente' => true, //true: pago pendiente || false: pago realizado
                'id_dominio_vehiculo' => $_POST['dominio_vehiculo'],
                'id_historial_zona' => $this->idHistorialZona
            ];
            $arrayEstadia = implode(',', $estadiaData);

            $historialZonaModel = new HistorialZonaModel();
            $historial_zona = $historialZonaModel->find($estadiaData['id_historial_zona']);
            $precio = $historial_zona['precio'];

            $montoAPagar = $this->calcularMontoDeEstadia($estadiaData['fecha_inicio'],
                $estadiaData['fecha_fin'],
                $precio);


            if ($estadiaData['duracion_definida']) {

                if ($this->verificarMontoDeudaActual($montoAPagar)) {

                    session()->setFlashdata('mensajePagar', '¿Desea pagar en este momento?');
                    return redirect()->back()->with('estadia', $arrayEstadia);

                } else {
                    session()->setFlashdata('error', 'No se puede registrar su estadia. El monto de su estadia excede el monto total que puede tener de deuda de estadias, el cual es de $' . self::DEUDA_MAXIMA_PERMITIDA);
                    return redirect()->back();
                }

            } else {

                if ($this->verificarMontoDeudaActual($montoAPagar)) {

                    $cuentaModel = new CuentaModel();
                    $cuenta = $cuentaModel->obtenerCuentaDeUsuario(session('id'));
                    $deudaCuenta = $cuenta->deuda;
                    $cuenta->deuda = number_format($deudaCuenta + $montoAPagar,2);

                    $cuentaModel->update($cuenta->id, $cuenta);
                    $estadiaModel->save($estadiaData);

                    session()->setFlashdata('mensaje', 'El vehiculo se estaciono correctamente');
                    return redirect()->to(base_url('/home'));

                } else {

                    session()->setFlashdata('error', 'No se puede registrar su estadia. El monto de su estadia (calculada hasta el fin de turno) excede el monto total que puede tener de deuda de estadias, el cual es de $' . self::DEUDA_MAXIMA_PERMITIDA);
                    return redirect()->back();

                }
            }

        } else {
            $error = $this->validator->getErrors();
            session()->setFlashdata($error);
            return redirect()
                ->back()
                ->withInput();
        }


    }

    public function estacionarYObtenerId($infoEstadia)
    {

        $arrayEstadia = explode(",", $infoEstadia);

        $estadiaData = [
            'duracion_definida' => $arrayEstadia[0], //false: horario indefinido || true: horario definido
            'fecha_inicio' => $arrayEstadia[1],
            'fecha_fin' => $arrayEstadia[2],
            'pago_pendiente' => $arrayEstadia[3], //true: pago pendiente || false: pago realizado
            'id_dominio_vehiculo' => $arrayEstadia[4],
            'id_historial_zona' => $arrayEstadia[5],
        ];
        $estadiaModel = new EstadiaModel();
        $estadiaModel->save($estadiaData);
        $estadiaActiva = $estadiaModel->obtenerUltimaEstadiaActivaPorDominioId($arrayEstadia[4]);

        return json_encode("" . $estadiaActiva->id);
    }

    public function dejarPendiente($id_estadia)
    {

        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->find($id_estadia);

        $historialZonaModel = new HistorialZonaModel();
        $historial_zona = $historialZonaModel->find($data['estadia']['id_historial_zona']);
        $precio = $historial_zona['precio'];

        $montoAPagar = $this->calcularMontoDeEstadia(
            $data['estadia']['fecha_inicio'],
            $data['estadia']['fecha_fin'],
            $precio);

        $cuentaModel = new CuentaModel();
        $cuenta = $cuentaModel->obtenerCuentaDeUsuario(session('id'));
        $deudaCuenta = $cuenta->deuda;
        $cuenta->deuda = number_format($deudaCuenta + $montoAPagar,2);

        $cuentaModel->update($cuenta->id, $cuenta);

        session()->setFlashdata('mensaje', 'La estadia finalizo correctamente');
        return redirect()->to(base_url('/home'));
    }


    //desestacionar:
    public function finalizarEstadia($id_estadia)
    {
        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }

        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->find($id_estadia);

        $historialZonaModel = new HistorialZonaModel();
        $historial_zona = $historialZonaModel->find($data['estadia']['id_historial_zona']);
        $precio = $historial_zona['precio'];

        $montoAPagar = $this->calcularMontoDeEstadia($data['estadia']['fecha_inicio'],
            $data['estadia']['fecha_fin'],
            $precio);

        $cuentaModel = new CuentaModel();
        $cuenta = $cuentaModel->obtenerCuentaDeUsuario(session('id'));
        $deudaCuenta = $cuenta->deuda;
        $cuenta->deuda = number_format($deudaCuenta - $montoAPagar,2);

        $cuentaModel->update($cuenta->id, $cuenta);

        $fechaActual = (new DateTime())->format('Y-m-d H:i:s');
        if ($data['estadia']['fecha_fin'] >= $fechaActual) {

            $data['estadia']['fecha_fin'] = $fechaActual;
        }
        $data['estadia']['duracion_definida'] = true;


        $estadiaModel->update($id_estadia, $data['estadia']);

        return json_encode("id estadia: " . $id_estadia);
    }

    public function pagarAhora($id_estadia) //para pagar en el momento de desestacionar
    {

        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }

        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->find($id_estadia);

        $cuentaModel = new CuentaModel();
        $cuenta = $cuentaModel->obtenerCuentaDeUsuario(session('id'));

        $historialZonaModel = new HistorialZonaModel();
        $historial_zona = $historialZonaModel->find($data['estadia']['id_historial_zona']);
        $precio = $historial_zona['precio'];

        $montoAPagar = $this->calcularMontoDeEstadia(
            $data['estadia']['fecha_inicio'],
            $data['estadia']['fecha_fin'],
            $precio);

        if ($cuenta->monto_total >= $montoAPagar) {

            $data['estadia']['pago_pendiente'] = false;

            $estadiaModel->update($id_estadia, $data['estadia']);
            $cuenta->monto_total = number_format($cuenta->monto_total - $montoAPagar,2);
            $cuentaModel->update($cuenta->id, $cuenta);

            return json_encode(true);
        } else {

            $data['estadia']['pago_pendiente'] = true;
            $estadiaModel->update($id_estadia, $data['estadia']);

            $deudaCuenta = $cuenta->deuda;
            $cuenta->deuda = number_format($deudaCuenta + $montoAPagar, 2);

            $cuentaModel->update($cuenta->id, $cuenta);
            return json_encode(false);
        }

    }


    //pagar pendientes:
    public function verPagarEstadiasPendientes()
    {
        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }

        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $cuentaModel = new CuentaModel();
        $cuenta = $cuentaModel->obtenerCuentaDeUsuario(session('id'));
        $data['montoTotalDeCuenta'] = $cuenta->monto_total;

        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->verificarEstadiasExistentesActivasIndefinidas(session('id'));

        $data['estadiasPendientes'] = $estadiaModel->verificarEstadiasPagoPendientePorUsuario(session('id'));

        for ($i = 0; $i < sizeof($data['estadiasPendientes']); $i++) {
            $data['estadiasPendientes'][$i]['monto'] = $this->calcularMontoDeEstadia($data['estadiasPendientes'][$i]['fecha_inicio'],
                $data['estadiasPendientes'][$i]['fecha_fin'],
                $data['estadiasPendientes'][$i]['historial_precio']);

        }

        $dominioVehiculoModel = new DominioVehiculoModel();
        $data['dominio'] = $dominioVehiculoModel->tieneVehiculos(session('id'));

        $cantidadDeHoras[] = null;
        $i = 0;
        foreach ($data['estadiasPendientes'] as $infoEstadia) {
            $cantidadDeHoras[$i] = $this->calcularHoras($infoEstadia['fecha_inicio'], $infoEstadia['fecha_fin']);
            $i++;
        }
        $data['cantidad_horas'] = $cantidadDeHoras;

        $estados[] = null;
        $i = 0;
        foreach ($data['estadiasPendientes'] as $infoEstadia) {
            $estados[$i] = $this->verificarEstados($infoEstadia['fecha_fin']);
            $i++;
        }
        $data['estados'] = $estados;

        $tarjetaModel = new TarjetaDeCreditoModel();
        $data['tarjetas'] = $tarjetaModel->obtenerTarjetasPorUsuario(session('id'));

        return view('viewCliente/viewMasterPagarEstadiasPendientes', $data);
    }

    public function pagarEstadiasPendientes($id, $valor) //pagar pagar desde estacionar y desde mis estadias pendientes
    {

        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }

        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->obtenerEstadiaById($id);

        $cuentaModel = new CuentaModel();
        $cuenta = $cuentaModel->obtenerCuentaDeUsuario(session('id'));

        $montoAPagar = $this->calcularMontoDeEstadia(
            $data['estadia']->fecha_inicio,
            $data['estadia']->fecha_fin,
            $data['estadia']->historial_precio);

        $cuentaModel->update($cuenta->id, $cuenta);

        if (($cuenta->monto_total >= $montoAPagar)) {

            $data['estadia']->pago_pendiente = false;

            $estadiaModel->update($id, $data['estadia']);

            if ($valor == 0) {
                $deudaCuenta = $cuenta->deuda;
                $cuenta->deuda =number_format($deudaCuenta - $montoAPagar,2) ;
            }

            $cuenta->monto_total =number_format($cuenta->monto_total - $montoAPagar,2) ;
            $cuentaModel->update($cuenta->id, $cuenta);
            if ($valor == 0) {
                session()->setFlashdata('mensaje', 'El pago se realizo exitosamente');
                return redirect()->back();
            }
            session()->setFlashdata('mensaje', 'El pago se realizo exitosamente');
            return redirect()->to(base_url('/home'));

        } else {
            session()->setFlashdata('error', 'Su cuenta no dispone del saldo necesario para realizar el pago en este momento. La estadia quedo en estado de ' . "pago pendiente" . '. Para abonarlo vaya a la seccion ' . "Mis estadias pendientes" . ' y seleccionela para pagar');
            return redirect()->back();
        }
    }

    private function verificarMontoDeudaActual($montoEstadia): bool
    {
        $cuentaModel = new CuentaModel();
        $cuenta = $cuentaModel->obtenerCuentaDeUsuario(session('id'));
        $deudaCuenta = $cuenta->deuda; //deuda actual que ya hay en la cuenta
        $deudaTotal = number_format($deudaCuenta + $montoEstadia,2); // deuda de la cuenta + monto de la estadia a registrar en el momento

        if ($deudaTotal < self::DEUDA_MAXIMA_PERMITIDA) {
            return true; //retorna true cuando el total de la deuda ya existe  + el monto de la estadia actual son MENORES al tamaño de la deuda maxima permitida
        }
        return false;//retorna true cuando el total de la deuda ya existe  + el monto de la estadia actual son MAYORES al tamaño de la deuda maxima permitida

    }


    //consultar estacionamiento:
    public function consultarVehiculo()
    {
        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }

        $validacion = $this->validate([
            'dominio_vehiculo' => 'required',
        ]);

        if ($validacion) {

            $userModel = new UserModel();
            $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

            $cuentaModel = new CuentaModel();
            $cuenta = $cuentaModel->obtenerCuentaDeUsuario(session('id'));
            $data['montoTotalDeCuenta'] = $cuenta->monto_total;

            $dominioVehiculoModel = new DominioVehiculoModel();
            $data['dominio'] = $dominioVehiculoModel->tieneVehiculos(session('id'));
            $data['dominioSeleccionado'] = $dominioVehiculoModel->obtenerPorId($_POST['dominio_vehiculo']);

            $estadiaModel = new EstadiaModel();
            $data['estadia'] = $estadiaModel->verificarEstadiasExistentesActivasIndefinidas(session('id'));
            $data['estadiasPendientes'] = $estadiaModel->verificarEstadiasPagoPendientePorUsuario(session('id'));

            $data['estadiasTotales'] = $estadiaModel->buscarPorDominioId($_POST['dominio_vehiculo']);
            $cantidadDeHoras[] = null;
            $i = 0;
            foreach ($data['estadiasTotales'] as $infoEstadia) {
                $cantidadDeHoras[$i] = $this->calcularHoras($infoEstadia['fecha_inicio'], $infoEstadia['fecha_fin']);
                $i++;
            }
            $data['cantidad_horas'] = $cantidadDeHoras;

            $estadiasNoPagas = $estadiaModel->verificarEstadiasPagoPendientePorDominio($_POST['dominio_vehiculo']);
            $monto = 0;
            foreach ($estadiasNoPagas as $infoEstadia) {
                $monto = $monto + $this->calcularMontoDeEstadia($infoEstadia['fecha_inicio'],
                        $infoEstadia['fecha_fin'],
                        $infoEstadia['historial_precio']);
            }
            $data['monto'] = $monto;

            $infraccionesModel = new InfraccionModel();
            $data['infracciones'] = $infraccionesModel->obtenerInfraccionesPorVehiculoId($data['dominioSeleccionado']['id_vehiculo']);

            $tarjetaModel = new TarjetaDeCreditoModel();
            $data['tarjetas'] = $tarjetaModel->obtenerTarjetasPorUsuario(session('id'));


            return view('viewCliente/viewMasterConsultarVehiculo', $data);

        } else {

            session()->setFlashdata('errorVehiculo', "No se selecciono ninguna patente, por favor seleccione una");
            return redirect()->back();

        }
    }

    public function verDetalleEstacionamiento($id)
    {
        if ((!$this->esCliente())) {
            return redirect()->to(base_url());
        }

        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $cuentaModel = new CuentaModel();
        $cuenta = $cuentaModel->obtenerCuentaDeUsuario(session('id'));
        $data['montoTotalDeCuenta'] = $cuenta->monto_total;

        $dominioVehiculoModel = new DominioVehiculoModel();
        $data['dominio'] = $dominioVehiculoModel->tieneVehiculos(session('id'));

        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->verificarEstadiasExistentesActivasIndefinidas(session('id'));
        $data['estadiasPendientes'] = $estadiaModel->verificarEstadiasPagoPendientePorUsuario(session('id'));

        $data['estadiaSeleccionada'] = $estadiaModel->obtenerEstadiaById($id);


        $cantidadDeHoras = $this->calcularHoras($data['estadiaSeleccionada']->fecha_inicio, $data['estadiaSeleccionada']->fecha_fin);
        $data['cantidad_horas'] = $cantidadDeHoras;

        $estado = $this->verificarEstados($data['estadiaSeleccionada']->fecha_fin);
        $data['estado'] = $estado;
        return view('detalleEstacionamiento', $data);
    }


    //cargar saldo:
    public function verCargarSaldo($valor)
    {
        //0:  usar tarjeta existente
        //1: crear tarjeta nueva

        if ((!$this->esCliente())) {
            return redirect()->to(base_url());
        }

        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $cuentaModel = new CuentaModel();
        $cuenta = $cuentaModel->obtenerCuentaDeUsuario(session('id'));
        $data['montoTotalDeCuenta'] = $cuenta->monto_total;

        $dominioVehiculoModel = new DominioVehiculoModel();
        $data['dominio'] = $dominioVehiculoModel->tieneVehiculos(session('id'));

        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->verificarEstadiasExistentesActivasIndefinidas(session('id'));
        $data['estadiasPendientes'] = $estadiaModel->verificarEstadiasPagoPendientePorUsuario(session('id'));

        $data['valor'] = $valor;

        $tarjetaModel = new TarjetaDeCreditoModel();
        $data['tarjetas'] = $tarjetaModel->obtenerTarjetasPorUsuario(session('id'));
        return view('viewCliente/viewMasterCargarSaldo', $data);


    }

    public function cargarSaldo()
    {

        if ((!$this->esCliente())) {
            return redirect()->to(base_url());
        }


        if ($_POST['valor'] == 1) {

            $validacion = $this->validate([
                'numero_tarjeta' => 'required|is_unique[tarjetas_de_credito.numero]',
                'fecha' => 'required|valid_date',
                'codigo_seguridad' => 'required|max_length[3]|min_length[3]',
                'monto' => 'required',
            ]);

        } elseif ($_POST['valor'] == 0) {

            $validacion = $this->validate([
                'id_tarjeta' => 'required',
                'monto' => 'required',
            ]);
        }

        if ($validacion) {

            if ($_POST['valor'] == 1) {

                $tarjetaModel = new TarjetaDeCreditoModel();

                $data = [
                    'numero' => $_POST['numero_tarjeta'],
                    'codigo_de_seguridad' => $_POST['codigo_seguridad'],
                    'fecha_vencimiento' => $_POST['fecha'],
                    'id_usuario' => session('id')
                ];

                $data['codigo_de_seguridad'] = password_hash($_POST['codigo_seguridad'], PASSWORD_BCRYPT);
                $data['fecha_vencimiento'] = DateTime::createFromFormat("d-m-Y", $_POST['fecha'])->format('Y-m-d');
                $tarjetaModel->save($data);
            }

            $cuentaModel = new CuentaModel();
            $cuenta = $cuentaModel->obtenerCuentaDeUsuario(session('id'));
            $cuenta->monto_total = $cuenta->monto_total + $_POST['monto'];

            $cuentaModel->update($cuenta->id, $cuenta);

            $this->pagarAutomaticamente();

            session()->setFlashdata('mensaje', 'La transaccion se realizo exitosamente');
            return json_encode(true);
            // return redirect()->to(base_url('/home'));

        } else {
            $error = $this->validator->getErrors();
            session()->setFlashdata($error);
            return json_encode(redirect()->back()->withInput());
//            return redirect()
//                ->back()
//                ->withInput();
        }
    }

    public function confirmarPassword($password)
    {
        $valor = false;
        $userModel = new UserModel();
        $data = $userModel->find(session('id'));
        if (password_verify($password, $data['password'])) {
            $valor = true;
        }
        return json_encode($valor);

    }

    public function pagarAutomaticamente()
    {
        $cuentaModel = new CuentaModel();
        $cuenta = $cuentaModel->obtenerCuentaDeUsuario(session('id'));

        $montoTotal = $cuenta->monto_total;

        $estadiaModel = new EstadiaModel();
        $estadiasPendientes = $estadiaModel->verificarEstadiasPagoPendientePorUsuario(session('id'));

        ksort($estadiasPendientes);

        foreach ($estadiasPendientes as $infoEstadia) {
            $montoEstadia = $this->calcularMontoDeEstadia($infoEstadia['fecha_inicio'],
                $infoEstadia['fecha_fin'],
                $infoEstadia['historial_precio']);

            if ($montoEstadia <= $montoTotal) {

                $infoEstadia['pago_pendiente'] = false;
                $estadiaModel->update($infoEstadia['id'], $infoEstadia);

                $cuenta->deuda = number_format($cuenta->deuda - $montoEstadia,2);

                $montoTotal =number_format($montoTotal - $montoEstadia,2) ;
                $cuenta->monto_total = $montoTotal;

                $cuentaModel->update($cuenta->id, $cuenta);
            }


        }

    }


    //funcion para saber si existen vehiculos que el usuario pueda estacionar en el momento
    public function obtenerDominiosDeUsuario()
    {

        $dominioModel = new DominioVehiculoModel();
        $data2['dominio_vehiculos'] = $dominioModel->tieneVehiculos(session('id'));
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
                    if ($estadias[$i]['fecha_fin'] > $fechaAcual) {
                        $data['dominio_vehiculos'] = array_filter($data['dominio_vehiculos'], function ($valor) use ($id_vehiculo, $id_usuario) {

                            return (($valor['id_vehiculo'] == $id_vehiculo) && ($valor['id_usuario'] == $id_usuario));
                        });


                    }
                }
            }
        }

        if (empty($data['dominio_vehiculos'])) {
            return json_encode(true);
        } else {
            return json_encode(false);
        }

    }


    //funciones private para otros metodos:
    private function esCliente()
    {
        if (session('rol') === '4') {
            return true;
        }
        return false;
    }

    private function esFechaValidaParaEstacionar($fecha, $inicio, $fin, $idHistorialZona): bool
    {
        $horaInicio = explode(':', $inicio);
        $horaFin = explode(':', $fin);
        $fechaInicio = (new DateTime())->setTime($horaInicio[0], $horaInicio[1])->format('Y-m-d H:i:s');
        $fechaFin = (new DateTime())->setTime($horaFin[0], $horaFin[1])->format('Y-m-d H:i:s');
        $fechaActual = (new DateTime())->format('Y-m-d H:i');

        if (($fecha >= $fechaActual) && ($fecha <= $fechaFin) && ($fecha >= $fechaInicio) && ($fechaActual >= $fechaInicio)
           // && (strftime('%A') != 'Saturday') && (strftime('%A') != 'Sunday'))
        ){
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

    private function verificarEstados($fecha_fin)
    {
        $fechaActual = (new DateTime())->format('Y-m-d H:i:s');

        if ($fecha_fin > $fechaActual) {
            return true; //esta activa
        } else {
            return false; //termino
        }
    }

}