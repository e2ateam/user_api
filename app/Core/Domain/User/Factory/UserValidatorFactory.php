<?php

namespace App\Core\Domain\User\Factory;

use E2ateam\Shared\Validator\ValidatorInterface;
use App\Core\Domain\User\Validator\UserValidator;

class UserValidatorFactory
{
    public static function create(): ValidatorInterface
    {
        return new UserValidator();
    }
}
