<?php

namespace SharedKernel\Application\Command\Middleware;

use SharedKernel\Application\Event\EventBus;
use SharedKernel\Application\Command\CommandBusInterface;
use SharedKernel\Application\Command\CommandResponse;

class EventDispatcherMiddleware implements CommandBusInterface
{    
    private CommandBusInterface $next;
    private EventBus $eventBus;

    public function __construct(
        CommandBusInterface $next,
        EventBus $eventBus
    ) {
        $this->next = $next;
        $this->eventBus = $eventBus;
    }
    
    public function dispatch(object $command): CommandResponse
    {
        $commandResponse = $this->next->dispatch($command);

        if($commandResponse->hasEvents()) {
            foreach ($commandResponse->events as $event) {
                $this->eventBus->dispatch($event);
            }
        }

        return $commandResponse;
    }
}