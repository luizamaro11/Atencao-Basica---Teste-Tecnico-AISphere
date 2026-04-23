<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(
            \App\Interfaces\UserRepositoryInterface::class,
            \App\Repositories\UserRepository::class
        );
        $this->app->bind(
            \App\Interfaces\PatientRepositoryInterface::class,
            \App\Repositories\PatientRepository::class
        );
    }

    public function boot(): void
    {
        Password::defaults(function () {
            return Password::min(8)
                ->max(64)
                ->mixedCase()   // letras maiúsculas e minúsculas
                ->numbers()     // pelo menos 1 número
                ->symbols();    // pelo menos 1 caractere especial (!@#$...)
        });
    }
}
