<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\UserRepositoryInterface;

/**
 * Eloquent implementation of User Repository.
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * Get all users.
     */
    public function getAll(): Collection
    {
        return User::all();
    }

    /**
     * Find a user by their ID.
     */
    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * Create a new user.
     */
    public function create(array $data): User
    {
        return User::create($data);
    }

    /**
     * Update an existing user.
     */
    public function update(User $user, array $data): User
    {
        $user->update($data);
        return $user;
    }

    /**
     * Delete a user.
     */
    public function delete(User $user): bool
    {
        return $user->delete();
    }
}