<?php

namespace App\Core\_Shared\Exception;

use App\Core\_Shared\Enum\HttpStatus;

/**
 * @codeCoverageIgnore
 */
class NotificationException extends HttpException
{
    public function __construct(array $errors, HttpStatus $statusCode)
    {
        $errorMsg = [];
        foreach ($errors as $error) {
            array_push($errorMsg, $error->serialize());
        }

        $json = json_encode(
            $errorMsg,
            JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
        );

        parent::__construct($json, $statusCode);
    }
}
