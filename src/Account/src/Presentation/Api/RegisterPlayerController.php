<?php

namespace Account\Presentation\Api;

use Account\Application\Command\RegisterPlayerCommand;
use SharedKernel\Application\Command\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/account')]
class RegisterPlayerController extends AbstractController
{
    private SerializerInterface $serializer;
    private CommandBusInterface $commandBus;

    public function __construct (SerializerInterface $serializer, CommandBusInterface $commandBus)
    {
        $this->serializer = $serializer;
        $this->commandBus = $commandBus;
    }

    #[Route('/players', name: 'register_player', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        $command = $this->serializer->deserialize(
            $request->getContent(),
            RegisterPlayerCommand::class,
            'json'
        );
        $response = $this->commandBus->dispatch($command);

        return new JsonResponse($response->id, JsonResponse::HTTP_CREATED);
    }
}
