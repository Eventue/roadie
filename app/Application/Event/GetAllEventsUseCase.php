<?php

namespace App\Application\Event;

use App\Domain\Event\EventRepository;
use Illuminate\Database\Eloquent\Collection;

class GetAllEventsUseCase
{
    public function __construct(
        private readonly EventRepository $eventRepository,
    )
    {
    }

    public function execute(int $offset = 0, int $limit = 10, string $city = null): Collection
    {
        return $this->eventRepository->all($offset, $limit, $city);
    }
}
