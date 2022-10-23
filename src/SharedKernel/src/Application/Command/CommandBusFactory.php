<?php

namespace SharedKernel\Application\Command;

use SharedKernel\Application\Command\Middleware\LoggerMiddleware;
use Psr\Log\LoggerInterface;

class CommandBusFactory
{
    static function build(iterable $handlers, LoggerInterface  $logger): CommandBusInterface
    {
        return new LoggerMiddleware(new CommandBus($handlers), $logger);
    }
}