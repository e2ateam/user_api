<?php

namespace App\Core\UseCase\User\Create;

use App\Core\Domain\User\Factory\UserFactory;
use App\Core\Domain\User\Repository\IUserRepository;
use App\Core\Infrastructure\User\Repository\UserRepository;
use App\Core\UseCase\User\Create\InputCreateUserDto;
use App\Core\UseCase\User\Create\OutputCreatedUserDto;

class CreateUserUseCase
{
    private IUserRepository $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();    
    }

    public function execute(InputCreateUserDto $input): OutputCreatedUserDto
    {
        $user = UserFactory::create(
            $input->getName(),
            $input->getEmail(),
            $input->getPassword(),
        );

        $output = $this->repository->create($user);

        return new OutputCreatedUserDto(
            $output->getId(),
            $output->getName(),
            $output->getEmail(),
            $output->getCreatedAt(),
            $output->getUpdatedAt(),
        );
    }
}
