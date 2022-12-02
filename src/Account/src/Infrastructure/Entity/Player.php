<?php

namespace Account\Infrastructure\Entity;

use Account\Infrastructure\Repository\PlayerRepository;
use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity(repositoryClass: PlayerRepository::class)]
class Player
{
    // #[ORM\Id]
    // #[ORM\GeneratedValue]
    // #[ORM\Column]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "custom")]
    #[ORM\Column(type: "string", length: 36, unique: true, nullable: false)]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private string $id;

    public function setId(): string
    {
        return $this->id;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
