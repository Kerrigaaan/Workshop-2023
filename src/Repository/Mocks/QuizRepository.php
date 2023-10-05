<?php

namespace App\Repository\Mocks;

use App\DTO\quizDTO;
use App\Repository\Interfaces\QuizRepositoryInterface;

class QuizRepository implements QuizRepositoryInterface
{
    private static bool $needData = false;
    private static array $data;

    public function __construct()
    {
        if (self::$needData === false) {
            self::$data = [
                (object)['question_list' => ['Combien de chèvres ?', 'TWWWAAAT'], 'activate_at' => new \DateTimeImmutable()],
                (object)['question_list' => ['Quel pizza ?', 'Pepereoni ?'], 'activate_at' => null],
                (object)['question_list' => ['Quel processeur ?', 'Quel zoo ?'], 'activate_at' => new \DateTimeImmutable()],
            ];
            self::$needData = true;
        }
    }

    public function add(quizDTO $quiz): void
    {
        QuizRepository::$data[] = $quiz;
    }

    public function findById(int $id): quizDTO
    {
        if (0 <= $id && $id < count(QuizRepository::$data)) {
            $object = QuizRepository::$data[$id];
            return new quizDTO($object->question_list, $object->activate_at);
        }
        return new quizDTO([], null);
    }

    public function update(int $id, quizDTO $quizDTO): void
    {
        if (0 <= $id && $id < count(QuizRepository::$data)) {
            QuizRepository::$data[$id] = $quizDTO;
        }
    }

    public function delete(int $id): void
    {
        if (0 <= $id && $id < count(QuizRepository::$data)) {
            unset(QuizRepository::$data[$id]);
            QuizRepository::$data = array_values(QuizRepository::$data);
        }
    }
}