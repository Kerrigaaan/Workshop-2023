<?php

namespace App\DataTransformers;

use App\DTO\UserDTO;
use App\Entity\User;

class UserEntityToUserDTO
{
    public static function transformToDTO(?User $user): ?UserDTO
    {
        if (is_null($user)) return null;
        return new UserDTO($user->getEmail(), $user->getPassword(), $user->getId());
    }
}