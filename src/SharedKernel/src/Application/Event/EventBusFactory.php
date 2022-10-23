<?php

namespace SharedKernel\Application\Event;

use SharedKernel\Application\Event\EventBus;
use SharedKernel\Application\Event\EventBusInterface;

class EventBusFactory
{
    static function build(iterable $events): EventBusInterface
    {
        return new EventBus($events);
    }
}