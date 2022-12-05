<?php

namespace Account\Infrastructure\Repository;

use Account\Domain\Aggregate\Player as AggregatePlayer;
use Account\Domain\Repository\PlayerRepositoryInterface;
use Account\Infrastructure\Entity\Player;
use Account\Infrastructure\Mapper\PlayerMapper;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\Persistence\ManagerRegistry;
use SharedKernel\Domain\ValueObject\Uuid;

class PlayerRepository extends ServiceEntityRepository implements PlayerRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Player::class);
    }

    public function get(Uuid $id): AggregatePlayer
    {
        $doctrineEntity = $this->find($id->value);
        if(!$doctrineEntity) {
            throw new EntityNotFoundException();
        }

        return PlayerMapper::mapToDomain($doctrineEntity);
    }

    public function add(AggregatePlayer $player): void
    {
        $doctrineEntity = PlayerMapper::mapFromDomain($player);
        $this->getEntityManager()->persist($doctrineEntity);
    }

    public function update(AggregatePlayer $player): void
    {
        $doctrineEntity = $this->find($player->id->value);
        if(!$doctrineEntity) {
            throw new EntityNotFoundException();
        }

        $doctrineEntity = PlayerMapper::mapFromDomain($player, $doctrineEntity);
        $this->getEntityManager()->remove($doctrineEntity);
    }

    public function delete(Uuid $id): void
    {
        $doctrineEntity = $this->find($id->value);

        if(!$doctrineEntity) {
            throw new EntityNotFoundException();
        }

        $this->getEntityManager()->remove($doctrineEntity);
    }
}
