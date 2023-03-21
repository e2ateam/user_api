<?php

namespace App\Core\Domain\_Shared\Converter;

class CamelCaseToUnderlineLowerCase
{
    public static function convertString(string $values): string 
    {
        return CamelCaseToUnderlineLowerCase::convert($values);  
    } 

    public static function convertArray(array $values): array 
    {      
        $result = [];  
        foreach ($values as $index => $value) {            
            $newIndex = CamelCaseToUnderlineLowerCase::convert($index);
            $result[$newIndex] = $value;
        }
        return $result;
    }

    private static function hasUpperCase(string $value): bool
    {
        return preg_match('/\p{Lu}/u', $value);
    }

    private static function convert(string $value): string
    {
        $result = $value;
        if (CamelCaseToUnderlineLowerCase::hasUpperCase($value)) {
            $result = '';
            $length = strlen($value);
            for ($cont = 0; $cont < $length; $cont++) {
                if (CamelCaseToUnderlineLowerCase::hasUpperCase($value[$cont])) {
                    $result .= '_' . strtolower($value[$cont]);
                    continue;
                }

                $result .= $value[$cont];
            }
        }
        return $result;
    }
}