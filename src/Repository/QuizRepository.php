<?php

namespace App\Repository;

use App\DTO\quizDTO;
use App\Entity\Quiz;
use App\Repository\Interfaces\QuizRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Quiz>
 *
 * @method Quiz|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quiz|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quiz[]    findAll()
 * @method Quiz[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizRepository extends ServiceEntityRepository implements QuizRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quiz::class);
    }

    public function add(quizDTO $quiz): void
    {
    }

    public function findById(int $id): quizDTO
    {
        return new quizDTO([], null);
    }

    public function update(int $id, quizDTO $quizDTO): void
    {

    }

    public function delete(int $id): bool
    {
        return true;
    }
}
