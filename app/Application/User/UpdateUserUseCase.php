<?php

namespace App\Application\User;

use App\Domain\User\User;
use App\Domain\User\UserRepository;

class UpdateUserUseCase
{
    public function __construct(
        private readonly UserRepository $userRepository
    )
    {
    }

    public function execute(User $user, array $data): User
    {
        return $this->userRepository->update($user, $data);
    }
}
