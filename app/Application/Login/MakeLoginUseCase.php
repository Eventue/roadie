<?php

namespace App\Application\Login;

use App\Domain\User\UserRepository;
use Illuminate\Support\Facades\Hash;

class MakeLoginUseCase
{
    public function __construct(
        private readonly UserRepository $userRepository
    )
    {
    }

    public function execute(string $email, string $password): string|null
    {
        $user = $this->userRepository->findByEmail($email);

        if (!Hash::check($password, $user->getAuthPassword())) {
            return null;
        }

        return $this->userRepository->createToken($user);
    }
}
