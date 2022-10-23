<?php

namespace SharedKernel\Application\Event;

interface EventBusInterface {  
    function dispatch(object $event): void;
}