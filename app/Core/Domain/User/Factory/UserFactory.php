<?php

namespace App\Core\Domain\User\Factory;

use App\Core\Domain\User\Entity\User;

class UserFactory
{
    public static function create(
        string $name, 
        string $email, 
        string $password
    ): User {
        return new User(null, $name, $email, $password);
    }
}
