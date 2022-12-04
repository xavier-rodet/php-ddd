<?php

namespace SharedKernel\Application\Command\Middleware;

use SharedKernel\Application\Command\CommandBusInterface;
use SharedKernel\Application\Command\CommandResponse;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineFlushMiddleware implements CommandBusInterface
{    
    private CommandBusInterface $next;
    private EntityManagerInterface $em;

    public function __construct(
        CommandBusInterface $next,
        ManagerRegistry $doctrine
    ) {
        $this->next = $next;
        $this->em = $doctrine->getManager('account');  // TODO: config yaml the right manager to inject it automatically
    }
    
    public function dispatch(object $command): CommandResponse
    {
        $this->em->getConnection()->beginTransaction();
        try {
            $commandResponse = $this->next->dispatch($command);
            $this->em->flush();
            $this->em->getConnection()->commit();
        } catch(\Exception $error) {
            $this->em->getConnection()->rollback();
        }

        return $commandResponse;
    }
}