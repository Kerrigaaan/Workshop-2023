<?php

namespace App\DataTransformers;

use App\DTO\quizDTO;
use App\Entity\Quiz;

class QuizEntityToQuizDTO
{
    public static function transformToDTO(Quiz $quiz): QuizDTO
    {
        return new QuizDTO($quiz->getQuestions(), $quiz->getActivateAt());
    }
}