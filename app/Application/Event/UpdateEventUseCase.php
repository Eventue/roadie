<?php

namespace App\Application\Event;

use App\Domain\Event\Event;
use App\Domain\Event\EventRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UpdateEventUseCase
{
    public function __construct(
        private readonly EventRepository $eventRepository,
    )
    {
    }

    public function execute(Event $event, array $data): Event
    {
        if (in_array('image', array_keys($data))) {
            $storagedImage = Storage::putFile('events/' . Str::uuid(), $data['image']);
            $data['image_url'] = Storage::path($storagedImage);
        }

        return $this->eventRepository->update($event, $data);
    }
}
