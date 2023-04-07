<?php

namespace App\Infra\Eloquent\Repositories;

use App\Domain\Profile\Profile;
use App\Domain\Profile\ProfileRepository;
use App\Domain\User\User;

class ProfileRepositoryImpl implements ProfileRepository
{
    public function create(User $user): Profile
    {
        return tap($user->profile())
            ->create()
            ->first();
    }

    public function update(User $user, array $data): Profile
    {
        return tap($user->profile())
            ->update($data)
            ->first();
    }
}
