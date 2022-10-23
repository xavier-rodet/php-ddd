<?php

namespace SharedKernel\Application\Command;

interface CommandHandlerInterface {
    function handle(object $command): CommandResponse;
    function listenTo(): string;
}