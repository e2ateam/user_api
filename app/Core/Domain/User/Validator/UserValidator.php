<?php

namespace App\Core\Domain\User\Validator;

use App\Core\Domain\User\Entity\User;
use E2ateam\Shared\Converter\ObjectToArray;
use E2ateam\Shared\Entity\Entity;
use E2ateam\Shared\Notification\NotificationErrorProps;
use E2ateam\Shared\Validator\ValidatorInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserValidator implements ValidatorInterface
{
    public function validate(Entity $entity): void
    {
        $data = ObjectToArray::convert(
            User::class,
            $entity,
        );

        $validator = Validator::make(
            $data,
            [
                'name' => 'required|string|min:3|max:150',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('users', 'email')->ignore($entity->getId()),
                ],
                'password' => 'required|string|min:6|max:60',
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors()->messages();
            foreach ($errors as $index => $error) {
                $entity->getNotification()->addError(new NotificationErrorProps(
                    'user',
                    $index.': '.implode(', ', $error),
                ));
            }
        }
    }
}
