<?php

namespace App\Domain\User;

use Illuminate\Database\Eloquent\Collection;

interface UserRepository
{
    public function all(int $offset = 0, int $limit = 10): Collection;

    public function create(array $data): User;

    public function update(User $user, array $data): User;

    public function delete(User $user): bool;

    public function findByEmail(string $email): User;

    public function createToken(User $user): string;
}
