<?php

namespace App\Core\Domain\_Shared\Event;

interface EventHandlerInterface
{
    public function handle($event): void;
}
