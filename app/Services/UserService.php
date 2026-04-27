<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Camada de serviço responsável pelas regras de negócio relacionadas a Usuários.
 * Centraliza operações como registro, atualização de perfil e exclusão de conta.
 * Segue o Princípio da Responsabilidade Única (SOLID - letra S).
 */
class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Registra um novo usuário no sistema.
     * Aplica hash à senha antes de persistir.
     */
    public function registerUser(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        
        return $this->userRepository->create($data);
    }

    /**
     * Atualiza o perfil do usuário autenticado.
     * Trata o upload da foto de perfil e a invalidação do e-mail verificado, se alterado.
     */
    public function updateProfile(User $user, array $data): bool
    {
        if (isset($data['profile_image'])) {
            // Remove a foto de perfil antiga do storage antes de salvar a nova
            if ($user->profile_image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->profile_image);
            }
            $path = $data['profile_image']->store('users', 'public');
            $data['profile_image'] = $path;
        }

        $user->fill($data);

        // Se o e-mail foi alterado, exige nova verificação
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if (isset($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        // Envia apenas os campos modificados para o repositório persistir
        return $this->userRepository->update($user, $user->getDirty());
    }

    /**
     * Exclui permanentemente a conta do usuário.
     */
    public function deleteUser(User $user): bool
    {
        return $this->userRepository->delete($user);
    }
}
