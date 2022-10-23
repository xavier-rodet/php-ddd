<?php

namespace PhpExtension;

use Symfony\Component\Uid\Uuid as SymfonyUuid;

class UuidGenerator
{
    public static function generate(): string
    {
        return SymfonyUuid::v4();
    }

    public static function validate(string $id): bool
    {
         return SymfonyUuid::isValid($id);
    }
}