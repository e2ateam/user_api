<?php

namespace App\Core\Domain\User\Factory;

use App\Core\Domain\User\Entity\User;

class UserFactory
{
    public static function create(
        ?string $id,
        string $name, 
        string $email,
        ?string $password = null,
    ): User {
        return new User($id, $name, $email, $password);
    }
}
