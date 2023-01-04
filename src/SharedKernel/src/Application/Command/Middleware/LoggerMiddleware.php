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
        $startTime = $this->getMilliseconds();
        $response = $this->next->dispatch($command);
        $endTime = $this->getMilliseconds();
        $elapsedTime = $endTime - $startTime;

        $this->logger->info(sprintf('Command %s took: %s ms', get_class($command), $elapsedTime));

        return $response;
    }

    private function getMilliseconds(): int
    {
        $mt = explode(' ', microtime());
        return intval( $mt[1] * 1E3 ) + intval( round( $mt[0] * 1E3 ) );
    }
}