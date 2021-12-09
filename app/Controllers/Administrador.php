<?php

namespace App\Controllers;

use App\Models\EstadiaModel;
use App\Models\HistorialZonaModel;
use App\Models\InfraccionModel;
use App\Models\RolModel;
use App\Models\UserModel;
use App\Models\ZonaModel;
use DateTime;
use PhpParser\Node\Scalar\String_;

class Administrador extends BaseController
{

    public function eliminar($id)
    {
        if (!$this->esAdministrador()) {
            return redirect()->to(base_url());
        }

        if ($id == session('id')) {

            session()->setFlashdata('mensaje', "no se puede eliminar el usuario de la sesion");

            return redirect()->back()->withInput(session());

        } else {

            $userModel = new UserModel();
            $userModel->delete($id);

            session()->setFlashdata('mensaje', 'Los datos se eliminaron con exito');
            return redirect()->to(base_url('administrador/listadoUsuarios'));
        }
    }

    public function guardarModificaciones()
    {
        if (!$this->esAdministrador()) {
            return redirect()->to(base_url());
        }
        $userModel = new UserModel();
        $datos['datos'] = $userModel->find($_POST['id']);


        $validacion = $this->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'dni' => 'required|is_unique[usuarios.{id}]',
            'email' => 'required|is_unique[usuarios.{id}]',
            'fecha_de_nacimiento' => 'required|valid_date',

        ]);


        if ($validacion) {

            if (empty($_POST['id_rol'])) {
                $_POST['id_rol'] = $datos['datos']['id_rol'];
            }


            $userModel->update($_POST['id'], $_POST);

            session()->setFlashdata('mensaje', 'Los datos se guardaron con exito');
            return redirect()->to(base_url('administrador/listadoUsuarios'));
        } else {

            $error = $this->validator->getErrors();
            session()->setFlashdata($error);
            return redirect()->back()->withInput();
        }
    }

    public function editar($id)
    {
        if (!$this->esAdministrador()) {
            return redirect()->to(base_url());
        }
        $userModel = new UserModel();
        $data['usuario'] = $userModel->obtenerUsuario($id);

        $rolModel = new RolModel();
        $data['roles'] = $rolModel->findAll();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        return view('viewAdministrador/viewMasterMod', $data);
    }

    public function buscarDNI()
    {
        if (!$this->esAdministrador()) {
            return redirect()->to(base_url());
        }
        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $data['usuarioInfo'] = $userModel->obtenerUsuarioDNI($_POST['dni']);
        if (empty($data['usuarioInfo'])) {

            $userModel = new UserModel();
            $data['usuarioInfo'] = $userModel->obtenerUsuarios();
            session()->setFlashdata('mensaje', 'No se encontraron resultados');
            return redirect()->to(base_url());

        } else {

        }
    }

    public function listadoUsuarios()
    {
        if (!$this->esAdministrador()) {
            return redirect()->to(base_url());
        }
        $userModel = new UserModel();
        $data['usuarioInfo'] = $userModel->obtenerUsuarios();
        $rolModel = new RolModel();
        $data['roles'] = $rolModel->findAll();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));
        return view('viewAdministrador/viewMasterList', $data);
    }

    public function addUser()
    {
        if (!$this->esAdministrador()) {
            return redirect()->to(base_url());
        }
        $rolModel = new RolModel();
        $data['roles'] = $rolModel->findAll();

        $userModel = new UserModel();

        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        return view('viewAdministrador/viewMasterAdd', $data);
    }

    public function guardar()
    {
        if (!$this->esAdministrador()) {
            return redirect()->to(base_url());
        }

        $validacion = $this->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'dni' => 'required|is_unique[usuarios.dni]',
            'email' => 'required|is_unique[usuarios.email]',
            'id_rol' => 'required',
            'fecha_de_nacimiento' => 'required|valid_date',
            'password' => 'required',
        ]);

        if ($validacion) {

            $_POST['fecha_de_nacimiento'] = DateTime::createFromFormat("d-m-Y", $_POST['fecha_de_nacimiento'])->format('Y-m-d');

            $_POST['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $userModel = new UserModel();
            $userModel->save($_POST);

            session()->setFlashdata('mensaje', 'Los datos se guardaron con exito');
            return redirect()->to(base_url('home/index'));
        } else {


            $error = $this->validator->getErrors();
            session()->setFlashdata($error);
            return redirect()->back()->withInput();
        }
    }

    private function esAdministrador()
    {
        if (session('rol') === '1') {
            return true;
        }
        return false;
    }

    public function verListadoVehiculosEstacionados()
    {
        if (!$this->esAdministrador()) {
            return redirect()->to(base_url());
        }

        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $estadiaModel = new EstadiaModel();

        $data['estadias_activas'] = $estadiaModel->estadiasActivas();
        $cantidadDeHoras[] = null;
        $i = 0;
        foreach ($data['estadias_activas'] as $infoEstadia) {
            $cantidadDeHoras[$i] = $this->calcularHoras($infoEstadia['fecha_inicio'], $infoEstadia['fecha_fin']);
            $i++;
        }

        $data['cantidad_horas'] = $cantidadDeHoras;

        return view('viewAdministrador/viewMasterListadoVehiculosEstacionados', $data);
    }

    public function verRestablecerPassword($id)
    {
        if (!$this->esAdministrador()) {
            return redirect()->to(base_url());
        }
        $userModel = new UserModel();
        $data['usuario'] = $userModel->obtenerUsuario($id);

        $rolModel = new RolModel();
        $data['roles'] = $rolModel->findAll();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        return view('viewAdministrador/viewMasterRestablecerPassword', $data);
    }

    public function restablecerPassword()
    {
        if (!$this->esAdministrador()) {
            return redirect()->to(base_url());
        }
        $userModel = new UserModel();
        $datos['datos'] = $userModel->find($_POST['id']);


        $validacion = $this->validate([
            'password' => 'required'

        ]);


        if ($validacion) {

            $_POST['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $userModel->update($_POST['id'], $_POST);

            session()->setFlashdata('mensaje', 'Los datos se guardaron con exito');
            return redirect()->to(base_url('administrador/listadoUsuarios'));

        } else {

            $error = $this->validator->getErrors();
            session()->setFlashdata($error);
            return redirect()->back()->withInput();
        }
    }

    private function calcularHoras($fecha_inicio, $fecha_fin): string
    {
        if (!$this->esAdministrador()) {
            return redirect()->to(base_url());
        }
        $fechaDeInicio = new DateTime($fecha_inicio);
        $fechaDeFin = new DateTime($fecha_fin);

        $diferenciaDeHoras = $fechaDeInicio->diff($fechaDeFin);
        $hora = $diferenciaDeHoras->h . ':' . $diferenciaDeHoras->i . ':' . $diferenciaDeHoras->s;

        return $hora;
    }

    public function verListadoInfracciones()
    {
        if (!$this->esAdministrador()) {
            return redirect()->to(base_url());
        }

        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $infraccionesModel = new InfraccionModel();
        $data['infracciones'] = $infraccionesModel->obtenerTodos();

        return view('viewAdministrador/viewMasterListadoInfracciones', $data);
    }

    public function verModificarCostoZona()
    {
        if (!$this->esAdministrador()) {
            return redirect()->to(base_url());
        }

        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));


        return view('viewAdministrador/viewMasterModificarCostoZona', $data);
    }

    public function verModificarHorarioZona()
    {
        if (!$this->esAdministrador()) {
            return redirect()->to(base_url());
        }

        $userModel = new UserModel();
        $zonaModel = new ZonaModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));
        $data['zonas'] = $zonaModel->findAll();

        return view('viewAdministrador/viewMasterModificarHorarioZona', $data);
    }

    public function obtenerHistoralZona($idZona)
    {
        if (!$this->esAdministrador()) {
            return redirect()->to(base_url());
        }

        $historalZonaModel = new HistorialZonaModel();
        return json_encode($historalZonaModel->obtenerZonas($idZona));

    }

    public function modificarHorarioZona()
    {
        if (!$this->esAdministrador()) {
            return redirect()->to(base_url());
        }

        $validacion = $this->validate([
            'id_zona' => 'required',
            'historial_zona' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',

        ]);
        if ($validacion) {

            $zonaModel = new ZonaModel();
            $historialZonaModel = new HistorialZonaModel();
            $zonaModel = $zonaModel->find($_POST['id_zona']);

            $nuevoHistorialZona = $historialZonaModel->find($_POST['historial_zona']);
            //validar horarios
            //cambiar estado viejo
            //crear nuevo hz
            //act descrip zona


            $estado = [
                'estado' => false
            ];
            $historialZonaModel->update($_POST['historial_zona'], $estado);
            $data = [
                'comienzo' => $_POST['hora_inicio'],
                'final' => $_POST['hora_fin'],
                'precio' => $nuevoHistorialZona['precio'],
                'estado' => true,
                'id_zona' => $nuevoHistorialZona['id_zona']
            ];
            $historialZonaModel->insert($data);
        } else {

            $error = $this->validator->getErrors();
            session()->setFlashdata($error);
            return redirect()->back();
        }

    }

    private function validarHoraActuatPrimerTurno($inicio,$fin,$finTurnoSiguiente):bool
    {
        $horaInicio = explode(':', $inicio);
        $horaFin = explode(':', $fin);
        $horaFinSigTurno=explode(':', $finTurnoSiguiente);
        $fechaInicio = (new DateTime())->setTime($horaInicio[0], $horaInicio[1])->format('Y-m-d H:i:s');
        $fechaFin = (new DateTime())->setTime($horaFin[0], $horaFin[1])->format('Y-m-d H:i:s');
        $fechaFinSigTurno = (new DateTime())->setTime($horaFinSigTurno[0], $horaFinSigTurno[1])->format('Y-m-d H:i:s');

        $fechaActual = (new DateTime())->format('Y-m-d H:i');

        if (($fechaInicio >= $fechaActual) && ($fechaInicio < $fechaFin) && ($fechaFin <= $fechaFinSigTurno)
            && (strftime('%A') != 'Saturday') && (strftime('%A') != 'Sunday')) {

            return true;
        }
        return false;
    }
    private function validarHoraActuatSegundoTurno($inicio,$fin,$finTurnoAnterior):bool
    {
        $horaInicio = explode(':', $inicio);
        $horaFin = explode(':', $fin);
        $horaFinTurnoAnterior=explode(':', $finTurnoAnterior);
        $fechaInicio = (new DateTime())->setTime($horaInicio[0], $horaInicio[1])->format('Y-m-d H:i:s');
        $fechaFin = (new DateTime())->setTime($horaFin[0], $horaFin[1])->format('Y-m-d H:i:s');
        $fechaFinTurnoAnterior = (new DateTime())->setTime($horaFinTurnoAnterior[0], $horaFinTurnoAnterior[1])->format('Y-m-d H:i:s');

        $fechaActual = (new DateTime())->format('Y-m-d H:i');

        if (($fechaInicio >= $fechaActual) && ($fechaInicio < $fechaFin) && ($fechaFin <= $fechaFinTurnoAnterior)
            && (strftime('%A') != 'Saturday') && (strftime('%A') != 'Sunday')) {

            return true;
        }
        return false;
    }
    //saber si es el primer o segundo turno, si da verdadero es el primer turno
    private function verificarTurno($finTurnoA,$inicioTurnoB){
        $horaInicioB = explode(':', $inicioTurnoB);
        $horaFinA = explode(':', $finTurnoA);
        if($horaFinA<$horaInicioB){
            return true;
        }
        return false;
    }
}
