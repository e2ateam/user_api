<?php

namespace App\Http\Controllers;

use App\Core\Domain\_Shared\Exception\AuthorizationException;
use App\Core\Domain\_Shared\Factory\NotificationFactory;
use App\Models\User as UserModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected UserModel $user;    

    public function isAuthenticated(): void
    {
        try {
            $this->user = Auth()->guard('api')->user();

            if ($this->user === null || $this->user->id === null) {
                throw new AuthorizationException(NotificationFactory::create(
                    'authentication',
                    'Access denied',
                )->getErrors());
            }
        } catch (\Throwable $ex) {
            throw new AuthorizationException(NotificationFactory::create(
                'authentication',
                'Access denied',
            )->getErrors());
        }
    }
}
