<?php

namespace App\DTO;

use OpenApi\Attributes as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\Validator\Constraints as Assert;

class QuizDTO
{
    public function __construct(
        #[OA\Property(type: 'array', items: new OA\Items(ref: new Model(type: QuizQuestionDTO::class)))]
        #[Assert\NotBlank]
        public array               $question_list,

        public ?\DateTimeImmutable $activate_at,
    ) {}
}