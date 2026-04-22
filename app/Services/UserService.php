<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function registerUser(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        
        return $this->userRepository->create($data);
    }

    public function updateProfile(User $user, array $data): bool
    {
        if (isset($data['profile_image'])) {
            if ($user->profile_image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->profile_image);
            }
            $path = $data['profile_image']->store('users', 'public');
            $data['profile_image'] = $path;
        }

        $user->fill($data);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if (isset($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        // Passa os atributos sujos para o repositório salvar
        return $this->userRepository->update($user, $user->getDirty());
    }

    public function deleteUser(User $user): bool
    {
        return $this->userRepository->delete($user);
    }
}
