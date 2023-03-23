<?php

namespace Tests\Core\UseCase\User\Update;

use App\Core\UseCase\User\Update\InputUpdateUserDto;
use App\Core\UseCase\User\Update\UpdateUserUseCase;
use Mockery\MockInterface;
use Tests\Core\Infrastructure\User\Mock\MockUserRepository;
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
        $user = MockUserRepository::createUser();
        $input = new InputUpdateUserDto(
            $user->getId(),
            'name 2',
            'name1@gmail.com',
        );
        $mock = $this->mock(MockUserRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('find', 'update')->once();
        });
        $repository = new MockUserRepository($mock);
        $usecase = new UpdateUserUseCase($repository);
        $usecase->execute($input);
    }
}
