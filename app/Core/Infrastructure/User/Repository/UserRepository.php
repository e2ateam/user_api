<?php

namespace App\Core\Infrastructure\User\Repository;

use App\Core\Domain\_Shared\Constants\Constants;
use App\Core\Domain\_Shared\Converter\ObjectToArray;
use App\Core\Domain\_Shared\Enum\HttpStatus;
use App\Core\Domain\_Shared\Exception\NotificationException;
use App\Core\Domain\_Shared\Exception\ObjectNotFoundException;
use App\Core\Domain\_Shared\Factory\NotificationFactory;
use App\Core\Domain\User\Entity\User;
use App\Core\Domain\User\Repository\IUserRepository;
use App\Models\User as UserModel;

class UserRepository implements IUserRepository
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
        $user = $this->findModel($input->getId());
        if ($user->email !== $input->getEmail()) {                        
            throw new NotificationException(
                NotificationFactory::create(
                    'user', 
                    'email: ' . Constants::FIELD_CANT_BE_CHANGED,
                )->getErrors(),
                HttpStatus::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $password = $user->password;        
        $user->fill(ObjectToArray::convert(User::class, $input));
        $user->password = $password;        
        $user->save();

        return new User(
            $user->id,
            $input->getName(),
            $input->getEmail(),  
            '******',          
            $user->created_at,
            $user->updated_at,
        );
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
        foreach($usersModel as $userModel) {
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
