<?php

namespace App\Controllers;

use App\Models\DominioVehiculoModel;
use App\Models\UserModel;
use App\Models\EstadiaModel;

class Home extends BaseController
{

    public function actualizarPerfil()
    {
       
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
            return redirect()->to(base_url('/home'));
        } else {

            $error = $this->validator->listErrors();
            session()->setFlashdata('mensaje', $error);

            return redirect()->back()->withInput();
        }
    }

    public function verPerfil(){

        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));

        return view('administrarPerfil', $data);
    }

    public function index()
    {
        $userModel = new UserModel();
        $data['usuarioActual'] = $userModel->obtenerUsuarioEmail(session()->get('username'));


        if ($this->esAdministrador()) {
            return view('viewAdministrador/viewMaster', $data);
        }
        if ($this->esVendedor()) {
            return view('viewVendedor/viewMaster', $data);
        }
        if ($this->esInspector()) {
            return view('viewInspector/viewMaster', $data);
        }
        if ($this->esCliente()) {

            $estadiaModel = new EstadiaModel();
            $data['estadia'] = $estadiaModel->verificarEstadiasExistentesActivasIndefinidas(session('id'));
            $data['estadiasPendientes'] = $estadiaModel->verificarEstadiasPagoPendiente(session('id'));

            $dominioVehiculoModel = new DominioVehiculoModel();
            $data['dominio'] = $dominioVehiculoModel->tieneVehiculos(session('id'));

            return view('viewCliente/viewMaster', $data);
        }
        else{
            return redirect()->to(base_url());
        }

    }

    private function esAdministrador()
    {
        if (session('rol') === '1') {
            return true;
        }
        return false;
    }

    private function esVendedor()
    {
        if (session('rol') === '2') {
            return true;
        }
        return false;
    }

    private function esInspector()
    {
        if (session('rol') === '3') {
            return true;
        }
        return false;
    }

    private function esCliente()
    {
        if (session('rol') === '4') {
            return true;
        }
        return false;
    }


}