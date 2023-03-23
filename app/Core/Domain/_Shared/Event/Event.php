<?php

namespace App\Core\Domain\_Shared\Event;

use DateTime;

final class Event
{
    private DateTime $dateTimeOccurred;

    private $eventData;

    public function __construct($eventData)
    {
        $this->dateTimeOccurred = new DateTime();
        $this->eventData = $eventData;
    }

    /**
     * Get the value of dateTimeOccurred
     */
    public function getDateTimeOccurred()
    {
        return $this->dateTimeOccurred;
    }

    /**
     * Get the value of eventData
     */
    public function getEventData()
    {
        return $this->eventData;
    }
}
