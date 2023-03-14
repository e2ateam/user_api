<?php

namespace App\Core\User\Factory;

use App\Core\_Shared\Validator\IValidator;
use App\Core\User\Validator\UserValidator;

class UserValidatorFactory
{
    public static function create(): IValidator
    {
        return new UserValidator();
    }
}
