<?php

namespace App\Core\_Shared\Exception;

use App\Core\_Shared\Enum\HttpStatus;

/**
 * @codeCoverageIgnore
 */
class HttpException extends HttpStatusCodeException
{
    public function __construct(string $message, HttpStatus $statusCode) {
        parent::__construct($message, $statusCode->value);
    }
}
