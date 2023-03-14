<?php

namespace Tests\Core\User;

use App\Core\_Shared\Converter\ObjectToArray;
use App\Core\User\Entity\User;
use App\Models\User as ModelsUser;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{            
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();             

        try {
            $this->seed(User::class);
            $this->delete("users");
        } catch (\Exception $ex) { }
    }

    public function testCreateUser(): void
    {                
        $user = new User(
            null,
            'Name', 
            'name@yahoo.com.br', 
            'password'
        );
        $model = ModelsUser::factory()->create(ObjectToArray::convert(
            User::class, 
            $user
        ));
        $this->assertEquals($user->getName(), 'Name');
        $this->assertEquals($user->getEmail(), 'name@yahoo.com.br');
        $this->assertEquals($user->getPassword(), 'password');        
        $model->forceDelete();
    }

    public function testChangeUser(): void
    {        
        $user = new User(
            null,
            'Name', 
            'name@yahoo.com.br', 
            'password'
        );
        ModelsUser::factory()->create(ObjectToArray::convert(
            User::class, 
            $user
        ));
        $this->assertEquals($user->getName(), 'Name');
        $this->assertEquals($user->getEmail(), 'name@yahoo.com.br');
        $this->assertEquals($user->getPassword(), 'password');

        $user->changeName('Name 1');
        $user->changeEmail('name1@yahoo.com.br');
        $user->changePassword('123456');
        $this->assertEquals($user->getName(), 'Name 1');
        $this->assertEquals($user->getEmail(), 'name1@yahoo.com.br');
        $this->assertEquals($user->getPassword(), '123456');
    }

    /*public function testTryCreateUserWhenNameIsNullThenThrowNameException(): void
    {                        
        $this->expectExceptionMessage(
            '[{'.
                '"context":"user",'.
                '"message":"name: '.
                'The name field is required."'.
            '}]',
        );
        new User(null, null, 'name@yahoo.com.br', 'password');        
    } 
    
    public function testTryCreateUserWhenNameIsEmptyThenThrowNameException(): void
    {
        $this->expectExceptionMessage(
            '[{'.
                '"context":"user",'.
                '"message":"name: '.
                'The name field is required."'.
            '}]',
        );
        new User('', '', 'name@yahoo.com.br', 'password');         
    } 

    public function testTryCreateUserWhenNameHasLessThen3CharacteresThenThrowNameException(): void
    {        
        $this->expectExceptionMessage(
            '[{'.
                '"context":"user",'.
                '"message":"name: '.
                'The name field must be at least 3 characters."'.
            '}]',
        );
        new User('', 'ab', 'name@yahoo.com.br', 'password');  
    }

    public function testTryCreateUserWhenEmailIsNullThenThrowEmailException(): void
    {                        
        $this->expectExceptionMessage(
            '[{'.
                '"context":"user",'.
                '"message":"email: '.
                'The email field is required."'.
            '}]',
        );
        new User('', 'Name', null, 'password');
    }

    public function testTryCreateUserWhenEmailIsEmptyThenThrowEmailException(): void
    {                        
        $this->expectExceptionMessage(
            '[{'.
                '"context":"user",'.
                '"message":"email: '.
                'The email field is required."'.
            '}]',
        );
        new User('', 'Name', '', 'password');
    }

    public function testTryCreateUserWhenEmailIsInvalidThenThrowEmailException(): void
    {                        
        $this->expectExceptionMessage(
            '[{'.
                '"context":"user",'.
                '"message":"email: '.
                'The email field must be a valid email address."'.
            '}]',
        );
        new User('', 'Name', 'name', 'password');
    }

    public function testTryCreateUserWhenPasswordIsNullThenThrowPasswordException(): void
    {                        
        $this->expectExceptionMessage(
            '[{'.
                '"context":"user",'.
                '"message":"password: '.
                'The password field is required."'.
            '}]',
        );
        new User('', 'Name', 'name@yahoo.com.br', null);
    }

    public function testTryCreateUserWhenPasswordIsEmptyThenThrowPasswordException(): void
    {                        
        $this->expectExceptionMessage(
            '[{'.
                '"context":"user",'.
                '"message":"password: '.
                'The password field is required."'.
            '}]',
        );
        new User('', 'Name', 'name@yahoo.com.br', '');
    }

    public function testTryCreateUserWhenPasswordHasLessThen3CharacteresThenThrowPasswordException(): void
    {                        
        $this->expectExceptionMessage(
            '[{'.
                '"context":"user",'.
                '"message":"password: '.
                'The password field must be at least 6 characters."'.
            '}]',
        );
        new User('', 'Name', 'name@yahoo.com.br', '12345');
    }*/
}
