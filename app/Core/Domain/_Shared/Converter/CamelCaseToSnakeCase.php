<?php

namespace App\Core\Domain\_Shared\Converter;

class CamelCaseToSnakeCase
{
    public static function convertString(string $values): string
    {
        return CamelCaseToSnakeCase::convert($values);
    }

    public static function convertArray(array $values): array
    {
        $result = [];
        foreach ($values as $index => $value) {
            $newIndex = CamelCaseToSnakeCase::convert($index);
            $result[$newIndex] = $value;
        }

        return $result;
    }

    private static function convert(string $value): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $value));
    }
}
