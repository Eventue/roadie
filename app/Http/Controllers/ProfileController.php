<?php

namespace App\Http\Controllers;

use App\Application\Profile\UpdateProfileUseCase;
use App\Domain\User\User;
use App\Http\Requests\Profile\UpdateProfileRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    public function __construct(
        private readonly UpdateProfileUseCase $updateUseCase,
    )
    {
    }

    public function one(User $user): JsonResponse
    {
        return response()->json(
            $user->profile,
            Response::HTTP_OK,
        );
    }

    public function update(User $user, UpdateProfileRequest $request): JsonResponse
    {
        return response()->json(
            $this->updateUseCase->execute($user, $request->validated()),
            Response::HTTP_OK,
        );
    }
}
