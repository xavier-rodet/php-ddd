<?php

namespace SharedKernel\Application\Command;

use Doctrine\Persistence\ManagerRegistry;
use SharedKernel\Application\Command\Middleware\DoctrineFlushMiddleware;
use SharedKernel\Application\Command\Middleware\LoggerMiddleware;
use Psr\Log\LoggerInterface;

class CommandBusFactory
{
    static function build(iterable $handlers, LoggerInterface  $logger, ManagerRegistry $doctrine): CommandBusInterface
    {
        //TODO: add EventDispatcherMiddleware
        return new DoctrineFlushMiddleware(
            new LoggerMiddleware(
                new CommandBus($handlers),
                $logger
            ),
            $doctrine
        );
    }
}