<?php

namespace App\Core\Domain\_Shared\Entity;

use App\Core\Domain\_Shared\Notification\Notification;

class Entity
{
    private string $id;

    private Notification $notification;

    public function __construct(?string $id)
    {
        $this->id = $id ?? '';
        $this->notification = new Notification();
    }

    /**
     * Get the value of id
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get the value of notification
     */
    public function getNotification(): Notification
    {
        return $this->notification;
    }
}
