<?php

namespace App\Core\Domain\User\Factory;

use App\Core\Domain\User\Validator\UserValidator;
use E2ateam\Shared\Validator\ValidatorInterface;

class UserValidatorFactory
{
    public static function create(): ValidatorInterface
    {
        return new UserValidator();
    }
}
