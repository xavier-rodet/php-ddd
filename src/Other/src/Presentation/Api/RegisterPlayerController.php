<?php

namespace Other\Presentation\Api;

use Other\Application\Command\RegisterPlayerCommand;
use Psr\Log\LoggerInterface;
use SharedKernel\Application\Command\CommandBusInterface;
use SharedKernel\Application\Presentation\Api\AbstractCommandController;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RegisterPlayerController extends AbstractCommandController
{
    private SerializerInterface $serializer;

    public function __construct (
        SerializerInterface $serializer, 
        CommandBusInterface $commandBus,
        LoggerInterface $logger
    ) {
        parent::__construct($commandBus, $logger);
        $this->serializer = $serializer;
    }

    #[Route('/players', name: 'register_player', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        $command = $this->serializer->deserialize(
            $request->getContent(),
            RegisterPlayerCommand::class,
            'json'
        );

        return $this->getJsonResponse($command, JsonResponse::HTTP_CREATED);
    }
}