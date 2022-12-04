<?php

namespace Account\Infrastructure\Entity;

use Account\Infrastructure\Repository\PlayerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
class Player
{
    #[ORM\Id]
    // #[ORM\Column(type: "string", length: 36, unique: true, nullable: false)]
    #[ORM\Column(type: "uuid", unique: true)]
    // #[ORM\GeneratedValue(strategy: "CUSTOM")]
    // #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private Uuid $id;

    public function setId(Uuid $id): void
    {
        $this->id = $id;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }
}
