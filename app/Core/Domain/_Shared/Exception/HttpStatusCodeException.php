<?php

namespace App\Core\Domain\_Shared\Exception;

use Exception;
use Throwable;

/**
 * @codeCoverageIgnore
 */
class HttpStatusCodeException extends Exception
{
    public function __construct(
        string $message = '', 
        int $code, 
        Throwable|null $previous = null
    ) {          
        parent::__construct($message, $code, $previous);
    }
}
