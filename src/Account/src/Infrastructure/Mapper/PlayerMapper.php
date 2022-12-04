<?php

namespace Account\Infrastructure\Mapper;

use Account\Domain\Aggregate\Player as DomainPlayer;
use Account\Infrastructure\Entity\Player as DoctrinePlayer;
use SharedKernel\Domain\ValueObject\Email;
use SharedKernel\Domain\ValueObject\Uuid;

class PlayerMapper
{
    public static function mapToDomain(DoctrinePlayer $doctrineEntity): DomainPlayer
    {
        $domainPlayer = new DomainPlayer(
            new Email($doctrineEntity->getEmail()),
            $doctrineEntity->getNickname(),
            new Uuid($doctrineEntity->getId()),
            $doctrineEntity->getAvatarUrl(),
            $doctrineEntity->getCredits()
        );

        return $domainPlayer;
    }

    public static function mapFromDomain(DomainPlayer $domainEntity, ?DoctrinePlayer $doctrineEntity = null): DoctrinePlayer
    {
        $doctrineEntity = $doctrineEntity ?? new DoctrinePlayer();

        $doctrineEntity->setId($domainEntity->id->value);
        $doctrineEntity->setEmail($domainEntity->email->value);
        $doctrineEntity->setNickname($domainEntity->nickname);
        $avatarUrl = $domainEntity->getAvatarUrl() !== DomainPlayer::DEFAULT_AVATAR_URL ? $domainEntity->getAvatarUrl() : null;
        $doctrineEntity->setAvatarUrl($avatarUrl); 
        $doctrineEntity->setCredits($domainEntity->credits);

        return $doctrineEntity;
    }
}