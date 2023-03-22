<?php

namespace App\Core\UseCase\User\Update;

use App\Core\Domain\User\Repository\IUserRepository;

class UpdateUserUseCase
{
    public function __construct(
        protected IUserRepository $repository,
    ) { }

    public function execute(InputUpdateUserDto $input): void
    {
        $user = $this->repository->find($input->getId());
        $user->changeName($input->getName());
        $this->repository->update($user);
    }
}
