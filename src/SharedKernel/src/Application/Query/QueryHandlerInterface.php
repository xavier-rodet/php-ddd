<?php

namespace SharedKernel\Application\Query;

interface QueryHandlerInterface {
    function handle(object $query): array;
    function listenTo(): string;
}