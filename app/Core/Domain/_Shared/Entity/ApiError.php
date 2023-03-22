<?php

namespace App\Core\Domain\_Shared\Entity;

use App\Core\Domain\_Shared\Converter\ArrayToObject;
use App\Core\Domain\_Shared\Notification\NotificationErrorProps;
use Carbon\Carbon;

class ApiError
{
    private Carbon $timestamp;
    private NotificationErrorProps $message;
    private string $uri;
    
    public function __construct(string $message, string $uri)
    {
        $this->timestamp = Carbon::now();
        $this->message = ArrayToObject::convert(
            NotificationErrorProps::class, 
            $message
        );
        $this->uri = $uri;
    }    

    public function serialize() {
        return get_object_vars($this);
    }

    /**
     * Get the value of timestamp
     */ 
    public function getTimestamp(): string
    {
        return $this->timestamp;
    }

    /**
     * Get the value of message
     */ 
    public function getMessage(): Object
    {
        return $this->message;
    }

    /**
     * Get the value of uri
     */ 
    public function getUri(): string
    {
        return $this->uri;
    }
}
