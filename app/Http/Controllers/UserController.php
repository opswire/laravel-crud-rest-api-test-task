<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): JsonResponse
    {
        $users = $this->userService->getAllUsers();

        return response()->json($users);
    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        $user = $this->userService->createUser($request->validated());

        return response()->json($user, Response::HTTP_CREATED);
    }

    public function show(string $id): JsonResponse
    {
        $user = $this->userService->getUserById($id);

        return $this->handleUserNotFound($user);
    }

    public function update(UpdateUserRequest $request, string $id): JsonResponse
    {
        $user = $this->userService->updateUser($request->validated(), $id);

        return $this->handleUserNotFound($user);
    }

    public function destroy(string $id): JsonResponse
    {
        $message = $this->userService->deleteUser($id);

        return response()->json(['message' => $message]);
    }

    private function handleUserNotFound($user): JsonResponse
    {
        if (!$user) {
            return response()->json(['message' => UserService::NOT_FOUND_MESSAGE], Response::HTTP_NOT_FOUND);
        }

        return response()->json($user);
    }
}
