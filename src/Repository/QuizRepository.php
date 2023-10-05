<?php

namespace App\Repository;

use App\DataTransformers\QuizEntityToQuizDTO;
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
        // TODO: Faire l'ajout en BDD avec Doctrine
    }

    public function findById(int $id): ?quizDTO
    {
        $quiz = $this->findOneBy(['id' => $id]);
        return QuizEntityToQuizDTO::transformToDTO($quiz);
    }

    public function update(int $id, quizDTO $quizDTO): void
    {
        $quiz = $this->findOneBy(['id' => $id]);

        if (is_null($quiz)) return;
        $quiz->setQuestionList($quizDTO->question_list);
        $quiz->setActivateAt($quizDTO->activate_at);
        $this->_em->flush();
    }

    public function delete(int $id): bool
    {
        $quiz = $this->findOneBy(['id' => $id]);

        if (is_null($quiz)) return false;
        $this->_em->remove($quiz);
        $this->_em->flush();
        return true;
    }
}
