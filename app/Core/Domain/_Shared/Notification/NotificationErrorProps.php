<?php

namespace App\Core\Domain\_Shared\Notification;

class NotificationErrorProps
{
    private string $context;
    private string $message;    

    public function __construct(string $context, string $message)
    {
        $this->context = $context;
        $this->message = $message;        
    }

    /**
     * Get the value of message
     */ 
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Get the value of context
     */ 
    public function getContext(): string
    {
        return $this->context;
    }

    public function serialize(){
        return get_object_vars($this);
    }
}
