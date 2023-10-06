<?php

namespace App\Controller;

use App\DTO\QuizDTO;
use App\Repository\Interfaces\QuizRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use OpenApi\Attributes as OA;
use Nelmio\ApiDocBundle\Annotation\Model;

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
    #[OA\Tag(name: 'quizz')]
    #[OA\Response(
        response: 200,
        description: "Returns a QuizDTO.",
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: QuizDTO::class))
        )
    )]
    public function GetQuiz(int $id): JsonResponse
    {
        $quiz = $this->quizRepository->findById($id);
        $quizJSON = $this->serializer->serialize($quiz, 'json');

        return new JsonResponse($quizJSON);
    }

    #[Route('/api/v1/quiz', methods: ['POST'])]
    #[OA\Tag(name: 'quizz')]
    #[OA\RequestBody(content: new OA\JsonContent(ref: new Model(type: QuizDTO::class)))]
    #[OA\Response(
        response: 200,
        description: "Returns the validity of added quiz",
    )]
    public function CreateQuiz(Request $request): JsonResponse
    {
        $jsonPayload = $request->getContent();
        $quizDTO = $this->serializer->deserialize($jsonPayload, QuizDTO::class, 'json');

        $this->quizRepository->add($quizDTO);
        return new JsonResponse(["msg" => 'success']);
    }

    #[Route('/api/v1/quiz/{id}', methods: ['PUT'])]
    #[OA\Tag(name: 'quizz')]
    #[OA\RequestBody(required: true,
        content: new OA\JsonContent(ref: new Model(type: QuizDTO::class))
    )]
    #[OA\Response(
        response: 200,
        description: "Returns a success message for updated quiz entity.",
    )]
    public function UpdateQuiz(int $id): JsonResponse
    {
        return new JsonResponse(["msg" => 'success']);
    }

    #[Route('/api/v1/quiz/{id}', methods: ['DELETE'])]
    #[OA\Tag(name: 'quizz')]
    #[OA\Response(
        response: 200,
        description: "Returns a success message for deleted quiz entity.",
    )]
    public function DeleteQuiz(int $id): JsonResponse
    {
        $isSuccess = $this->quizRepository->delete($id);

        return new JsonResponse(["msg" => $isSuccess ? 'success' : 'failed']);
    }
}