<?php

namespace Account\Infrastructure\Repository;

use Account\Domain\Aggregate\Player;
use Account\Domain\Repository\PlayerRepositoryInterface;
use SharedKernel\Domain\ValueObject\Email;
use SharedKernel\Domain\ValueObject\Uuid;

class PlayerRepository implements PlayerRepositoryInterface
{
    public function get(Uuid $id): Player
    {
        return new Player(
            id: $id, 
            email: new Email('fake@email.fr'),
            nickname:'fakename'
        );
    }

    public function add(Player $player): void
    {
        return;
    }

    public function delete(Uuid $id): void
    {
        return;
    }
}