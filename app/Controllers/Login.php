<?php

namespace App\Controllers;
use App\Models\UserModel;

class Login extends BaseController
{
    public function login()
    {
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
            if ($data[0]['contraseña'] !== $_POST['password']) {
                return redirect()->back()->with('mensajeLogin', 'El usuario o la contraseña son incorrectos')
                    ->withInput();
            }
        }
        d($data);
        session()->set([
            'username'  => $data[0]['email'],
            'logged_in' => true,
        ]);
        return redirect()->to(base_url("home/"));
    }
}
