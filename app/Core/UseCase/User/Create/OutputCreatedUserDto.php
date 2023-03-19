<?php

namespace App\Core\UseCase\User\Create;

use DateTime;

class OutputCreatedUserDto
{
    private string $id;
    private string $name;
    private string $email;    
    private DateTime $createdAt;
    private DateTime $updatedAt;

    public function __construct(
        string $id,
        string $name,
        string $email,
        DateTime $createdAt,
        DateTime $updatedAt,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
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

    /**
     * Get the value of createdAt
     */ 
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * Get the value of updatedAt
     */ 
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }
}
