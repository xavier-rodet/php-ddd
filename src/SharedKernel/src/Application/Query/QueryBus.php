<?php

namespace SharedKernel\Application\Query;

class QueryBus implements QueryBusInterface
{    
    private array $handlers = [];

    /**
     * __construct
     *
     * @param  QueryHandlerInterface[] $handlers
     * @return void
     */
    public function __construct(iterable $handlers)
    {
        foreach ($handlers as $handler) {
            $this->handlers[$handler->listenTo()] = $handler;
        }
    }

    public function dispatch(QueryInterface $query): array
    {
        $queryClass = get_class($query);
        $handler = $this->handlers[$queryClass];
        if($handler === null) {
            throw new \ErrorException("Handler for query $queryClass not found");
        }
        return $handler->handle($query);
    }
}