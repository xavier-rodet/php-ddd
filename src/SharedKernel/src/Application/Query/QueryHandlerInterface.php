<?php

namespace SharedKernel\Application\Query;

interface QueryHandlerInterface {
    function handle(QueryInterface $query): array;
    function listenTo(): string;
}