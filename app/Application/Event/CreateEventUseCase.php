<?php

namespace App\Application\Event;

use App\Domain\Event\Event;
use App\Domain\Event\EventRepository;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CreateEventUseCase
{
    public function __construct(
        private readonly EventRepository $eventRepository,
    )
    {
    }

    public function execute(array $data): Event
    {
        $loggedUser = auth()->user();
        $storagedImage = Storage::putFile('events/' . Str::uuid(), $data['image']);

        if (!$storagedImage) {
            throw new Exception('Image upload failed. Something wrong has happened.', 500);
        }

        $data['image_url'] = Storage::path($storagedImage);

        return $this->eventRepository->create($loggedUser, $data);
    }
}
