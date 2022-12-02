<?php

namespace Account\Presentation\Api;

use Account\Application\Query\ListPlayersQuery;
use SharedKernel\Application\Query\QueryBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/account')]
class ListPlayersController extends AbstractController
{
    private QueryBusInterface $queryBus;

    public function __construct (QueryBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    #[Route('/players', name: 'list_players', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        $query = new ListPlayersQuery();
        $response = $this->queryBus->dispatch($query);

        return new JsonResponse($response, JsonResponse::HTTP_OK);
    }
}
