<?php

namespace SharedKernel\Application\Command;

class CommandResponse
{
    public readonly string $id;
    public readonly array $events;

    public function __construct(string $id, object... $events)
    {
        $this->id = $id;
        $this->events = $events ?? [];
    }

    public function hasEvents(): bool
    {
        return count($this->events) > 0;
    }
}