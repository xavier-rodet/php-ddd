<?php

namespace SharedKernel\Application\Command;

interface CommandBusInterface {  
    function dispatch(object $command): CommandResponse;
}