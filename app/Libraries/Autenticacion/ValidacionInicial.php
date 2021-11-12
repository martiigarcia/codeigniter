<?php

namespace App\Libraries\Authentication;

use App\Entities\User;
use App\Models\UserModel;
use Config\Services;
use RuntimeException;

class ValidacionInicial implements Autenticacion
{
    /**
     * Usuario actualmente autenticado
     *
     * @var User $usuario
     */
    public $usuario;

    /**
     * Retorna el usuario con las credenciales indicadas
     *
     * @param string $email
     * @param string $password
     *
     * @return User
     *
     * @throws AutenticacionException Si no lo encuentra
     */
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

    /**
     * Intento de autenticación
     *
     * @param array $datos_ingreso
     *
     * @return User
     *
     * @throws AutenticacionException Si falla el intento
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

        return $usuario;
    }

    /**
     * Crea una sesión para el usuario indicado
     *
     * @param User $usuario
     */
    public function doLogin(User $usuario)
    {
        $this->usuario = $usuario;
        session()->regenerate(true);
        session()->set('logged_id', $this->usuario->id);
    }

    /**
     * Determina si el usuario está actualmente autenticado
     *
     * @return bool
     */
    public function isLoggedIn(): bool
    {
        if (!is_null($this->usuario))
            return true;

        if ($userId = session()->get('logged_id'))
            $this->usuario = (new UserModel())->find($userId);

        return ! is_null($this->usuario);
    }

    /**
     * Retorna el usuario actualmente autenticado
     *
     * @return User
     */
    public function getCurrentUser(): User
    {
        if (!$this->isLoggedIn())
            throw new RuntimeException(lang('Auth.not_authenticated'));
        return $this->usuario;
    }

    /**
     * Cierra la session del usuario actualmente autenticado
     */
    public function logout(): void
    {
        $this->usuario = null;
        Services::session()->destroy();
    }
}
