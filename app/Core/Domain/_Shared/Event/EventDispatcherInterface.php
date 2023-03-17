<?php

namespace App\Core\Domain\_Shared\Event;

interface EventDispatcherInterface
{
    public function notify(Event $event): void;
    public function register(string $eventName, EventHandlerInterface $eventHandler): void;
    public function unregister(string $eventName, EventHandlerInterface $eventHandler): void;
    public function unregisterAll(): void;    
}
