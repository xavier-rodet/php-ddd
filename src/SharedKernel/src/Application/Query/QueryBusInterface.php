<?php

namespace SharedKernel\Application\Query;

interface QueryBusInterface {  
    function dispatch(object $query): array;
}