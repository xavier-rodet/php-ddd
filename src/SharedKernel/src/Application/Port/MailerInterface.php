<?php

namespace SharedKernel\Application\Port;

interface MailerInterface {
    function setMessage(string $message): void;
    function sendTo(string $email): bool;
}