<?php

namespace App\Controllers;

use App\Models\EstadiaModel;
use App\Models\InfraccionModel;
use App\Models\RolModel;
use App\Models\UserModel;
use DateTime;

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
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        return view('viewAdministrador/viewMasterModificarHorarioZona', $data);
    }
}
