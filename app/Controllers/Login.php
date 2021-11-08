<?php

namespace App\Controllers;
use App\Models\DominioVehiculoModel;
use App\Models\RolModel;
use App\Models\UserModel;
use App\Models\EstadiaModel;

class Login extends BaseController
{
    public function login()
    {   
        if(session('logged_in')){
        return redirect()->to(base_url("login/index"));
        }
        return view('Login/login');
    }

    public function ingresar()
    {
        if (!$this->validate([
                'email' => 'required',
                'password' => 'required'
            ]
        )) {
            return redirect()->back()->with('errors', $this->validator->getErrors())
                ->withInput();
        }
        $userModel = new UserModel();
        $data=$userModel->obtenerUsuarioEmail($_POST['email']);
        if(empty($data)){
            return redirect()->back()->with('mensajeLogin','El usuario o la contraseña son incorrectos')
                ->withInput();
        }else {
            if ($data['password'] !== $_POST['password']) {
                return redirect()->back()->with('mensajeLogin', 'El usuario o la contraseña son incorrectos')
                    ->withInput();
            }
        }

        session()->set([
            'id'=>$data['id'],
            'username'  => $data['email'],
            'rol'=>$data['rol_id'],
            'logged_in' => true,
        ]);
        return redirect()->to(base_url("login/index"));
    }

    public function salir()
    {
        session()->destroy();
        return redirect()->to(base_url());
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

            $dominioVehiculoModel = new DominioVehiculoModel();
            $data['dominio'] = $dominioVehiculoModel->tieneVehiculos(session('id'));
            //dd($data);
            return view('viewCliente/viewMaster', $data);
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
