<?php

namespace App\Core\Infrastructure\User\Repository;

use App\Core\Domain\User\Entity\User;
use App\Core\Domain\User\Repository\UserRepositoryInterface;
use App\Models\User as UserModel;
use E2ateam\Shared\Constants\Constants;
use E2ateam\Shared\Converter\ObjectToArray;
use E2ateam\Shared\Exception\ObjectNotFoundException;

class UserRepository implements UserRepositoryInterface
{
    public function create(User $input): User
    {
        $user = UserModel::factory()->create(ObjectToArray::convert(
            User::class,
            $input
        ));

        return new User(
            $user->id,
            $input->getName(),
            $input->getEmail(),
            $input->getPassword(),
            $user->created_at,
            $user->updated_at,
        );
    }

    public function update(User $input): User
    {
        $model = $this->findModel($input->getId());
        $password = $model->password;
        $model->fill(ObjectToArray::convert(User::class, $input));
        $model->password = $password;
        $model->save();

        return $input;
    }

    public function find(string $id): User
    {
        $user = $this->findModel($id);

        return new User(
            $user->id,
            $user->name,
            $user->email,
            '******',
            $user->created_at,
            $user->updated_at,
        );
    }

    public function findAll(int $pagination): array
    {
        $usersModel = UserModel::paginate($pagination);

        $users = [];
        foreach ($usersModel as $userModel) {
            $user = new User(
                $userModel->id,
                $userModel->name,
                $userModel->email,
                '******',
                $userModel->created_at,
                $userModel->updated_at,
            );
            array_push($users, $user);
        }

        return $users;
    }

    private function findModel(string $id): UserModel
    {
        $user = UserModel::find($id);

        if (empty($user)) {
            throw new ObjectNotFoundException(printf(
                Constants::OBJECT_NOT_FOUND,
                $id, User::class
            ));
        }

        return $user;
    }
}
