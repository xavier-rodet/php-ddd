<?php

namespace Account\Application\Command;

use Account\Domain\Aggregate\Player;
use Account\Domain\Event\PlayerRegisteredEvent;
use Account\Domain\Repository\PlayerRepositoryInterface;
use SharedKernel\Application\Command\CommandErrorResponse;
use SharedKernel\Application\Command\CommandHandlerInterface;
use SharedKernel\Application\Command\CommandInterface;
use SharedKernel\Application\Command\CommandResponse;
use SharedKernel\Application\Command\CommandSuccessResponse;
use SharedKernel\Domain\ValueObject\Email;

class RegisterPlayerCommandHandler implements CommandHandlerInterface
{
    private PlayerRepositoryInterface $playerRepository;

    public function __construct(PlayerRepositoryInterface $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }
    
    /**
     * handle
     *
     * @param  RegisterPlayerCommand $command
     * @return CommandResponse
     */
    public function handle(CommandInterface $command): CommandResponse
    {
        $player = new Player(
            email: new Email($command->email),
            nickname: $command->nickname,
            avatarUrl: $command->avatarUrl
        );

        $this->playerRepository->add($player);

        return new CommandResponse(
            $player->id->value,
            new PlayerRegisteredEvent($player->email->value, $player->nickname)
        );
    }

    public function listenTo(): string
    {
        return RegisterPlayerCommand::class;
    }
}