<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Patient;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Popula o banco de dados com dados iniciais para testes e demonstração.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role' => 'ADMIN',
        ]);

        Patient::factory(5)->create([
            'created_by_id' => $admin->id,
        ]);
    }
}
