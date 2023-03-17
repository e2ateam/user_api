<?php

namespace Tests\Core\Domain\_Share\Formatter;

use App\Core\Domain\_Shared\Formatter\Formatter;
use DateTime;
use Tests\TestCase;

class FormatterTest extends TestCase
{    
    public function testConversionDateToStr(): void
    {
        $actual = Formatter::dateToStr(new DateTime('2023-02-10 10:05:59'));
        $expected = '2023-02-10';
        $this->assertEquals($expected, $actual);
    }

    public function testConversionDateTimeToStr(): void
    {
        $actual = Formatter::dateTimeToStr(new DateTime('2023-02-10 10:05:59'));
        $expected = '2023-02-10 10:05:59';
        $this->assertEquals($expected, $actual);
    }
}
