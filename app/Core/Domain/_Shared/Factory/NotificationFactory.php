<?php

namespace App\Core\Domain\_Shared\Factory;

use App\Core\Domain\_Shared\Notification\Notification;
use App\Core\Domain\_Shared\Notification\NotificationErrorProps;

class NotificationFactory
{
    public static function create(string $context, string $message, ?Notification $notification = null): Notification
    {
        if ($notification === null) {
            $notification = new Notification();
        }
        $notification->addError(new NotificationErrorProps(
            $context,
            $message,
        ));
        return $notification;
    }
}
