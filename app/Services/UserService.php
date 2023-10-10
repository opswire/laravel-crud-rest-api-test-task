<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

use function Laravel\Prompts\select;

class UserService
{
    public const SUCCESS_DELETE_MESSAGE = 'User Deleted Successfully';
    public const NOT_FOUND_MESSAGE = 'User Not Found';

    public function getAllUsers(): Collection
    {
        return User::all();
    }

    public function getUserById(string $id): ?User
    {
        return User::find($id);
    }

    public function createUser(mixed $data): User
    {
        return User::create($data);
    }

    public function updateUser(mixed $data, string $id): ?User
    {
        $user = $this->getUserById($id);
        if(!$user) {
            return null;
        }

        $user->update($data);

        return $user;
    }

    public function deleteUser($id): string
    {
        $user = $this->getUserById($id);
        if(!$user) {
            return self::NOT_FOUND_MESSAGE;
        }

        $user->delete();
        return self::SUCCESS_DELETE_MESSAGE;
    }
}
