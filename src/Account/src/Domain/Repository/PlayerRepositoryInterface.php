<?php

namespace Account\Domain\Repository;

use Account\Domain\Aggregate\Player;
use SharedKernel\Domain\ValueObject\Uuid;

interface PlayerRepositoryInterface {
    function get(Uuid $id): Player;
    function add(Player $player): void;
    function delete(Uuid $id): void;
}