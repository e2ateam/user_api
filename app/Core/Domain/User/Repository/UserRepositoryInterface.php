<?php

namespace App\Core\Domain\User\Repository;

use App\Core\Domain\User\Entity\User;

interface UserRepositoryInterface
{ 
    public function create(User $input): User;
    public function update(User $input): User;
    public function find(string $id): User;
    public function findAll(int $pagination): array;
}
