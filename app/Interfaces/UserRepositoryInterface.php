<?php

namespace App\Interfaces;

use App\Models\User;

/**
 * Contrato que define as operações de acesso ao banco de dados para Usuários.
 * Garante a Inversão de Dependência (SOLID - letra D).
 */
interface UserRepositoryInterface
{
    /** Cria e persiste um novo usuário no banco de dados. */
    public function create(array $data): User;

    /** Atualiza os dados de um usuário existente. */
    public function update(User $user, array $data): bool;

    /** Remove um usuário do banco de dados. */
    public function delete(User $user): bool;
}
