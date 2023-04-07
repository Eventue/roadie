<?php

namespace App\Infra\Eloquent\Repositories;

use App\Domain\Event\Event;
use App\Domain\Event\EventRepository;
use App\Domain\User\User;

class EventRepositoryImpl implements EventRepository
{

    public function all(int $offset = 0, int $limit = 10, string $city = null)
    {
        return Event::query()
            ->when(
                $city,
                fn($query, $city) => $query->where('location', 'LIKE', "%$city%")
            )
            ->offset($offset)
            ->limit($limit)
            ->get();
    }

    public function create(User $user, array $data): Event
    {
        $payload = ['user_id' => $user->id, ...$data];

        return Event::create($payload);
    }

    public function update(Event $event, array $data): Event
    {
        $event->update($data);

        return $event->fresh();
    }

    public function delete(Event $event): bool
    {
        return (bool)$event->delete();
    }
}
