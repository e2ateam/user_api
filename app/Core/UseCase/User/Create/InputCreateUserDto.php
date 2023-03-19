<?php

namespace App\Core\UseCase\User\Create;

class InputCreateUserDto
{
    private string $name;
    private string $email;
    private string $password;

    public function __construct(
        string $name, 
        string $email, 
        string $password
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }    

    /**
     * Get the value of name
     */ 
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword(): string
    {
        return $this->password;
    }
}
