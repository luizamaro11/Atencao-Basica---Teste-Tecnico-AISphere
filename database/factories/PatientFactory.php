<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * Factory responsável por gerar dados fictícios de Pacientes para testes.
 * Utiliza o locale pt_BR do Faker para gerar dados no formato brasileiro.
 *
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define os dados padrão para um paciente fictício.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Nome completo no formato brasileiro
            'name'          => fake('pt_BR')->name(),
            // E-mail único e seguro para testes
            'email'         => fake('pt_BR')->unique()->safeEmail(),
            // Número de celular no formato brasileiro (ex: (11) 98765-4321)
            'phone'         => fake('pt_BR')->cellphoneNumber(),
            // Data de nascimento entre 1 e 80 anos atrás
            'birth_date'    => fake('pt_BR')->dateTimeBetween('-80 years', '-1 years')->format('Y-m-d'),
            // Sem foto de perfil por padrão
            'profile_image' => null,
            // Associa automaticamente a um usuário criado pela UserFactory
            'created_by_id' => User::factory(),
        ];
    }
}
