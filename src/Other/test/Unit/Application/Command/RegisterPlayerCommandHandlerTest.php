<?php

namespace Other\Test\Unit\Application\Command;

use Other\Domain\Aggregate\Player;
use Other\Domain\Event\PlayerRegisteredEvent;
use PHPUnit\Framework\TestCase;
use Other\Application\Command\RegisterPlayerCommand;
use Other\Application\Command\RegisterPlayerCommandHandler;
use Other\Domain\Repository\PlayerRepositoryInterface;

final class RegisterPlayerCommandHandlerTest extends TestCase
{
    /**
     * @dataProvider registerPlayerCommandProvider
     */
    public function testRegisterPlayerCommandHandler(RegisterPlayerCommand $command): void
    {
        $playerId = null;
        $playerRepository = $this->createMock(PlayerRepositoryInterface::class);
        $playerRepository->expects($this->once())
            ->method('add')
            ->with($this->callback(function (Player $player) use ($command, &$playerId) {
                $playerId = $player->id->value;
                return $player->nickname === $command->nickname
                    && $player->email->value === $command->email;
            }));

        $registerPlayerCommandHandler = new RegisterPlayerCommandHandler($playerRepository);
        $response = $registerPlayerCommandHandler->handle($command);

        $this->assertEquals($playerId, $response->id);
        $this->assertCount(1, $response->events);
        $this->assertEquals(new PlayerRegisteredEvent($command->email, $command->nickname), $response->events[0]);
    }

    public static function registerPlayerCommandProvider(): \Generator
    {
        $registerBobCommand = new RegisterPlayerCommand();
        $registerBobCommand->nickname = 'Bob';
        $registerBobCommand->email = 'bob@email.com';

        $registerAliceCommand = new RegisterPlayerCommand();
        $registerAliceCommand->nickname = 'Bob';
        $registerAliceCommand->email = 'bob@email.com';

        yield 'Register player Bob' => [$registerBobCommand];
        yield 'Register player Alice' => [$registerAliceCommand];
    }
}