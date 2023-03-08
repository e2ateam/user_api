<?php

namespace App\Core\_Shared\Notification;

class Notification
{
    private $errors = [];

    public function addError(NotificationErrorProps $error)
    {
        array_push($this->errors, $error);
    }

    public function hasErrors(): bool
    {
        return count($this->errors) > 0;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function messages(?string $context): string
    {
        $message = "";
        foreach($this->errors as $error) {
            if (empty($context) || $error->getContext() === $context) {
                $message .= $error->getContext() . ': ' . $error->getMessage() . ",";
            }
        }
        return $message;
    }
}
