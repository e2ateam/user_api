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
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }
}
