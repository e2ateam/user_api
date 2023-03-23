<?php

namespace App\Core\UseCase\User\Update;

class InputUpdateUserDto
{
    private string $id;

    private string $name;

    public function __construct(
        string $id,
        string $name,
    ) {
        $this->id = $id;
        $this->name = $name;
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
}
