<?php

namespace SharedKernel\Application\Command;

interface CommandBusInterface {  
    function dispatch(CommandInterface $command): CommandResponse;
}