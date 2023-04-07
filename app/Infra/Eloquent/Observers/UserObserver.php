<?php

namespace App\Infra\Eloquent\Observers;

use App\Domain\User\User;

class UserObserver
{
    public function created(User $user): void
    {
        $user->profile()
            ->create();
    }
}
