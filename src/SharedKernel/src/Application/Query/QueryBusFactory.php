<?php

namespace SharedKernel\Application\Query;

class QueryBusFactory
{
    static function build(iterable $handlers): QueryBusInterface
    {
        return new QueryBus($handlers);
    }
}