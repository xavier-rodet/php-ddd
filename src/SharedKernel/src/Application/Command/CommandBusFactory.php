<?php

namespace SharedKernel\Application\Command;

use Doctrine\Persistence\ManagerRegistry;
use SharedKernel\Application\Command\Middleware\DoctrineFlushMiddleware;
use SharedKernel\Application\Command\Middleware\ExceptionHandlerMiddleware;
use SharedKernel\Application\Command\Middleware\LoggerMiddleware;
use Psr\Log\LoggerInterface;

class CommandBusFactory
{
    static function build(iterable $handlers, LoggerInterface  $logger, ManagerRegistry $doctrine): CommandBusInterface
    {
        return new LoggerMiddleware(
            //TODO: add EventDispatcherMiddleware
            new DoctrineFlushMiddleware(
                new CommandBus($handlers),
                $doctrine
            ),
            $logger
        );
    }
}