<?php

namespace Tests\Core\Infrastructure\User\Mock;

use App\Core\Domain\User\Entity\User;
use App\Core\Domain\User\Repository\IUserRepository;
use Ramsey\Uuid\Uuid;
use Tests\Core\Domain\_Shared\Mock\MockRepository;

class MockUserRepository extends MockRepository implements IUserRepository
{    
    public function create(User $input): User
    {
        $this->spyCreate($input);
        return MockUserRepository::createUser();
    }

    public function update(User $input): User
    {         
        $this->spyUpdate($input);
        return MockUserRepository::createUser();
    }

    public function find(string $id): User
    {
        $this->spyFind($id);
        return MockUserRepository::createUser();
    }

    public function findAll(int $pagination): array
    {
        $this->spyFindAll($pagination);
        $user = MockUserRepository::createUser();
        return [$user];
    }    

    public static function createUser(): User
    {
        return new User(
            Uuid::uuid4(),
            'name 1',
            'name1@gmail.com',
            '123456',
        );        
    }
}
