<?php

namespace App\Core\User\Validator;

use App\Core\_Shared\Entity\Entity;
use App\Core\_Shared\Notification\NotificationErrorProps;
use App\Core\_Shared\Converter\ObjectToArray;
use App\Core\_Shared\Validator\IValidator;
use App\Core\User\Entity\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserValidator implements IValidator
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
                    Rule::unique('users', 'email')->ignore($entity->getId())
                ],
                'password' => 'required|string|min:6|max:60'
            ]
        ); 

        if ($validator->fails()) {            
            $errors = $validator->errors()->messages();
            foreach ($errors as $index => $error) {
                $entity->getNotification()->addError(new NotificationErrorProps(
                    'user',
                    $index . ': ' . implode(', ', $error),
                ));
            }
        }
    }
}
