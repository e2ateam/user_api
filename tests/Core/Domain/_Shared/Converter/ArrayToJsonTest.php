<?php

namespace Tests\Core\Domain\_Shared\Converter;

use App\Core\Domain\_Shared\Converter\ArrayToJson;
use App\Core\Domain\_Shared\Entity\Entity;
use App\Core\Domain\_Shared\Factory\NotificationFactory;
use Tests\TestCase;

class ArrayToJsonTest extends TestCase
{
    public function testConvertArrayToJson(): void
    {        
        $actual = ArrayToJson::convert(NotificationFactory::create(
            'context', 
            'message'
        )->getErrors());
        $expected = '[{"context":"context","message":"message"}]';

        $this->assertEquals($expected, $actual);        
    }
}
