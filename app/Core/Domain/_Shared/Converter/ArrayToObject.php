<?php

namespace App\Core\Domain\_Shared\Converter;

class ArrayToObject
{
    public static function convert(string $className, array $array) 
    {
        return unserialize(sprintf(
            'O:%d:"%s"%s',
            strlen($className),
            $className,
            strstr(serialize($array), ':')
        ));
    }
}
