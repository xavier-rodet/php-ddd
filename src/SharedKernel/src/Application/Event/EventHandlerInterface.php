<?php

namespace SharedKernel\Application\Event;

use SharedKernel\Domain\Event;

interface EventHandlerInterface {
    function handle(object $event): void;
    function listenTo(): string;
}