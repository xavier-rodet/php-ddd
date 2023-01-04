<?php

namespace Account\Application\Query;

use SharedKernel\Application\Query\AbstractQueryHandler;
use SharedKernel\Application\Query\QueryInterface;

class ListPlayersQueryHandler extends AbstractQueryHandler
{
    /**
     * Summary of handle
     * @param ListPlayersQuery $query
     * @return array
     */
    public function handle(QueryInterface $query): array
    {
        return $this->getDomainEntityManager($this)
            ->createQuery("SELECT 
                p.id, 
                p.email, 
                p.nickname, 
                p.avatarUrl, 
                p.credits 
            FROM Account:Player p")
            ->getArrayResult();
    }

    public function listenTo(): string
    {
        return ListPlayersQuery::class;
    }
}