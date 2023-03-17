<?php

namespace Tests\Core\Domain\_Shared\Event;

use App\Core\Domain\_Shared\Event\EventDispatcher;
use App\Core\Domain\_Shared\Event\EventHandlerInterface;
use App\Core\Domain\_Shared\Event\Event;
use App\Core\Domain\_Shared\Formatter\Formatter;
use Tests\TestCase;

class EventDispatcherTest extends TestCase
{
    public function testShouldRegisterAnEventHandler(): void
    {                 
        $eventDispatcher = new EventDispatcher();
        $eventHandler = new MockCreateHandler();

        $eventDispatcher->register("CreatedEvent", $eventHandler);
        $dispatcher = $eventDispatcher->getEventHandler('CreatedEvent');

        $this->assertEquals(
            true,
            isset($dispatcher),
        );
        $this->assertCount(
            1, 
            $eventDispatcher->getEventHandler('CreatedEvent'),
        );
        $this->assertSame(
            $eventHandler,
            $eventDispatcher->getEventHandler('CreatedEvent')[0],
        );
    }

    public function testShouldUnregisterAnEventHandler(): void
    {
        $eventDispatcher = new EventDispatcher();
        $eventHandler = new MockCreateHandler();

        $eventDispatcher->register('CreatedEvent', $eventHandler);
                
        $this->assertSame(
            $eventHandler,
            $eventDispatcher->getEventHandler('CreatedEvent')[0],
        );

        $eventDispatcher->unregister('CreatedEvent', $eventHandler);
        $dispatcher = $eventDispatcher->getEventHandler('CreatedEvent');

        $this->assertEquals(
            true, 
            isset($dispatcher)
        );

        $this->assertCount(
            0, 
            $eventDispatcher->getEventHandler('CreatedEvent'),
        );
    }

    public function testShouldUnregisterAllEventHandler(): void
    {
        $eventDispatcher = new EventDispatcher();
        $eventHandler = new MockCreateHandler();

        $eventDispatcher->register('CreatedEvent', $eventHandler);
                
        $this->assertSame(
            $eventHandler,
            $eventDispatcher->getEventHandler('CreatedEvent')[0],
        );

        $eventDispatcher->unregisterAll();
        $dispatcher = $eventDispatcher->getEventHandler('CreatedEvent');

        $this->assertEquals(
            false, 
            isset($dispatcher)
        );        
    }

    public function testShouldNotifyAllEventHandlers(): void
    {
        $event = new CreatedEvent([
            'name' => 'Product 1',
            'description' => 'Product 1 description',
            'price' => 10
        ]);

        $mock = $this->getMockBuilder(EventHandlerInterface::class)
            ->onlyMethods(['handle'])
            ->getMock();

        $mock->expects($this->once())
            ->method('handle')
            ->with($event);

        $eventDispatcher = new EventDispatcher();
        $eventHandler = new MockCreateHandler($mock);

        $eventDispatcher->register('CreatedEvent', $eventHandler);

        $this->assertSame(
            $eventHandler,
            $eventDispatcher->getEventHandler('CreatedEvent')[0],
        );                                    

        $eventDispatcher->notify($event);
    }
}

class CreatedEvent
{
    private Event $event;

    public function __construct($eventData)
    {
        $this->event = new Event($eventData);
    }

    public function getEvent(): Event
    {
        return $this->event;
    }
}

class MockCreateHandler implements EventHandlerInterface
{
    protected $observers = [];

    public function __construct($observer = null)
    {
        $this->observers[] = $observer;    
    }

    public function handle($event): void
    {
        echo 'Event occurred at ' . 
            Formatter::dateTimeToStr($event->getEvent()->getDateTimeOccurred()) .
            ' with the following payload:\n';
        print_r($event->getEvent()->getEventData());
        $this->spyOn($event);
    }

    private function spyOn($argument)
    {
        foreach ($this->observers as $observer) {
            $observer->handle($argument);
        }
    }
}
