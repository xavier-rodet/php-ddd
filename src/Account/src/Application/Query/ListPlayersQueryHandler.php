<?php

namespace Account\Application\Query;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\EntityManagerProvider;
use Doctrine\Persistence\ManagerRegistry;
use SharedKernel\Application\Query\QueryHandlerInterface;

class ListPlayersQueryHandler implements QueryHandlerInterface
{
    private EntityManagerInterface $em;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->em = $doctrine->getManager('account'); // TODO: config yaml the right manager to inject it automatically
    }

    public function handle(object $query): array
    {
        return $this->em
            ->createQuery("SELECT p FROM Account:Player p")
            ->getArrayResult();
    }

    public function listenTo(): string
    {
        return ListPlayersQuery::class;
    }
}