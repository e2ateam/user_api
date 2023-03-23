<?php

namespace App\Http\Controllers\Auth;

use App\Core\Domain\User\Repository\UserRepositoryInterface;
use App\Core\UseCase\User\Create\CreateUserUseCase;
use App\Core\UseCase\User\Create\InputCreateUserDto;
use App\Core\UseCase\User\Update\InputUpdateUserDto;
use App\Core\UseCase\User\Update\UpdateUserUseCase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        protected UserRepositoryInterface $repository,
    ) { }

    public function store(Request $request)
    {
        $input = new InputCreateUserDto(
            $request->name ?? '',
            $request->email ?? '',
            $request->password ?? '',
        );
        $usecase = new CreateUserUseCase($this->repository);
        $usecase->execute($input);
        return response()
            ->noContent(201)
            ->withHeaders([
                'location' => route('user.show'),
            ]);
    }

    public function update(Request $request)
    {
        $this->isAuthenticated();
        $input = new InputUpdateUserDto(
            $this->user->id,
            $request->name ?? '',
            $request->email ?? '',            
        );
        $usecase = new UpdateUserUseCase($this->repository);
        $usecase->execute($input);
        return response()
            ->noContent(204)
            ->withHeaders([
                'location' => route('user.show'),
            ]);
    }
}
