<?php

namespace App\DTO;

use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Constraints as Assert;

class UserDTO
{
    public function __construct(
        #[OA\Property(type: 'string', example: 'bobby.bob@epsi.com')]
        #[Assert\NotBlank]
        public string $email,

        public string $password,

        public int $id = 0,
    ) {}
}