<?php

namespace App\Libraries\Authentication;

use App\Entities\User;
use App\Models\UserModel;
use App\Models\RecuerdameModel;
use CodeIgniter\Encryption\Encryption;
use Config\Services;
use DateTime;
use ReflectionException;
use RuntimeException;

class RecordarmeDecorator 
{

    /**
     * Usuario actualmente autenticado
     *
     * @var User $usuario
     */
    protected $usuario;

    
    /**
     * Intento de autenticación
     */
    public function attempt(array $datos_ingreso): User
    {
        $usuario = $this->getUser(
            $datos_ingreso['email'],
            $datos_ingreso['password']
        );

        if (!$usuario->email_confirmed)
            throw AutenticacionException::EmailNoConfirmado();

        Services::response()->noCache();

        $this->doLogin($usuario);

        if (isset($datos_ingreso['remember']))
            $this->remember(['id_usuario' => $usuario->id]);

        return $usuario;
    }

    private function getUser(string $email, string $password): User
    {
        $usuario = (new UserModel())->where('email', $email)->first();

        if (is_null($usuario))
            throw AutenticacionException::EmailInvalido();

        if (!($usuario instanceof User))
            throw new RuntimeException('Invalid entity.');

        if (!$usuario->verifyPassword($password))
            throw AutenticacionException::PasswordInvalida();

        return $usuario;
    }

    public function doLogin(User $usuario)
    {
        $this->usuario = $usuario;
        session()->regenerate(true);
        session()->set('logged_id', $this->usuario->id);
    }

    /**
     * Determina si el usuario está actualmente autenticado
     */
    public function isLoggedIn(): bool
    {
        if (!is_null($this->usuario))
            return true;

        if ($userId = session()->get('logged_id'))
            $this->usuario = (new UserModel())->find($userId);

        if (! is_null($this->usuario))
            return true;

        return $this->verify();
    }

    

    /**
     * Cierra la session del usuario actualmente autenticado
     */
    public function logout(): void
    {
        if ($cookie = $this->getRememberMeCookie()) {
            $this->removeRememberMeCookie();
            (new RecuerdameModel())->delete(
                explode(':', $cookie)[0]
            );
        }
        
        $this->usuario = null;
        Services::session()->destroy();
    }

    
    /**
     * Implementación del "Recuérdame"
     *
     * @throws ReflectionException
     */
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

        Services::response()->setCookie('pk_remember', $tokenId . ':' . $hash, $fecha_fin);
    }

    /**
    
     */
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

        $usuario = (new UserModel())->find($token['id_usuario']);

        if (is_null($usuario) && ! $usuario instanceof User)
            return false;

        $this->doLogin($usuario);

        $this->remember($token, true);

        return true;
    }

    private function getRememberMeCookie()
    {
        return Services::request()->getCookie('pk_remember');
    }

    private function removeRememberMeCookie()
    {
        Services::response()->setCookie('pk_remember');
    }


     /**
     * Retorna el usuario actualmente autenticado
    */
    public function getCurrentUser(): User
    {
        if (!$this->isLoggedIn())
            throw new RuntimeException(lang('Auth.not_authenticated'));
        return $this->usuario;
    }

}