<?php

namespace App\Exceptions;

use Ky\Core\Exceptions\BaseException;

class LoginException extends BaseException
{
    public static function invalidCredentials()
    {
        return self::code('login.invalid_credentials');
    }
}
