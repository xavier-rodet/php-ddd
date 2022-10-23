<?php

namespace SharedKernel\Infrastructure;

use SharedKernel\Application\Port\MailerInterface;

class Mailer implements MailerInterface {
    public function setMessage(string $message): void
    {
        throw new \Exception("method not implemented");
    }

    public function sendTo(string $email): bool
    {
        return false;
    }
}