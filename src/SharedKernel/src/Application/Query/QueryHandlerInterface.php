<?php

namespace SharedKernel\Application\Query;

interface QueryHandlerInterface {
    function handler(object $query): void; // ViewModel?
}