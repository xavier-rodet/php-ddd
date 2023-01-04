<?php

namespace SharedKernel\Application\Query;

interface QueryBusInterface {  
    function dispatch(QueryInterface $query): array;
}