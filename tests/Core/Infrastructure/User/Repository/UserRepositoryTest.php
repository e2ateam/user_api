<?php

namespace Tests\Core\Infrastructure\User\Repository;

use App\Core\Domain\_Shared\Exception\ObjectNotFoundException;
use App\Core\Domain\_Shared\Formatter\Formatter;
use App\Core\Domain\User\Entity\User;
use App\Core\Infrastructure\User\Repository\UserRepository;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{        
    protected function setUp(): void
    {
        parent::setUp();        
        $this->artisan('migrate:reset');
        $this->artisan('migrate');
    }    

    public function testShouldCreateAnUser(): void
    {
        $user = new User(
            null,
            'name 1',
            'name1@gmail.com',
            '123456',
        );

        $repository = new UserRepository();
        $output = $repository->create($user);

        $actual = $repository->find($output->getId());
        $this->assertNotEmpty($actual->getId());
        $this->assertEquals($user->getName(), $actual->getName());
        $this->assertEquals($user->getEmail(), $actual->getEmail());
        $this->assertNotEmpty($actual->getCreatedAt());
        $this->assertNotEmpty($actual->getUpdatedAt());
    }

    public function testShouldUpdateAnUser(): void
    {
        $user = new User(
            null,
            'name 1',
            'name1@gmail.com',
            '123456',
        );

        $repository = new UserRepository();
        $output = $repository->create($user);
        $actualCreated = $repository->find($output->getId());

        $this->assertNotEmpty($actualCreated->getId());
        $this->assertEquals($user->getName(), $actualCreated->getName());
        $this->assertEquals($user->getEmail(), $actualCreated->getEmail());
        $this->assertNotEmpty($actualCreated->getCreatedAt());
        $this->assertNotEmpty($actualCreated->getUpdatedAt());        
        
        $actualCreated->changeName('name 2');
        sleep(2);
        $repository->update($actualCreated);        
        $actualUpdated = $repository->find($output->getId());

        $this->assertEquals('name 2', $actualUpdated->getName());
        $this->assertEquals($user->getEmail(), $actualUpdated->getEmail());
        $this->assertEquals(
            Formatter::dateTimeToStr($actualCreated->getCreatedAt()), 
            Formatter::dateTimeToStr($actualUpdated->getCreatedAt()),
        );
        $this->assertNotEquals(
            Formatter::dateTimeToStr($actualCreated->getUpdatedAt()),
            Formatter::dateTimeToStr($actualUpdated->getUpdatedAt()),
        );
    }

    public function testShouldFindAllUser(): void
    {
        $user1 = new User(
            null,
            'name 1',
            'name1@gmail.com',
            '123456',
        );

        $repository = new UserRepository();
        $repository->create($user1);

        $user2 = new User(
            null,
            'name 2',
            'name2@gmail.com',
            '123456',
        );

        $repository->create($user2);

        $actual = $repository->findAll(0);
        $this->assertEquals(2, count($actual));
        $this->assertNotEmpty($actual[0]->getId());
        $this->assertEquals($user1->getName(), $actual[0]->getName());
        $this->assertEquals($user1->getEmail(), $actual[0]->getEmail());
        $this->assertNotEmpty($actual[0]->getCreatedAt());
        $this->assertNotEmpty($actual[0]->getUpdatedAt());

        $this->assertNotEmpty($actual[1]->getId());
        $this->assertEquals($user2->getName(), $actual[1]->getName());
        $this->assertEquals($user2->getEmail(), $actual[1]->getEmail());
        $this->assertNotEmpty($actual[1]->getCreatedAt());
        $this->assertNotEmpty($actual[1]->getUpdatedAt());
    }

    public function testShouldFindAnUserThenThrowException(): void
    {        
        $this->expectException(ObjectNotFoundException::class);
        $repository = new UserRepository();
        $repository->find(1);        
    }
}
