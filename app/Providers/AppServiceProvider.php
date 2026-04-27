<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
     */
    public function boot(): void
    {
        //
    }
}
