<?php

namespace Tests\Feature\Core;

use App\Core\_Shared\Notification\Notification;
use App\Core\_Shared\Notification\NotificationErrorProps;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    
    public function testShouldCreateErrors(): void
    {
        $error = new NotificationErrorProps(
            "customer",
            "Error message",            
        );
        $notification = new Notification();
        $notification->addError($error);
        $this->assertEquals(
            "customer: Error message,", 
            $notification->messages("customer"),
        );

        $error = new NotificationErrorProps(
            "customer",
            "Error message 2",            
        );        
        $notification->addError($error);
        $this->assertEquals(
            "customer: Error message,customer: Error message 2,", 
            $notification->messages("customer"),
        );

        $error = new NotificationErrorProps(
            "order",
            "Error message 3",            
        );        
        $notification->addError($error);
        $this->assertEquals(
            "customer: Error message,customer: Error message 2,", 
            $notification->messages("customer"),
        );
        $this->assertEquals(
            "customer: Error message,customer: Error message 2," .
            "order: Error message 3,", 
            $notification->messages(""),
        );
    }

    public function testShouldCheckIfNotificationHasAtLeastOneError(): void
    {
        $error = new NotificationErrorProps(
            "customer",
            "Error message",
        );
        $notification = new Notification();
        $notification->addError($error);
        $this->assertEquals(true, $notification->hasErrors());
    }

    public function testShouldGetAllErrorsProps()
    {
        $error = new NotificationErrorProps(
            "customer",
            "Error message",
        );
        $notification = new Notification();
        $notification->addError($error);

        $error1 = new NotificationErrorProps(
            "customer",
            "Error message 1",
        );        
        $notification->addError($error1);
        $this->assertEquals([$error, $error1], $notification->getErrors());
    }
}
