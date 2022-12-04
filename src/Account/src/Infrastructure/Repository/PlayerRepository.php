<?php

namespace Account\Infrastructure\Repository;

use Account\Domain\Aggregate\Player as AggregatePlayer;
use Account\Domain\Repository\PlayerRepositoryInterface;
use Account\Infrastructure\Entity\Player;
use Account\Infrastructure\Mapper\PlayerMapper;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityNotFoundException;
// use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use SharedKernel\Domain\ValueObject\Uuid;

class PlayerRepository extends ServiceEntityRepository implements PlayerRepositoryInterface
// class PlayerRepository extends EntityRepository implements PlayerRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Player::class);
        // parent::__construct($registry->getManager('account'), Player::class);
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
        dd('new doctrine entity', $doctrineEntity);
        $this->getEntityManager()->persist($doctrineEntity);
        // $this->getEntityManager()->flush();
    }

    public function update(AggregatePlayer $player): void
    {
        $doctrineEntity = $this->find($player->id->value);
        if(!$doctrineEntity) {
            throw new EntityNotFoundException();
        }

        $doctrineEntity = PlayerMapper::mapFromDomain($player, $doctrineEntity);
        $this->getEntityManager()->remove($doctrineEntity);
        // $this->getEntityManager()->flush();
    }

    public function delete(Uuid $id): void
    {
        $doctrineEntity = $this->find($id->value);

        if(!$doctrineEntity) {
            throw new EntityNotFoundException();
        }

        $this->getEntityManager()->remove($doctrineEntity);
        // $this->getEntityManager()->flush();
    }
}
