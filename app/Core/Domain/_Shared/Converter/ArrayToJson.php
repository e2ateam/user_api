<?php

namespace App\Core\Domain\_Shared\Converter;

class ArrayToJson
{
    public static function convert(array $errors)
    {
        $errorMsg = [];
        foreach ($errors as $error) {
            array_push($errorMsg, $error->serialize());
        }

        return json_encode(
            $errorMsg,
            JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
        );
    }
}
