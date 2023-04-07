<?php

namespace App\Application\User;

use App\Domain\User\UserRepository;
use Illuminate\Database\Eloquent\Collection;

class GetAllUsersUseCase
{
    public function __construct(
        private readonly UserRepository $userRepository
    )
    {
    }

    public function execute(int $offset = 0, int $limit = 10): Collection
    {
        return $this->userRepository->all($offset, $limit);
    }
}
