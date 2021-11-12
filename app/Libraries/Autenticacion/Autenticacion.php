<?php

namespace App\Libraries\Authentication;

use App\Entities\User;

interface Autenticacion
{
    public function attempt(array $datos_ingreso): User;

    public function doLogin(User $usuario);

    public function isLoggedIn(): bool;

    public function getCurrentUser(): User;

    public function logout(): void;

}