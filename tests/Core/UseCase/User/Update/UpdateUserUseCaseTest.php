<?php

namespace Tests\Core\UseCase\User\Create;

use App\Core\Domain\User\Entity\User;
use App\Core\Infrastructure\User\Repository\UserRepository;
use App\Core\UseCase\User\Update\InputUpdateUserDto;
use App\Core\UseCase\User\Update\UpdateUserUseCase;
use Tests\TestCase;

class UpdateUserUseCaseTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();        
        $this->artisan('migrate:reset');
        $this->artisan('migrate');
    } 

    public function testShouldExecute(): void
    {
        $user = $this->createUser();
        $input = new InputUpdateUserDto(
            $user->getId(),
            'name 2',
            'name2@gmail.com',            
        );

        $usecase = new UpdateUserUseCase();
        $actual = $usecase->execute($input);
        $this->assertEquals($input->getId(), $actual->getId());
        $this->assertEquals('name 2', $actual->getName());
        $this->assertEquals('name2@gmail.com', $actual->getEmail());
        $this->assertNotEmpty($actual->getCreatedAt());
        $this->assertNotEmpty($actual->getUpdatedAt());
    }

    private function createUser(): User
    {
        $user = new User(
            null,
            'name 1',
            'name1@gmail.com',
            '123456',
        );

        $repository = new UserRepository();
        $output = $repository->create($user);

        return $repository->find($output->getId());
    }
}
