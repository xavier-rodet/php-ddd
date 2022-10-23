<?php

namespace SharedKernel\Application\Command;

class CommandBus implements CommandBusInterface
{    
    private array $handlers = [];

    /**
     * __construct
     *
     * @param  CommandHandlerInterface[] $handlers
     * @return void
     */
    public function __construct(iterable $handlers)
    {
        foreach ($handlers as $handler) {
            $this->handlers[$handler->listenTo()] = $handler;
        }
    }

    public function dispatch(object $command): CommandResponse
    {
        $commandClass = get_class($command);
        $handler = $this->handlers[$commandClass];
        if($handler === null) {
            throw new \ErrorException("Handler for command $commandClass not found");
        }
        return $handler->handle($command);
    }
}