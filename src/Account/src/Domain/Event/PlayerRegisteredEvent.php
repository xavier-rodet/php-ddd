<?php

namespace Account\Domain\Event;

class PlayerRegisteredEvent
{
    public readonly string $email;
    public readonly string $nickname;

    public function __construct(string $email, string $nickname)
    {
        $this->email = $email;
        $this->nickname = $nickname;
    }
}