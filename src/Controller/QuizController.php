<?php

namespace App\Controller;

use App\DTO\quizDTO;
use App\Repository\Interfaces\QuizRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class QuizController extends AbstractController
{
    private SerializerInterface $serializer;
    private QuizRepositoryInterface $quizRepository;

    public function __construct(SerializerInterface $serializer, QuizRepositoryInterface $quizRepository)
    {
        $this->serializer = $serializer;
        $this->quizRepository = $quizRepository;
    }

    #[Route('/api/v1/quiz/{id}', methods: ['GET'])]
    public function GetQuiz(int $id): JsonResponse
    {
        $quiz = $this->quizRepository->findById($id);
        $quizJSON = $this->serializer->serialize($quiz, 'json');

        return new JsonResponse($quizJSON);
    }
}