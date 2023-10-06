<?php

namespace App\Repository\Mocks;

use App\DTO\quizDTO;
use App\Repository\Interfaces\QuizRepositoryInterface;

class QuizRepository implements QuizRepositoryInterface
{
    use MockingProperties;

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
        self::$data[] = $quiz;
    }

    public function findById(int $id): ?quizDTO
    {
        if (0 <= $id && $id < count(self::$data)) {
            $object = self::$data[$id];
            return new quizDTO($object->question_list, $object->activate_at);
        }
        return new quizDTO([], null);
    }

    public function update(int $id, quizDTO $quizDTO): void
    {
        if (0 <= $id && $id < count(self::$data)) {
            self::$data[$id] = $quizDTO;
        }
    }

    public function delete(int $id): bool
    {
        if (0 <= $id && $id < count(self::$data)) {
            unset(self::$data[$id]);
            self::$data = array_values(self::$data);
            return true;
        }
        return false;
    }
}