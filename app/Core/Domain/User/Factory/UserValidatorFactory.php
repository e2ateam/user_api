<?php

namespace App\Core\Domain\User\Factory;

use App\Core\Domain\_Shared\Validator\IValidator;
use App\Core\Domain\User\Validator\UserValidator;

class UserValidatorFactory
{
    public static function create(): IValidator
    {
        return new UserValidator();
    }
}
