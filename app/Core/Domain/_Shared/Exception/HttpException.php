<?php

namespace App\Core\Domain\_Shared\Exception;

use App\Core\Domain\_Shared\Entity\ApiError;
use App\Core\Domain\_Shared\Enum\HttpStatus;
use Illuminate\Http\Request;

/**
 * @codeCoverageIgnore
 */
class HttpException extends HttpStatusCodeException
{
    public function __construct(string $message, HttpStatus $statusCode)
    {
        parent::__construct($message, $statusCode->value);
    }

    public function render(Request $request)
    {       
        $err = new ApiError(
            $this->getMessage(),
            $request->getUri(),
        );        

        return response()->json($err->serialize(), $this->getCode());
    }
}
