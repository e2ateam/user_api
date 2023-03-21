<?php

namespace App\Core\Domain\_Shared\Exception;

use App\Core\Domain\_Shared\Converter\ArrayToJson;
use App\Core\Domain\_Shared\Enum\HttpStatus;

/**
 * @codeCoverageIgnore
 */
class NotificationException extends HttpException
{
    public function __construct(array $errors, HttpStatus $statusCode)
    {
        $json = ArrayToJson::convert($errors);
        parent::__construct($json, $statusCode);
    }
}
