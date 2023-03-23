<?php

namespace App\Core\Domain\_Shared\Event;

class EventDispatcher implements EventDispatcherInterface
{
    private $eventHandlers = [];

    public function getEventHandler(string $eventName): null|array
    {
        if (! array_key_exists($eventName, $this->eventHandlers)) {
            return null;
        }

        return $this->eventHandlers[$eventName];
    }

    public function register(string $eventName, EventHandlerInterface $eventHandler): void
    {
        if (! array_key_exists($eventName, $this->eventHandlers)) {
            $this->eventHandlers[$eventName] = [];
        }

        array_push($this->eventHandlers[$eventName], $eventHandler);
    }

    public function unregister(string $eventName, EventHandlerInterface $eventHandler): void
    {
        if (array_key_exists($eventName, $this->eventHandlers)) {
            $index = array_search($eventHandler, $this->eventHandlers[$eventName]);

            if ($index !== false) {
                array_splice($this->eventHandlers[$eventName], $index, 1);
            }
        }
    }

    public function unregisterAll(): void
    {
        $this->eventHandlers = [];
    }

    public function notify($event): void
    {
        $eventName = $this->getClassName($event);

        if (isset($this->eventHandlers[$eventName])) {
            foreach ($this->eventHandlers[$eventName] as $eventHandler) {
                $eventHandler->handle($event);
            }
        }
    }

    private function getClassName($event): string
    {
        $pkgName = get_class($event);
        $list = explode('\\', $pkgName);
        $tam = count($list);

        return $list[$tam - 1];
    }
}
