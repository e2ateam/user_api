<?php

namespace Tests\Core\UseCase\User\Create;

use App\Core\UseCase\User\Create\CreateUserUseCase;
use App\Core\UseCase\User\Create\InputCreateUserDto;
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

        $usecase = new CreateUserUseCase();
        $actual = $usecase->execute($input);
        $this->assertNotEmpty($actual->getId());
        $this->assertEquals($input->getName(), $actual->getName());
        $this->assertEquals($input->getEmail(), $actual->getEmail());
        $this->assertNotEmpty($actual->getCreatedAt());
        $this->assertNotEmpty($actual->getUpdatedAt());
    }
}
