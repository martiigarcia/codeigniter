<?php

namespace App\Controllers;

use App\Models\RolModel;
use App\Models\UserModel;
use App\Models\EstadiaModel;
use DateTime;

class Administrador extends BaseController
{

    public function eliminar($id)
    {
        if (!$this->esAdministrador()) {
            return redirect()->to(base_url());
        }

        $userModel = new UserModel();
        $userModel->delete($id);

        return redirect()->to(base_url('administrador/listadoUsuarios'));
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
            'DNI' => 'required|is_unique[usuarios.{id}]',
            'email' => 'required|is_unique[usuarios.{id}]',
            'fecha_de_nacimiento' => 'required|valid_date',
            'password' => 'required',
        ]);


        if ($validacion) {

            if (empty($_POST['id_rol'])) {
                $_POST['id_rol'] = $datos['datos']['id_rol'];
            }

            $userModel->update($_POST['id'], $_POST);

            session()->setFlashdata('mensaje', 'Los datos se guardaron con exito');
            return redirect()->to(base_url('administrador/listadoUsuarios'));
        } else {

            $error = $this->validator->listErrors();
            session()->setFlashdata('mensaje', $error);

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

        $data['usuarioInfo'] = $userModel->obtenerUsuarioDNI($_POST['DNI']);
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
            'DNI' => 'required|is_unique[usuarios.DNI]',
            'email' => 'required|is_unique[usuarios.email]',
            'id_rol' => 'required',
            'fecha_de_nacimiento' => 'required|valid_date',
            'password' => 'required',
        ]);

        if ($validacion) {

            $_POST['fecha_de_nacimiento'] = DateTime::createFromFormat("d-m-Y", $_POST['fecha_de_nacimiento'])->format('Y-m-d');

            $userModel = new UserModel();
            $userModel->save($_POST);

            session()->setFlashdata('mensaje', 'Los datos se guardaron con exito');
            return redirect()->to(base_url('/administrador/addUser'));
        } else {


            $error = $this->validator->listErrors();
            session()->setFlashdata('mensaje', $error);

            return redirect()->back()->with('mensaje', 'El usuario o la contraseña son incorrectos')
                ->withInput();

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

    //funcionalidad del adminsitrador
    public function verListadoVehiculosEstacionados()
    {
        if (!$this->esAdministrador()) {
            return redirect()->to(base_url());
        }

        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        $estadiaModel = new EstadiaModel();
        
        //dd($data);

        $data['estadias_activas'] = $estadiaModel->estadiasActivas();

        return view('viewAdministrador/viewMasterListadoVehiculosEstacionados', $data);
    }

    

    

}
