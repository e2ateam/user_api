<?php

namespace App\Core\Domain\_Shared\Exception;

use App\Core\Domain\_Shared\Converter\ArrayToJson;
use App\Core\Domain\_Shared\Enum\HttpStatus;

class AuthorizationException extends HttpException {
    public function __construct(array $errors) {
        $json = ArrayToJson::convert($errors);
        parent::__construct($json, HttpStatus::HTTP_FORBIDDEN);
    }
}
