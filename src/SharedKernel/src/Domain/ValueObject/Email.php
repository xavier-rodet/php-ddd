<?php

namespace SharedKernel\Domain\ValueObject;

class Email
{
    public readonly string $value;

    public function __construct(string $email)
    {
        // TODO: email validation
        // if(!EmailValidator::validate($email)) {
        //     throw new \LogicException("This email is invalid: $email");
        // }

        $this->value = $email;
    }
}