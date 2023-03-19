<?php

namespace App\Core\UseCase\User\Update;

use App\Core\Domain\User\Factory\UserFactory;
use App\Core\Domain\User\Repository\IUserRepository;
use App\Core\Infrastructure\User\Repository\UserRepository;
use App\Core\UseCase\User\Update\OutputUpdatedUserDto;

class UpdateUserUseCase
{
    private IUserRepository $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();    
    }

    public function execute(InputUpdateUserDto $input): OutputUpdatedUserDto
    {
        $user = UserFactory::create(
            $input->getId(),
            $input->getName(),
            $input->getEmail(),
            '******',
        );

        $output = $this->repository->update($user);

        return new OutputUpdatedUserDto(
            $output->getId(),
            $output->getName(),
            $output->getEmail(),
            $output->getCreatedAt(),
            $output->getUpdatedAt(),
        );
    }
}
