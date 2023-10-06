<?php

namespace App\Repository\Interfaces;

use App\DTO\UserConnectionDTO;
use App\DTO\UserDTO;

interface UserRepositoryInterface
{
    public function IsUserCredentialsValid(UserDTO $user): bool;
    public function findUserById(int $id): ?UserDTO;
    public function createUser(UserDTO $user): bool;
}