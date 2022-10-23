<?php

namespace Account\Application\Command;

class RegisterPlayerCommand
{
    public string $email;
    public string $nickname;
    public ?string $avatarUrl = null;
}