<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Kelas;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dosen>
 */
class DosenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'nip' => fake()->unique()->numberBetween(18100000, 19000000),
            'kode_dosen' => fake()->unique()->numberBetween(301, 400),
            'name' => 'Dr. ' . fake()->name(),
            'kelas_id' => null,
            'user_id' => User::factory()->state([
                'role' => 'dosen'
            ]),
        ];
    }
}