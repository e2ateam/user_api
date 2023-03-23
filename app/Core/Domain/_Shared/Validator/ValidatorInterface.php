<?php

namespace App\Core\Domain\_Shared\Validator;

use App\Core\Domain\_Shared\Entity\Entity;

interface ValidatorInterface
{
    public function validate(Entity $entity): void;
}
