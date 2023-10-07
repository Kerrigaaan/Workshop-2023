<?php

namespace App\DataTransformers;

use App\DTO\quizDTO;
use App\Entity\Quiz;

class QuizEntityToQuizDTO
{
    public static function transformToDTO(?Quiz $quiz): ?QuizDTO
    {
        if (is_null($quiz)) return null;
        return new QuizDTO($quiz->getQuestionList(), $quiz->getActivateAt());
    }
}