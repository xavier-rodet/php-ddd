<?php

namespace SharedKernel\Application\Query;
use Doctrine\Persistence\ManagerRegistry;
use SharedKernel\Application\EntityManagerSelectorTrait;

abstract class AbstractQueryHandler implements QueryHandlerInterface {
    use EntityManagerSelectorTrait;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    abstract function handle(QueryInterface $query): array;
    abstract function listenTo(): string;
}