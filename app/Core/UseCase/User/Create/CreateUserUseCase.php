<?php

namespace App\Core\UseCase\User\Create;

use App\Core\Domain\User\Factory\UserFactory;
use App\Core\Domain\User\Repository\IUserRepository;
use App\Core\UseCase\User\Create\InputCreateUserDto;

class CreateUserUseCase
{
    public function __construct(
        protected IUserRepository $repository,
    ) { }

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
