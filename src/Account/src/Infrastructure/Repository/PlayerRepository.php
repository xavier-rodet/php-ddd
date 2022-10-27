<?php

namespace App\Repository\Infrastructure\Entity;

use Account\Domain\Aggregate\Player as AggregatePlayer;
use Account\Domain\Repository\PlayerRepositoryInterface;
use Account\Infrastructure\Entity\Player;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\Persistence\ManagerRegistry;
use SharedKernel\Domain\ValueObject\Uuid;

/**
 * @extends ServiceEntityRepository<Player>
 *
 * @method Player|null find($id, $lockMode = null, $lockVersion = null)
 * @method Player|null findOneBy(array $criteria, array $orderBy = null)
 * @method Player[]    findAll()
 * @method Player[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerRepository extends ServiceEntityRepository implements PlayerRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Player::class);
    }

    public function get(Uuid $id): AggregatePlayer
    {
        $doctrineEntity = $this->em
            ->getRepository(Player::class)
            ->find($id->value);

        if(!$doctrineEntity) {
            throw new EntityNotFoundException();
        }

        return AggregatePlayer::mapToDomain($doctrineEntity);
        

        // return new Player(
        //     id: $id, 
        //     email: new Email('fake@email.fr'),
        //     nickname:'fakename'
        // );
    }

    public function add(AggregatePlayer $player): void
    {
        $this->em
            ->merge(AggregatePlayer::mapFromDomain($player));
            // TODO: see how to do it (not compatible Doctrine 3)
    }

    public function update(AggregatePlayer $player): void
    {
        $this->em
            ->merge(AggregatePlayer::mapFromDomain($player));
            // TODO: see how to do it (not compatible Doctrine 3)
    }

    public function delete(Uuid $id): void
    {
        $doctrineEntity = $this->find($id->value);
        $this->remove($doctrineEntity);
    }

    public function save(Player $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Player $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
