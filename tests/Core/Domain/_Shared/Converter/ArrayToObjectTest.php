<?php

namespace Tests\Core\Domain\_Shared\Converter;

use App\Core\Domain\_Shared\Converter\ArrayToObject;
use App\Core\Domain\_Shared\Entity\Entity;
use App\Core\Domain\_Shared\Factory\NotificationFactory;
use App\Core\Domain\_Shared\Notification\NotificationErrorProps;
use Tests\TestCase;

class ArrayToObjectTest extends TestCase
{
    public function testConvertArrayToJson(): void
    {        
        $actual = ArrayToObject::convert(
            NotificationErrorProps::class,
            '[{"context":"authentication","message":"Access denied"}]',
        );                
        
        foreach ($actual as $value) {
            $this->assertEquals('authentication', $value['context']);
            $this->assertEquals('Access denied', $value['message']);
        }
    }
}
