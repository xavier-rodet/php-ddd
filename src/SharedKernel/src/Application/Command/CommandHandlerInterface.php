<?php

namespace SharedKernel\Application\Command;

interface CommandHandlerInterface {
    function handle(CommandInterface $command): CommandResponse;
    function listenTo(): string;
}