<?php

namespace SharedKernel\Application\Command\Middleware;

use SharedKernel\Application\Command\CommandBusInterface;
use SharedKernel\Application\Command\CommandResponse;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineFlushMiddleware implements CommandBusInterface
{    
    private CommandBusInterface $next;
    private EntityManagerInterface $entityManager;

    public function __construct(
        CommandBusInterface $next,
        ManagerRegistry $doctrine
    ) {
        $this->next = $next;
        $this->entityManager = $doctrine->getManager();
    }
    
    public function dispatch(object $command): CommandResponse
    {
        $this->entityManager->getConnection()->beginTransaction();
        try {
            $commandResponse = $this->next->dispatch($command);
            $this->entityManager->flush();
            $this->entityManager->getConnection()->commit();
        } catch(\Exception $error) {
            $this->entityManager->getConnection()->rollback();
        }

        return $commandResponse;
    }
}