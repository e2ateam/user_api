<?php

namespace App\Core\Domain\_Shared\Event;

use DateTime;

final class Event
{
    private DateTime $dataTimeOccurred;
    private $eventData;

    public function __construct($eventData)
    {
        $this->dataTimeOccurred = new DateTime();
        $this->eventData = $eventData;
    }

    /**
     * Get the value of dataTimeOccurred
     */ 
    public function getDataTimeOccurred()
    {
        return $this->dataTimeOccurred;
    }

    /**
     * Get the value of eventData
     */ 
    public function getEventData()
    {
        return $this->eventData;
    }
}
