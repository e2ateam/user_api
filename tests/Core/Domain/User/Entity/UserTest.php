<?php

namespace Tests\Core\Domain\User\Entity;

use App\Core\Domain\_Shared\Converter\ObjectToArray;
use App\Core\Domain\User\Entity\User;
use App\Models\User as UserModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{            
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();             

        try {
            $this->seed(User::class);            
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
        $this->assertEquals($user->getName(), 'Name');
        $this->assertEquals($user->getEmail(), 'name@yahoo.com.br');
        $this->assertEquals($user->getPassword(), 'password');                
    }

    public function testChangeUser(): void
    {        
        $user = new User(
            null,
            'Name', 
            'name@yahoo.com.br', 
            'password'
        );        
        $this->assertEquals($user->getName(), 'Name');
        $this->assertEquals($user->getEmail(), 'name@yahoo.com.br');
        $this->assertEquals($user->getPassword(), 'password');

        $user->changeName('Name 1');
        $user->changePassword('123456');
        $this->assertEquals('Name 1', $user->getName());
        $this->assertEquals('name@yahoo.com.br', $user->getEmail());
        $this->assertEquals('123456', $user->getPassword());
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

    public function testTryCreateUserWhenNameHasLessThan3CharacteresThenThrowNameException(): void
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
    
    public function testTryCreateUserWhenNameHasMoreThan150CharacteresThenThrowNameException(): void
    {        
        $this->expectExceptionMessage(
            '[{'.
                '"context":"user",'.
                '"message":"name: '.
                'The name field must not be greater than 150 characters."'.
            '}]',
        );        
        $name = str_repeat("a", 151);
        new User('', $name, 'name@yahoo.com.br', 'password');  
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
    
    public function testTryCreateUserWhenEmailHasMoreThan255CharacteresThenThrowEmailException(): void
    {                        
        $this->expectExceptionMessage(
            '[{'.
                '"context":"user",'.
                '"message":"email: '.
                'The email field must not be greater than 255 characters."'.
            '}]',
        );
        $email = str_repeat("a", 256) . '@gmail.com';
        new User('', 'Name', $email, 'password');
    }

    public function testTryCreateUserWhenEmailExistsThenThrowEmailException(): void
    {        
        $user = new User(
            null, 
            'Name', 
            'name@yahoo.com.br',
            'password'
        );
        UserModel::factory()->create(ObjectToArray::convert(
            User::class, 
            $user
        ));        
        $this->expectExceptionMessage(
            '[{'.
                '"context":"user",'.
                '"message":"email: '.
                'The email has already been taken."'.
            '}]',
        );
        new User(
            null, 
            'Name 1', 
            'name@yahoo.com.br',
            'password'
        );
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

    public function testTryCreateUserWhenPasswordHasLessThan3CharacteresThenThrowPasswordException(): void
    {                        
        $this->expectExceptionMessage(
            '[{'.
                '"context":"user",'.
                '"message":"password: '.
                'The password field must be at least 6 characters."'.
            '}]',
        );
        new User('', 'Name', 'name@yahoo.com.br', '12345');
    }

    public function testTryCreateUserWhenPasswordHasMoreThan60CharacteresThenThrowPasswordException(): void
    {                        
        $this->expectExceptionMessage(
            '[{'.
                '"context":"user",'.
                '"message":"password: '.
                'The password field must not be greater than 60 characters."'.
            '}]',
        );
        $password = str_repeat("a", 61);
        new User('', 'Name', 'name@yahoo.com.br', $password);
    }
}
