<?php

namespace Other\Domain\Aggregate;

use SharedKernel\Domain\ValueObject\Email;
use SharedKernel\Domain\ValueObject\Uuid;

class Player
{
    const DEFAULT_AVATAR_URL = '/img/default/avatar.jpg';
    
    public readonly Uuid $id;
    public readonly Email $email;
    public readonly string $nickname;
    public readonly int $credits;

    private ?string $avatarUrl;

    public function __construct(
        Email $email,
        string $nickname, 
        ?Uuid $id = new Uuid(), 
        ?string $avatarUrl = null,
        int $credits = 0
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->nickname = $nickname;
        $this->avatarUrl = $avatarUrl;
        $this->credits = $credits;
    }

    public function updateProfile(string $nickname, string $avatarUrl = null): void
    {
        $this->nickname = $nickname;
        $this->avatarUrl = $avatarUrl;
    }

    public function changeEmail(Email $email): void
    {
        $this->email = $email;
    }

    public function addCredits(int $credits)
    {
        $this->credits += $credits;
    }

    public function getAvatarUrl(): string
    {
        return $this->avatarUrl ?? self::DEFAULT_AVATAR_URL;
    }
}