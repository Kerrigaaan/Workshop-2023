<?php

namespace App\Repository\Mocks;

use App\DTO\UserDTO;
use App\Repository\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    use MockingProperties;

    public function __construct()
    {
        if (self::$needData === false) {
            self::$data = [
                (object)['id' => 1, 'email' => 'jacquie@epsi.com', 'password' => 'verysecurepassword'],
                (object)['id' => 2,'email' => 'foo@epsi.com', 'password' => 'azerty'],
                (object)['id' => 3,'email' => 'michel@epsi.com', 'password' => 'ryuzz'],
            ];
        }
    }

    public function IsUserCredentialsValid(UserDTO $user): bool
    {
        $users = self::$data;

        foreach ($users as &$u) {
            if ($u->email === $user->email) {
                if ($u->password === $user->password)
                    return true;
                return false;
            }
        }
        return false;
    }

    public function findUserById(int $id): ?UserDTO
    {
        $users = self::$data;

        foreach ($users as &$u) {
            if ($u->id === $id)
                return new UserDTO($u->email, $u->password, $u->id);
        }
        return null;
    }

    public function createUser(UserDTO $user): bool
    {
        $userCount = count(self::$data);

        self::$data[] = new UserDTO($user->email, $user->password, $userCount + 1);
    }
}