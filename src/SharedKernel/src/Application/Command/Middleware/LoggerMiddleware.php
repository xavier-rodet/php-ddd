<?php

namespace SharedKernel\Application\Command\Middleware;

use SharedKernel\Application\Command\CommandBusInterface;
use SharedKernel\Application\Command\CommandResponse;
use Psr\Log\LoggerInterface;

class LoggerMiddleware implements CommandBusInterface
{    
    private CommandBusInterface $next;
    private LoggerInterface $logger;

    public function __construct(
        CommandBusInterface $next,
        LoggerInterface $logger
    ) {
        $this->next = $next;
        $this->logger = $logger;
    }
    
    public function dispatch(object $command): CommandResponse
    {
        $startTime = microtime(true);
        $response = $this->next->dispatch($command);
        $endTime = microtime(true);
        $elapsedTime = $endTime - $startTime;

        $message = 'Command '. get_class($command) . ' took: ' . $elapsedTime;
        $this->logger->info($message);

        return $response;
    }
}