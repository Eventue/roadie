<?php

namespace App\Application\User;

use App\Domain\User\User;
use App\Domain\User\UserRepository;

class DeleteUserUseCase
{
    public function __construct(
        private readonly UserRepository $userRepository
    )
    {
    }

    public function execute(User $user): bool
    {
        return $this->userRepository->delete($user);
    }
}
