<?php

namespace App\Core\Domain\User\Entity;

use App\Core\Domain\_Shared\Entity\Entity;
use App\Core\Domain\_Shared\Enum\HttpStatus;
use App\Core\Domain\_Shared\Exception\NotificationException;
use App\Core\Domain\User\Factory\UserValidatorFactory;

class User extends Entity
{
    private ?string $name;
    private ?string $email;
    private ?string $password;

    public function __construct(
        ?string $id,
        ?string $name, 
        ?string $email, 
        ?string $password
    ) {
        parent::__construct($id);
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
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
}
