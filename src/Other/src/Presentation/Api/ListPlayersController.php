<?php

namespace Other\Presentation\Api;

use Other\Application\Query\ListPlayersQuery;
use Psr\Log\LoggerInterface;
use SharedKernel\Application\Presentation\Api\AbstractQueryController;
use SharedKernel\Application\Query\QueryBusInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ListPlayersController extends AbstractQueryController
{
    public function __construct(
        QueryBusInterface $queryBus,
        LoggerInterface $logger
    ) {
        parent::__construct($queryBus, $logger);
    }

    #[Route('/players', name: 'list_players', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        return $this->getJsonResponse(new ListPlayersQuery(), JsonResponse::HTTP_OK);
    }
}
