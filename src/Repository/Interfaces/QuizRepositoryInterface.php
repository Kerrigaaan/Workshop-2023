<?php

namespace App\Repository\Interfaces;

use App\DTO\quizDTO;

interface QuizRepositoryInterface
{
    public function add(quizDTO $quiz): void;
    public function findById(int $id): quizDTO;
    public function update(int $id, quizDTO $quizDTO): void;
    public function delete(int $id): bool;
}