<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    /** Persiste um novo usuário no banco de dados. */
    public function create(array $data): User
    {
        return User::create($data);
    }

    /** Atualiza os campos de um usuário existente. */
    public function update(User $user, array $data): bool
    {
        return $user->update($data);
    }

    /** Remove um usuário do banco de dados. */
    public function delete(User $user): bool
    {
        return $user->delete();
    }
}
