<?php

namespace Account\Application\EventHandler;

use Account\Domain\Event\PlayerRegisteredEvent;
use SharedKernel\Application\Event\EventHandlerInterface;
use SharedKernel\Application\Port\MailerInterface;

class PlayerRegisteredEventHandler implements EventHandlerInterface
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;    
    }
    
    /**
     * handle
     *
     * @param  PlayerRegisteredEvent $event
     * @return void
     */
    public function handle(object $event): void
    {
        $message = "Welcome $event->nickname !";
        $this->mailer->setMessage($message);
        $this->mailer->sendTo($event->email);
    }

    public function listenTo(): string
    {
        return PlayerRegisteredEvent::class;
    }
}