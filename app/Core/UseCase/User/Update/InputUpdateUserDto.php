<?php

namespace App\Core\UseCase\User\Update;

class InputUpdateUserDto
{
    private string $id;
    private string $name;
    private string $email;

    public function __construct(        
        string $id,
        string $name, 
        string $email,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * Get the value of id
     */ 
    public function getId(): string
    {
        return $this->id;
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
}
