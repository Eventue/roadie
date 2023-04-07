<?php

namespace App\Application\Event;

use App\Domain\Event\Event;
use Illuminate\Support\Facades\Storage;

class GetOneEventUseCase
{
    public function execute(Event $event): array
    {
        $toArray = $event->load(
            'user',
            'photos'
        )->toArray();

        $toArray['image_url'] = Storage::temporaryUrl(
            $toArray['image_url'],
            now()->addMinutes(5)
        );

        return $toArray;
    }
}
