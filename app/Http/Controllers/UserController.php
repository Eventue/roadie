<?php

namespace App\Http\Controllers;

use App\Application\User\CreateUserUseCase;
use App\Application\User\DeleteUserUseCase;
use App\Application\User\GetAllUsersUseCase;
use App\Application\User\UpdateUserUseCase;
use App\Domain\User\User;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct(
        private readonly GetAllUsersUseCase $getAllUsers,
        private readonly CreateUserUseCase  $createUser,
        private readonly UpdateUserUseCase  $updateUser,
        private readonly DeleteUserUseCase  $deleteUser
    )
    {
    }

    public function all(Request $request): JsonResponse
    {
        $offset = $request->get('offset', 0);
        $limit = $request->get('limit', 10);

        return response()->json(
            $this->getAllUsers->execute($offset, $limit),
            Response::HTTP_OK
        );
    }

    public function one(User $user): JsonResponse
    {
        return response()->json(
            $user,
            Response::HTTP_OK
        );
    }

    public function create(CreateUserRequest $request): JsonResponse
    {
        return response()->json(
            $this->createUser->execute($request->validated()),
            Response::HTTP_CREATED
        );
    }

    public function update(User $user, UpdateUserRequest $request): JsonResponse
    {
        return response()->json(
            $this->updateUser->execute($user, $request->validated()),
            Response::HTTP_OK
        );
    }

    public function delete(User $user): JsonResponse
    {
        $isDeleted = $this->deleteUser->execute($user);

        return response()->json(
            ['status' => $isDeleted],
            $isDeleted
                ? Response::HTTP_ACCEPTED
                : Response::HTTP_EXPECTATION_FAILED
        );
    }

    public function me()
    {
        return response()->json(
            auth()->user(),
            Response::HTTP_OK
        );
    }
}
