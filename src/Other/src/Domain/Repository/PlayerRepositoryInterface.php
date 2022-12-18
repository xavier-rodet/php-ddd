<?php

namespace Other\Domain\Repository;

use Other\Domain\Aggregate\Player;
use SharedKernel\Domain\ValueObject\Uuid;

interface PlayerRepositoryInterface {
    function get(Uuid $id): Player;
    function add(Player $player): void;
    function update(Player $player): void;
    function delete(Uuid $id): void;
}