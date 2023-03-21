<?php

namespace App\Core\UseCase\User\Create;

use App\Core\Domain\User\Factory\UserFactory;
use App\Core\Domain\User\Repository\IUserRepository;
use App\Core\Infrastructure\User\Repository\UserRepository;
use App\Core\UseCase\User\Create\InputCreateUserDto;

class CreateUserUseCase
{
    private IUserRepository $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();    
    }

    public function execute(InputCreateUserDto $input): void
    {
        $user = UserFactory::create(
            null,
            $input->getName(),
            $input->getEmail(),
            $input->getPassword(),
        );

        $this->repository->create($user);
    }
}
