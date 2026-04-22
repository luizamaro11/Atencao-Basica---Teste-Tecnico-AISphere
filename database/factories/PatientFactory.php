<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake('pt_BR')->name(),
            'email' => fake('pt_BR')->unique()->safeEmail(),
            'phone' => fake('pt_BR')->cellphoneNumber(),
            'birth_date' => fake('pt_BR')->dateTimeBetween('-80 years', '-1 years')->format('Y-m-d'),
            'profile_image' => null,
            'created_by_id' => User::factory(),
        ];
    }
}
