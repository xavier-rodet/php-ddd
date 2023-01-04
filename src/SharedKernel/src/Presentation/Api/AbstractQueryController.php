<?php

namespace SharedKernel\Application\Presentation\Api;

use Psr\Log\LoggerInterface;
use SharedKernel\Application\Query\QueryBusInterface;
use SharedKernel\Application\Exception\UnauthorizedException;
use SharedKernel\Application\Query\QueryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class AbstractQueryController extends AbstractController
{
    private QueryBusInterface $queryBus;
    private LoggerInterface $logger;

    public function __construct (
        QueryBusInterface $queryBus,
        LoggerInterface $logger
    ) {
        $this->queryBus = $queryBus;
        $this->logger = $logger;
    }

    protected function getJsonResponse(QueryInterface $query, int $successStatus): JsonResponse
    {
        try {
            $queryResponse = $this->queryBus->dispatch($query);
            $response = new JsonResponse($queryResponse, $successStatus);
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
