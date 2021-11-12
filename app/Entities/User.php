<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * @property int|null $id
 * @property string dni
 * @property string nombre
 * @property string apellido
 * @property string email
 * @property Time fecha_de_nacimiento
 * @property string $password
 * @property Time|null created_at
 * @property Time|null updated_at
 * @property Time|null deleted_at
 */

class User extends Entity
{
    // ...

    protected $datamap = [];

    protected $dates = ['fecha_de_nacimiento', 'created_at', 'updated_at', 'deleted_at',];

    protected $casts = [
        'email_confirmed' => 'boolean'
    ];

    public function setPassword(string $password)
    {
        $this->attributes['password'] = password_hash($password, PASSWORD_BCRYPT);
    }

    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->attributes['password']);
    }

    public function getName(): string
    {
        return $this->attributes['nombre'] . ' ' . $this->attributes['apellido'];
    }

}
