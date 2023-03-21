<?php

namespace App\Core\Domain\User\Entity;

use App\Core\Domain\_Shared\Entity\Entity;
use App\Core\Domain\_Shared\Enum\HttpStatus;
use App\Core\Domain\_Shared\Exception\NotificationException;
use App\Core\Domain\User\Factory\UserValidatorFactory;
use Carbon\Carbon;

class User extends Entity
{
    private string $name;
    private ?string $email;
    private string $password;   
    private ?Carbon $createdAt; 
    private ?Carbon $updatedAt;

    public function __construct(
        ?string $id,
        string $name, 
        ?string $email, 
        ?string $password = null,
        Carbon $createdAt = null,
        Carbon $updatedAt = null,
    ) {
        parent::__construct($id);
        $this->name = $name;
        $this->email = $email;
        $this->password = $password ?? '******';
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->validate();
    }

    public function validate()
    {
        UserValidatorFactory::create()->validate($this);
        if ($this->getNotification()->hasErrors()) {
            throw new NotificationException(
                $this->getNotification()->getErrors(),
                HttpStatus::HTTP_UNPROCESSABLE_ENTITY,
            );
        }
    }
    
    public function changeName(string $name)
    {
        $this->name = $name;
        $this->validate();
    }

    public function changeEmail(string $email)
    {
        $this->email = $email;
        $this->validate();
    }

    public function changePassword(string $password)
    {
        $this->password = $password;
        $this->validate();
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

    /**
     * Get the value of createdAt
     */ 
    public function getCreatedAt(): null|Carbon
    {
        return $this->createdAt;
    }

    /**
     * Get the value of updatedAt
     */ 
    public function getUpdatedAt(): null|Carbon
    {
        return $this->updatedAt;
    }
}
