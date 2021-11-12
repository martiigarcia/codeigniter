<?php

namespace App\Libraries\Authentication;

use App\Entities\User;
use App\Models\UserModel;
use App\Models\RecuerdameModel;
use CodeIgniter\Encryption\Encryption;
use Config\Services;
use DateTime;
use ReflectionException;

class RecordarmeDecorator extends AuthenticationDecorator
{
    protected $usuario;

    /**
     * Intento de autenticación
     *
     * @param array $credentials
     *
     * @return mixed
     *
     * @throws ReflectionException
     */
    public function attempt(array $datos_ingreso): User
    {
        $usuario = parent::attempt($datos_ingreso);

        if (isset($datos_ingreso['remember']))
            $this->remember(['id_usuario' => $usuario->id]);

        return $usuario;
    }

    /**
     * Determina si el usuario está actualmente autenticado
     *
     * @return bool
     *
     * @throws ReflectionException
     */
    public function isLoggedIn(): bool
    {
        if (parent::isLoggedIn())
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
        
        parent::logout();
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
     * @return bool
     *
     * @throws ReflectionException
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

        parent::doLogin($usuario);

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

}