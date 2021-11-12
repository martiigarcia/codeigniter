<?php

namespace App\Libraries\Authentication;

use App\Entities\User;

class AtenticacionDecorator implements Autenticacion
{
    protected $autenticacion;

    public function __construct(Autenticacion $autenticacion)
    {
        $this->autenticacionn = $autenticacion;
    }

    public function attempt(array $datos_ingreso): User
    {
        return $this->autenticacion->attempt($datos_ingreso);
    }

    public function doLogin(User $usuario)
    {
        return $this->autenticacion->doLogin($usuario);
    }

    public function isLoggedIn(): bool
    {
        return $this->autenticacion->isLoggedIn();
    }

    public function getCurrentUser(): User
    {
        return $this->autenticacion->getCurrentUser();
    }

    public function logout(): void
    {
        $this->autenticacion->logout();
    }
}