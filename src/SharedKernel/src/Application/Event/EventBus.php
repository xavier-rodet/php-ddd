<?php

namespace SharedKernel\Application\Event;

class EventBus implements EventBusInterface
{
    private array $handlers;

    public function __construct(iterable $handlers)
    {
        foreach($handlers as $handler) {
            $this->handlers[] = $handler;
        }
    }

    public function dispatch(object $event): void
    {
        $eventClass = get_class($event);
        $matchingHandlers = array_filter($this->handlers, 
            function($handler) use ($eventClass) {
                return $handler->listenTo() === $eventClass;
            });

        foreach($matchingHandlers as $handler) {
            $handler->handle($event);
        }
    }
}