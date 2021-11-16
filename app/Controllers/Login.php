<?php

namespace App\Controllers;
use App\Entities\User;
use App\Models\UserModel;
use App\Models\RecuerdameModel;
use CodeIgniter\Encryption\Encryption;
use Config\Services;
use DateTime;
use RuntimeException;

class Login extends BaseController
{

    public $usuario;


    public function login()
    {   
        if($this->isLoggedIn()){
            return redirect()->to(base_url("home/index"));
        }
        return view('Login/login');
    }

    /*public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->attributes['password']);
    }*/

    public function ingresar()
    {
      
        //validaciones del attempt
        if (!$this->validate([
                'email' => 'required',
                'password' => 'required'
            ]
        )) {
            return redirect()->back()->with('errors', $this->validator->getErrors())
                ->withInput();
        }
        $userModel = new UserModel();
        $data = $userModel->obtenerUsuarioEmail($_POST['email']);
        if(empty($data)){
            return redirect()->back()->with('mensajeLogin','El usuario o la contraseña son incorrectos')
                ->withInput();
        }else {
           
            if(!password_verify($_POST['password'],$data['password'])){
           
                return redirect()->back()->with('mensajeLogin', 'El usuario o la contraseña son incorrectos')
                    ->withInput();
            }
        }

        //del attempt
        Services::response()->noCache();

       // doLogIn
        $this->usuario = $data;
        session()->regenerate(true);
        
        

        session()->set([
            'id'=>$this->usuario['id'],
            'username'  => $this->usuario['email'],
            'rol'=>$this->usuario['rol_id'],
            'logged_in' => true,
        ]);

        //del attempt
        if (isset($_POST['recuerdame']))
            $this->remember(['id_usuario' => $this->usuario['id']]);

           

        return redirect()->withCookies()->to(base_url("home/index"));
    }

    private function remember($data, $refresh = false)
    {
        $hash = bin2hex(Encryption::createKey(16));
        $fecha_fin = new DateTime('+30 days');

        $row = [
            'hash' => $hash,
            'fecha_fin' => $fecha_fin->format('Y-m-d H:i:s'),
            'id_usuario' => $data['id_usuario']
        ];

        if ($refresh)
            $row['id'] = $data['id'];

        $recuerdameModel = new RecuerdameModel();

        $itSaved = $recuerdameModel->save($row);

        if (!$itSaved)
            return;

        $tokenId = $refresh
            ? $data['id']
            : $recuerdameModel->db->insertID();

       
        Services::response()->setCookie('remember', $tokenId . ':' . $hash, $fecha_fin);
       // dd(Services::request()->getCookie('remember'));
    }


    /**
     * Determina si el usuario está actualmente autenticado
     */
    public function isLoggedIn(): bool
    {
        if (!is_null($this->usuario))
            return true;

        if ($userId = session()->get('logged_id'))
            $this->usuario = (new UserModel())->obtenerUsuario($userId);

        if (! is_null($this->usuario))
            return true;

        return $this->verify();
    }

    private function verify(): bool
    {
        $cookie = $this->getRememberMeCookie();

        if (empty($cookie))
            return false;

        $this->removeRememberMeCookie();
        $recuerdameModel = new RecuerdameModel();

        $tokenId = explode(':', $cookie)[0];
        $token = $recuerdameModel->find($tokenId);

        if (is_null($token))
            return false;

        if (!hash_equals($cookie, $tokenId . ':' . $token['hash']))
            return false;

        $usuario = (new UserModel())->obtenerUsuario($token['id_usuario']);

        if (is_null($usuario) && ! $usuario instanceof User)
            return false;

        
         // doLogIn
         $this->usuario = $usuario;
         session()->regenerate(true);
         
      //  dd($usuario);
         session()->set([
             'id'=>$usuario['id'],
             'username'  => $usuario['email'],
             'rol'=>$usuario['rol_id'],
             'logged_in' => true,
         ]);

        $this->remember($token, true);

        return true;
    }

    /**
     *  Retorna el usuario actualmente autenticado
     */
    public function getCurrentUser(): User
    {
        if (!$this->isLoggedIn())
            throw new RuntimeException(lang('Auth.not_authenticated'));
        return $this->usuario;
    }

   

    /*
    *
    * FUNCIONES DE SALIR DE LA SESION
    */

    public function salir()
    {

        if ($cookie = $this->getRememberMeCookie()) {
            $this->removeRememberMeCookie();
            (new RecuerdameModel())->delete(
                explode(':', $cookie)[0]
            );
        }

        $this->usuario = null;
      
        session()->destroy();
        return redirect()->to(base_url());
    }

    private function getRememberMeCookie()
    {
        return Services::request()->getCookie('remember');
    }

    private function removeRememberMeCookie()
    {
        Services::response()->setCookie('remember');
    }

    


}
