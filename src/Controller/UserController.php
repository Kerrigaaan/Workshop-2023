<?php

namespace App\Controller;

use App\DTO\UserDTO;
use App\Repository\Interfaces\UserRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends AbstractController
{
    private SerializerInterface $serializer;
    private UserRepositoryInterface $userRepository;

    public function __construct(SerializerInterface $serializer, UserRepositoryInterface $userRepository)
    {
        $this->serializer = $serializer;
        $this->userRepository = $userRepository;
    }

    #[Route('/api/v1/user/{id}', methods: ['GET'])]
    #[OA\Tag(name: 'user')]
    #[OA\Response(
        response: 200,
        description: "Returns a UserDTO.",
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: UserDTO::class))
        )
    )]
    public function GetQuiz(int $id): JsonResponse
    {
        $user = $this->userRepository->findUserById($id);
        $userJSON = $this->serializer->serialize($user, 'json');

        return new JsonResponse($userJSON);
    }

    #[Route('/api/v1/user', methods: ['POST'])]
    #[OA\Tag(name: 'user')]
    #[OA\RequestBody(content: new OA\JsonContent(ref: new Model(type: UserDTO::class)))]
    #[OA\Response(
        response: 200,
        description: "Returns if user has been created correctly",
    )]
    public function CreateUser(Request $request):JsonResponse
    {
        $jsonPayload = $request->getContent();
        $userDTO = $this->serializer->deserialize($jsonPayload, UserDTO::class, 'json');

        $isSuccess = $this->userRepository->createUser($userDTO);
        // TODO: Renvoyer un code erreur adapté
        return new JsonResponse(["msg" => $isSuccess ? 'success' : 'failed']);
    }

    #[Route('/api/v1/user/login', methods: ['POST'])]
    #[OA\Tag(name: 'user')]
    #[OA\RequestBody(content: new OA\JsonContent(ref: new Model(type: UserDTO::class)))]
    #[OA\Response(
        response: 200,
        description: "Returns if user has been logged",
    )]
    public function Login(Request $request):JsonResponse
    {
        $jsonPayload = $request->getContent();
        $userDTO = $this->serializer->deserialize($jsonPayload, UserDTO::class, 'json');

        $isSuccess = $this->userRepository->IsUserCredentialsValid($userDTO);
        return new JsonResponse(["msg" => $isSuccess ? 'success' : 'failed']);
    }
}