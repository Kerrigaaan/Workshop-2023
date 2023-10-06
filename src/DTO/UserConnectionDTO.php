<?php

namespace App\DTO;

use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Constraints as Assert;

class UserConnectionDTO
{
    public function __construct(
        #[OA\Property(type: 'string', example: 'bobby.bob@epsi.com')]
        #[Assert\NotBlank]
        public string $token,
    ) {}
}