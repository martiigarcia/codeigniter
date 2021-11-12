<?php

namespace App\Libraries\Authentication;

class AutenticacionException extends \Exception
{
    public static function NoValidado(): AutenticacionException
    {
        return new self(lang('Auth.not_authenticated'));
    }

    public static function EmailInvalido(): AutenticacionException
    {
        return new self(lang('Auth.invalid_credentials'));
    }

    public static function PasswordInvalida(): AutenticacionException
    {
        return new self(lang('Auth.invalid_credentials'));
    }

    public static function EmailNoConfirmado(): AutenticacionException
    {
        return new self(lang('Auth.unconfirmed_email'));
    }
}