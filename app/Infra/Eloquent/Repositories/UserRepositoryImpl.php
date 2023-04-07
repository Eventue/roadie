<?php

namespace App\Infra\Eloquent\Repositories;

use App\Domain\User\User;
use App\Domain\User\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserRepositoryImpl implements UserRepository
{
    public function all(int $offset = 0, int $limit = 10): Collection
    {
        return User::query()
            ->offset($offset)
            ->limit($limit)
            ->get();
    }

    public function create(array $data): User
    {
        $data['password'] = Hash::make($data['password']);

        return User::create($data);
    }

    public function update(User $user, array $data): User
    {
        if ($data['newPassword']) {
            $data['password'] = Hash::make($data['newPassword']);

            unset($data['newPassword'], $data['newPasswordConfirmation']);
        }

        return tap($user)
            ->update($data)
            ->first();
    }

    public function findByEmail(string $email): User
    {
        return User::where('email', $email)->first();
    }

    public function createToken(User $user): string
    {
        $user->tokens()->delete();

        return $user->createToken('authToken')->plainTextToken;
    }

    public function delete(User $user): bool
    {
        return (bool)$user->delete();
    }
}
