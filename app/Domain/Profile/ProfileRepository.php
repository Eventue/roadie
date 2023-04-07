<?php

namespace App\Domain\Profile;

use App\Domain\User\User;

interface ProfileRepository
{
    public function create(User $user);

    public function update(User $user, array $data): Profile;
}
