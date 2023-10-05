<?php

namespace App\DTO;

use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Constraints as Assert;

class QuizQuestionDTO
{
    public function __construct(
        #[OA\Property(type: 'string', example: "Quelle est la principale source de pollution de l'air dans les villes ?")]
        #[Assert\NotBlank]
        public string $question,

        #[OA\Property(type: 'array',
            items: new OA\Items(
                type: 'string',
                example: [
                    'Les transports',
                    "L'agriculture",
                    "L'industrie",
                    "Les déchets",
                ]
            )
        )]
        #[Assert\NotBlank]
        public array  $answers,

        #[OA\Property(type: 'integer', example: 0)]
        #[Assert\NotBlank]
        public int    $answerIndex,

        #[OA\Property(type: 'string', example: "Les transports, en particulier les véhicules à combustion interne, sont la principale source de pollution de l'air dans les villes en raison des émissions de gaz d'échappement contenant des polluants tels que les oxydes d'azote (NOx) et les particules fines.")]
        public ?string $explanation,
    ) {}
}