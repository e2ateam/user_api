<?php

namespace Tests\Core\UseCase\User\Create;

use App\Core\UseCase\User\Create\CreateUserUseCase;
use App\Core\UseCase\User\Create\InputCreateUserDto;
use Mockery\MockInterface;
use Tests\Core\Infrastructure\User\Mock\MockUserRepository;
use Tests\TestCase;

class CreateUserUseCaseTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();        
        $this->artisan('migrate:reset');
        $this->artisan('migrate');
    } 

    public function testShouldExecute(): void
    {
        $input = new InputCreateUserDto(
            'name',
            'name@gmail.com',
            '123456',
        );
        $mock = $this->mock(MockUserRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('create')->once();
        });
        $repository = new MockUserRepository($mock);
        $usecase = new CreateUserUseCase($repository);
        $usecase->execute($input);
    }
}
