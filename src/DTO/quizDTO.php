<?php

namespace App\DTO;

class quizDTO
{
    public function __construct(
        public array $question_list,
        public ?\DateTimeImmutable $activate_at,
)
    {}
}