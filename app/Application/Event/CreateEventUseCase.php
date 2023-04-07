<?php

namespace App\Application\Event;

use App\Domain\Event\Event;
use App\Domain\Event\EventRepository;
use App\Infra\Exceptions\ImageUploadErrorException;
use Illuminate\Support\Facades\Storage;

class CreateEventUseCase
{
    public function __construct(
        private readonly EventRepository $eventRepository,
    )
    {
    }

    public function execute(array $data): Event|null
    {
        $loggedUser = auth()->user();

        try {
            $storagedImage = Storage::putFile('events/feature-images', $data['image']);

            if (!$storagedImage) {
                throw new ImageUploadErrorException(
                    'Image upload failed. Something wrong has happened.',
                    500
                );
            }
        } catch (ImageUploadErrorException $ex) {
            report($ex);
            return null;
        }

        $data['image_url'] = Storage::path($storagedImage);

        return $this->eventRepository->create($loggedUser, $data);
    }
}
