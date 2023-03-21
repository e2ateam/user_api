<?php

namespace App\Core\UseCase\User\Update;

use App\Core\Domain\User\Factory\UserFactory;
use App\Core\Domain\User\Repository\IUserRepository;
use App\Core\Infrastructure\User\Repository\UserRepository;

class UpdateUserUseCase
{
    private IUserRepository $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();    
    }

    public function execute(InputUpdateUserDto $input): void
    {
        $user = UserFactory::create(
            $input->getId(),
            $input->getName(),
            $input->getEmail(),
        );

        $this->repository->update($user);
    }
}
