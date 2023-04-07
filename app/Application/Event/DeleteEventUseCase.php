<?php

namespace App\Application\Event;

use App\Domain\Event\Event;
use App\Domain\Event\EventRepository;

class DeleteEventUseCase
{
    public function __construct(
        private readonly EventRepository $eventRepository,
    )
    {
    }

    public function execute(Event $event): bool
    {
        return $this->eventRepository->delete($event);
    }
}
