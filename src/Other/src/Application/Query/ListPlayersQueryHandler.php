<?php

namespace Other\Application\Query;

use SharedKernel\Application\Query\AbstractQueryHandler;

class ListPlayersQueryHandler extends AbstractQueryHandler
{
    public function handle(object $query): array
    {
        return $this->getDomainEntityManager($this)
            ->createQuery("SELECT 
                p.id, 
                p.email, 
                p.nickname, 
                p.avatarUrl, 
                p.credits 
            FROM Other:Player p")
            ->getArrayResult();
    }

    public function listenTo(): string
    {
        return ListPlayersQuery::class;
    }
}