<?php

namespace App\Application\Profile;

use App\Domain\Profile\Profile;
use App\Domain\Profile\ProfileRepository;
use App\Domain\User\User;

class UpdateProfileUseCase
{
    public function __construct(
        private readonly ProfileRepository $profileRepository,
    )
    {
    }

    public function execute(User $user, array $data): Profile
    {
        return $this->profileRepository->update($user, $data);
    }
}
