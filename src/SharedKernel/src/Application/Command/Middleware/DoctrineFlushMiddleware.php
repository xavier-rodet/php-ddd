<?php

namespace SharedKernel\Application\Command\Middleware;

use SharedKernel\Application\Command\CommandBusInterface;
use SharedKernel\Application\Command\CommandResponse;
use Doctrine\Persistence\ManagerRegistry;
use SharedKernel\Application\EntityManagerSelectorTrait;

class DoctrineFlushMiddleware implements CommandBusInterface
{
    use EntityManagerSelectorTrait;
    
    private CommandBusInterface $next;

    public function __construct(
        CommandBusInterface $next,
        ManagerRegistry $doctrine
    ) {
        $this->next = $next;
        $this->doctrine = $doctrine;
    }
    
    public function dispatch(object $command): CommandResponse
    {
        $em = $this->getDomainEntityManager($command);

        $em->getConnection()->beginTransaction();
        try {
            $commandResponse = $this->next->dispatch($command);
            $em->flush();
            $em->getConnection()->commit();
        } catch(\Exception $error) {
            $em->getConnection()->rollback();
        }

        return $commandResponse;
    }
}