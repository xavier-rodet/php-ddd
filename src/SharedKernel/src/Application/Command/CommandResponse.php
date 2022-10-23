<?php

namespace SharedKernel\Application\Command;

class CommandResponse
{
    public readonly mixed $value;
    public readonly array $events;

    public function __construct(mixed $value, object... $events)
    {
        $this->value = $value;
        $this->events = $events ?? [];
    }

    public function hasEvents(): bool
    {
        return count($this->events) > 0;
    }
}