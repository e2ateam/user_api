<?php

namespace App\Core\_Shared\Validator;

use App\Core\_Shared\Entity\Entity;

interface IValidator
{
    public function validate(Entity $entity): void;
}
