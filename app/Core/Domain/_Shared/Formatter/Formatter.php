<?php

namespace App\Core\Domain\_Shared\Formatter;

use DateTime;

class Formatter
{
    private const DATE_FORMAT = 'Y-m-d';

    private const DATETIME_FORMAT = 'Y-m-d H:i:s';

    public static function dateToStr(DateTime $value)
    {
        return $value->format(self::DATE_FORMAT);
    }

    public static function dateTimeToStr(DateTime $value)
    {
        return $value->format(self::DATETIME_FORMAT);
    }
}
