<?php

namespace SharedKernel\Domain\ValueObject;

use PhpExtension\UuidGenerator;

class Uuid
{
    public readonly string $value;
    
    public function __construct(?string $id = null)
    {
        if(!$id) {
             $id = UuidGenerator::generate();
        }

        if(!UuidGenerator::validate($id)) {
            throw new \LogicException("This UUID is invalid: $id");
        }

        $this->value = $id;
    }
}