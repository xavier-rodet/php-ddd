<?php

namespace Account\Application\Command;
use SharedKernel\Application\Command\CommandInterface;

class RegisterPlayerCommand implements CommandInterface
{
    public string $email;
    public string $nickname;
    public ?string $avatarUrl = null;
}