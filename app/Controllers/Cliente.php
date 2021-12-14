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


    public function verRegistroVehiculo()
    {
        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }
        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $marcaModel = new MarcaModel();
        $data['marcas'] = $marcaModel->findAll();

        $fechaActual = (new DateTime())->format('Y-m-d H:i:s');

        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->verificarEstadiasExistentesActivasIndefinidas(session('id'), $fechaActual);
        $data['estadiasPendientes'] = $estadiaModel->verificarEstadiasPagoPendiente(session('id'), $fechaActual);

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

        $fechaAcual = (new DateTime())->format('Y-m-d H:i:s');

        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->verificarEstadiasExistentesActivasIndefinidas(session('id'), $fechaAcual);
        $data['estadiasPendientes'] = $estadiaModel->verificarEstadiasPagoPendiente(session('id'), $fechaAcual);

        if (!empty($data['estadia'])) {
            return redirect()->to(base_url());
        }

        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->verificarEstadiasExistentesActivasIndefinidas(session('id'), $fechaAcual);
        $data['estadiasPendientes'] = $estadiaModel->verificarEstadiasPagoPendiente(session('id'), $fechaAcual);

        $dominioVehiculoModel = new DominioVehiculoModel();
        $data['dominio'] = $dominioVehiculoModel->tieneVehiculos(session('id'));


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

                $duracionDefinida = false;

                //seleccionar el turno correspondiente para la hora de fin de estadia
                $fechaFin = $this->verificarTurno($fechaInicio, $infoZonas[0]['comienzo'], $infoZonas[0]['final']);
                if ($fechaFin === null) {
                    $fechaFin = $this->verificarTurno($fechaInicio, $infoZonas[1]['comienzo'], $infoZonas[1]['final']);

                }


            } else {

                $duracionDefinida = true;
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

            $estadiaModel->save($estadiaData);
            $estadiaActiva = $estadiaModel->obtenerUltimaEstadiaActivaPorDominioId($_POST['dominio_vehiculo'], (new DateTime())->format('Y-m-d H:i:s'));

            if ($estadiaData['duracion_definida']) {
                session()->setFlashdata('mensajePagar', '¿Desea pagar en este momento?');
                return redirect()->back()->with('id_estadia', $estadiaActiva->id);

            } else {
                session()->setFlashdata('mensaje', 'El vehiculo se estaciono correctamente');
                return redirect()->to(base_url('/home'));
            }
        } else {
            $error = $this->validator->getErrors();
            session()->setFlashdata($error);
            return redirect()
                ->back()
                ->withInput();
        }


    }

    public function verDesEstacionar()
    {
        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }

        $fechaActual = (new DateTime())->format('Y-m-d H:i:s');

        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->verificarEstadiasExistentesActivasIndefinidas(session('id'), $fechaActual);
        $data['estadiasPendientes'] = $estadiaModel->verificarEstadiasPagoPendiente(session('id'), $fechaActual);

        if (empty($data['estadia'])) {
            return redirect()->to(base_url());
        }

        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $dominioVehiculoModel = new DominioVehiculoModel();
        $data['dominio'] = $dominioVehiculoModel->tieneVehiculos(session('id'));

        $tarjetaModel = new TarjetaDeCreditoModel();
        $data['tarjetas'] = $tarjetaModel->obtenerTarjetasPorUsuario(session('id'));

        return view('viewCliente/viewMasterDesEstacionar', $data);
    }

    public function desEstacionar($id_estadia, $valor)
    {

        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }

        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->find($id_estadia);

        $fechaAcual = (new DateTime())->format('Y-m-d H:i:s');
        if ($data['estadia']['fecha_fin'] >= $fechaAcual) {

            $data['estadia']['fecha_fin'] = $fechaAcual;
        }
        $data['estadia']['duracion_definida'] = true;

        if ($valor == 0) {// si esta en cero se deja pendiente el pago

            $estadiaModel->update($id_estadia, $data['estadia']);
            session()->setFlashdata('mensaje', 'Finalizo la estadia correctamente correctamente');
            return redirect()->to(base_url('/home'));

        } elseif ($valor == 1) { //si esta en uno se paga en el momento (primero se desEstaciona y desp se calcuula el monto y se verifica el saldo de la tarjeta)

            $estadiaModel->update($id_estadia, $data['estadia']);
            $this->verificarPagarEstadiasPendientes($id_estadia);

        }

    }

    public function verPagarEstadiasPendientes()
    {
        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }

        $fechaActual = (new DateTime())->format('Y-m-d H:i:s');
        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->verificarEstadiasExistentesActivasIndefinidas(session('id'), $fechaActual);

        $data['estadiasPendientes'] = $estadiaModel->verificarEstadiasPagoPendiente(session('id'), $fechaActual);

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

        $tarjetaModel = new TarjetaDeCreditoModel();
        $data['tarjetas'] = $tarjetaModel->obtenerTarjetasPorUsuario(session('id'));

        return view('viewCliente/viewMasterPagarEstadiasPendientes', $data);
    }

    private function verificarPagarEstadiasPendientes($id)
    {

        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }


        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->obtenerEstadiaById($id);

        $cuentaModel = new CuentaModel();
        $cuenta = $cuentaModel->obtenerCuentaDeUsuario(session('id'));

        $montoAPagar = $this->calcularMontoDeEstadia(
            $data['estadia']['fecha_inicio'],
            $data['estadia']['fecha_fin'],
            $data['estadia']['historial_precio']);

        if ($cuenta->monto_total >= $montoAPagar) {

            $data['estadia']['pago_pendiente'] = false;

            $estadiaModel->update($id, $data['estadia']);
            $cuenta->monto_total = $cuenta->monto_total - $montoAPagar;
            $cuentaModel->update($cuenta->id, $cuenta);
            echo('true');
        } else {
            echo('false');
        }
    }

    public function pagarEstadiasPendientes($id)
    {


        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }


        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->obtenerEstadiaById($id);


        $cuentaModel = new CuentaModel();
        $cuenta = $cuentaModel->obtenerCuentaDeUsuario(session('id'));

        $montoAPagar = $this->calcularMontoDeEstadia(
            $data['estadia']['fecha_inicio'],
            $data['estadia']['fecha_fin'],
            $data['estadia']['historial_precio']);

        if ($cuenta->monto_total >= $montoAPagar) {


            $data['estadia']['pago_pendiente'] = false;

            $estadiaModel->update($id, $data['estadia']);
            $cuenta->monto_total = $cuenta->monto_total - $montoAPagar;
            $cuentaModel->update($cuenta->id, $cuenta);

            session()->setFlashdata('mensaje', 'El pago se realizo exitosamente');
            return redirect()->to(base_url('/home'));
        } else {
            session()->setFlashdata('error', 'Su cuenta no dispone del saldo necesario para realizar el pago en este momento');
            return redirect()->back();
        }
    }

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

    public function consultarVehiculo()
    {
        if (!$this->esCliente()) {
            return redirect()->to(base_url());
        }

        $fechaActual = (new DateTime())->format('Y-m-d H:i:s');

        $validacion = $this->validate([
            'dominio_vehiculo' => 'required',
        ]);

        if ($validacion) {

            $userModel = new UserModel();
            $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

            $dominioVehiculoModel = new DominioVehiculoModel();
            $data['dominio'] = $dominioVehiculoModel->tieneVehiculos(session('id'));
            $data['dominioSeleccionado'] = $dominioVehiculoModel->obtenerPorId($_POST['dominio_vehiculo']);

            $estadiaModel = new EstadiaModel();
            $data['estadia'] = $estadiaModel->verificarEstadiasExistentesActivasIndefinidas(session('id'), $fechaActual);
            $data['estadiasPendientes'] = $estadiaModel->verificarEstadiasPagoPendiente(session('id'), $fechaActual);

            $data['estadiasTotales'] = $estadiaModel->buscarPorDominioId($_POST['dominio_vehiculo']);
            $cantidadDeHoras[] = null;
            $i = 0;
            foreach ($data['estadiasTotales'] as $infoEstadia) {
                $cantidadDeHoras[$i] = $this->calcularHoras($infoEstadia['fecha_inicio'], $infoEstadia['fecha_fin']);
                $i++;
            }
            $data['cantidad_horas'] = $cantidadDeHoras;

            $estadiasNoPagas = $estadiaModel->verificarEstadiasPagoPendientePorDominio($_POST['dominio_vehiculo'], $fechaActual);
            $monto = 0;
            foreach ($estadiasNoPagas as $infoEstadia) {
                $monto = $monto + $this->calcularMontoDeEstadia($infoEstadia['fecha_inicio'],
                        $infoEstadia['fecha_fin'],
                        $infoEstadia['historial_precio']);
            }
            $data['monto'] = $monto;

            $infraccionesModel = new InfraccionModel();
            $data['infracciones'] = $infraccionesModel->obtenerInfraccionesPorDominioId($_POST['dominio_vehiculo']);

            $tarjetaModel = new TarjetaDeCreditoModel();
            $data['tarjetas'] = $tarjetaModel->obtenerTarjetasPorUsuario(session('id'));

            return view('viewCliente/viewMasterConsultarVehiculo', $data);

        } else {

            session()->setFlashdata('errorVehiculo', "No se selecciono ninguna patente, por favor seleccione una");
            return redirect()->back();

        }
    }

    private function calcularHoras($fecha_inicio, $fecha_fin): string
    {
        $fechaDeInicio = new DateTime($fecha_inicio);
        $fechaDeFin = new DateTime($fecha_fin);

        $diferenciaDeHoras = $fechaDeInicio->diff($fechaDeFin);
        $hora = $diferenciaDeHoras->h . ':' . $diferenciaDeHoras->i . ':' . $diferenciaDeHoras->s;

        return $hora;
    }

    public function verDetalleEstacionamiento($id)
    {
        if ((!$this->esCliente())) {
            return redirect()->to(base_url());
        }

        $fechaActual = (new DateTime())->format('Y-m-d H:i:s');

        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $dominioVehiculoModel = new DominioVehiculoModel();
        $data['dominio'] = $dominioVehiculoModel->tieneVehiculos(session('id'));

        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->verificarEstadiasExistentesActivasIndefinidas(session('id'), $fechaActual);
        $data['estadiasPendientes'] = $estadiaModel->verificarEstadiasPagoPendiente(session('id'), $fechaActual);

        $data['estadiaSeleccionada'] = $estadiaModel->obtenerEstadiaById($id);

        $cantidadDeHoras = $this->calcularHoras($data['estadiaSeleccionada']['fecha_inicio'], $data['estadiaSeleccionada']['fecha_fin']);
        $data['cantidad_horas'] = $cantidadDeHoras;

        $estado = $this->verificarEstados($data['estadiaSeleccionada']['fecha_fin']);
        $data['estado'] = $estado;
        return view('detalleEstacionamiento', $data);
    }

    public function verCargarSaldo($valor)
    {
        //0:  usar tarjeta existente
        //1: crear tarjeta nueva

        if ((!$this->esCliente())) {
            return redirect()->to(base_url());
        }

        $fechaActual = (new DateTime())->format('Y-m-d H:i:s');
        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $dominioVehiculoModel = new DominioVehiculoModel();
        $data['dominio'] = $dominioVehiculoModel->tieneVehiculos(session('id'));

        $estadiaModel = new EstadiaModel();
        $data['estadia'] = $estadiaModel->verificarEstadiasExistentesActivasIndefinidas(session('id'), $fechaActual);
        $data['estadiasPendientes'] = $estadiaModel->verificarEstadiasPagoPendiente(session('id'), $fechaActual);

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
                'tarjeta' => 'required|is_unique[tarjetas_de_credito.numero]',
                'fecha_vencimiento' => 'required|valid_date',
                'code' => 'required|max_length[3]|min_length[3]',
                'monto' => 'required',
            ]);

        } elseif ($_POST['valor'] == 0) {

            $validacion = $this->validate([
                'tarjeta' => 'required',
                'monto' => 'required',
            ]);
        }

        if ($validacion) {

            if ($_POST['valor'] == 1) {

                $tarjetaModel = new TarjetaDeCreditoModel();

                $data = [
                    'numero' => $_POST['tarjeta'],
                    'codigo_de_seguridad' => $_POST['code'],
                    'fecha_vencimiento' => $_POST['fecha_vencimiento'],
                    'id_usuario' => session('id')
                ];

                $data['codigo_de_seguridad'] = password_hash($_POST['code'], PASSWORD_BCRYPT);
                $data['fecha_vencimiento'] = DateTime::createFromFormat("d-m-Y", $_POST['fecha_vencimiento'])->format('Y-m-d');
                $tarjetaModel->save($data);
            }

            $cuentaModel = new CuentaModel();
            $cuenta = $cuentaModel->obtenerCuentaDeUsuario(session('id'));
            $cuenta->monto_total = $cuenta->monto_total + $_POST['monto'];
            $cuentaModel->update($cuenta->id, $cuenta);

            session()->setFlashdata('mensaje', 'La transaccion se realizo exitosamente');
            return redirect()->to(base_url('/home'));

        } else {

            $error = $this->validator->getErrors();
            session()->setFlashdata($error);
            return redirect()
                ->back()
                ->withInput();
        }
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