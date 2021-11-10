<?php

namespace App\Controllers;
use App\Models\UserModel;

class Login extends BaseController
{
    public function login()
    {   
        if(session('logged_in')){
        return redirect()->to(base_url("home/index"));
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
        return redirect()->to(base_url("home/index"));
    }

    public function salir()
    {
        session()->destroy();
        return redirect()->to(base_url());
    }

    


}
