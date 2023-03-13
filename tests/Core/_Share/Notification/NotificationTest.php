<?php

namespace Tests\Feature\Core\_Share\Notification;

use App\Core\_Shared\Notification\Notification;
use App\Core\_Shared\Notification\NotificationErrorProps;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    public function testShouldCreateErrors(): void
    {
        $error = new NotificationErrorProps(
            'customer',
            'Error message',            
        );
        $notification = new Notification();
        $notification->addError($error);        
        $actual = $notification->messages('customer');
        $this->assertEquals(1, count($actual));
        $this->assertEquals('customer', $actual[0]['context']);
        $this->assertEquals('Error message', $actual[0]['message']);

        $error = new NotificationErrorProps(
            'customer',
            'Error message 2',            
        );        
        $notification->addError($error);              
        $actual = $notification->messages('customer');
        $this->assertEquals(2, count($actual));
        $this->assertEquals('customer', $actual[0]['context']);
        $this->assertEquals('Error message', $actual[0]['message']);
        $this->assertEquals('customer', $actual[1]['context']);
        $this->assertEquals('Error message 2', $actual[1]['message']);

        $error = new NotificationErrorProps(
            'order',
            'Error message 3',            
        );        
        $notification->addError($error);
        $actual = $notification->messages('customer');
        $this->assertEquals(2, count($actual));
        $this->assertEquals('customer', $actual[0]['context']);
        $this->assertEquals('Error message', $actual[0]['message']);
        $this->assertEquals('customer', $actual[1]['context']);
        $this->assertEquals('Error message 2', $actual[1]['message']);
        
        $actual = $notification->messages('');
        $this->assertEquals(3, count($actual));
        $this->assertEquals('customer', $actual[0]['context']);
        $this->assertEquals('Error message', $actual[0]['message']);
        $this->assertEquals('customer', $actual[1]['context']);
        $this->assertEquals('Error message 2', $actual[1]['message']);
        $this->assertEquals('order', $actual[2]['context']);
        $this->assertEquals('Error message 3', $actual[2]['message']);        
    }

    public function testShouldCheckIfNotificationHasAtLeastOneError(): void
    {
        $error = new NotificationErrorProps(
            'customer',
            'Error message',
        );
        $notification = new Notification();
        $notification->addError($error);
        $this->assertEquals(true, $notification->hasErrors());
    }

    public function testShouldGetAllErrorsProps()
    {
        $error = new NotificationErrorProps(
            'customer',
            'Error message',
        );
        $notification = new Notification();
        $notification->addError($error);

        $error1 = new NotificationErrorProps(
            'customer',
            'Error message 1',
        );        
        $notification->addError($error1);
        $this->assertEquals([$error, $error1], $notification->getErrors());
    }

    public function testShouldSerializeObject()
    {
        $error = new NotificationErrorProps(
            'customer',
            'Error message',
        );               
        $error->serialize();
        $this->assertEquals($error->getContext(), 'customer');
        $this->assertEquals($error->getMessage(), 'Error message');
    }
}
