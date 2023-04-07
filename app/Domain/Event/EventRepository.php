<?php

namespace App\Domain\Event;

use App\Domain\User\User;

interface EventRepository
{
    public function all(int $offset = 0, int $limit = 10, string $city = null);

    public function create(User $user, array $data): Event;

    public function update(Event $event, array $data): Event;

    public function delete(Event $event): bool;
}
