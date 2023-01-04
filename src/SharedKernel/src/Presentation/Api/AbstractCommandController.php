<?php

namespace SharedKernel\Application\Presentation\Api;

use Psr\Log\LoggerInterface;
use SharedKernel\Application\Command\CommandBusInterface;
use SharedKernel\Application\Command\CommandInterface;
use SharedKernel\Application\Exception\UnauthorizedException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class AbstractCommandController extends AbstractController
{
    private CommandBusInterface $commandBus;
    private LoggerInterface $logger;

    public function __construct (
        CommandBusInterface $commandBus,
        LoggerInterface $logger
    ) {
        $this->commandBus = $commandBus;
        $this->logger = $logger;
    }

    protected function getJsonResponse(CommandInterface $command, int $successStatus): JsonResponse
    {
        try {
            $commandResponse = $this->commandBus->dispatch($command);
            $response = new JsonResponse($commandResponse->id, $successStatus);
        }
        catch(UnauthorizedException $exception) {
            $this->logger->notice('Unauthorized exception', ['message' => $exception->getMessage()]);
            $response = new JsonResponse(null, JsonResponse::HTTP_FORBIDDEN);
        }
        catch(\Exception $exception) {
            $this->logger->error('Uncaught exception', ['message' => $exception->getMessage()]);
            $response = new JsonResponse(null, JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $response;
    }
}
