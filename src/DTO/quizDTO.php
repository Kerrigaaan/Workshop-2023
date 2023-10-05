<?php

namespace App\DTO;

use OpenApi\Attributes as OA;

class quizDTO
{
    public function __construct(
        #[OA\Property(type: 'array', items: new OA\Items(type: 'string', example: '[bup,bup]'))]
        public array $question_list,
        public ?\DateTimeImmutable $activate_at,
)
    {}
}