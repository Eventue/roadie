<?php

namespace App\Application\User;

use App\Domain\User\User;
use App\Domain\User\UserRepository;

class CreateUserUseCase
{
    public function __construct(
        private readonly UserRepository $userRepository
    )
    {
    }

    public function execute(array $data): User
    {
        return $this->userRepository->create($data);
    }
}
