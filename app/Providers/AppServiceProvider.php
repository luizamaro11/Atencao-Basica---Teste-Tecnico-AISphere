<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Registra os bindings do contêiner de dependências (IoC).
     * Mapeia as interfaces para suas implementações concretas (Inversão de Dependência - SOLID).
     */
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

    /**
     * Executado após o registro de todos os serviços. Ponto de inicialização da aplicação.
     *
     * Define a política global de senha da aplicação via Password::defaults().
     * Todos os controllers que usam Rules\Password::defaults() herdam essas regras
     * automaticamente, sem necessidade de alteração individual.
     */
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
