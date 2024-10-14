<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Kaprodi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kaprodi>
 */
class KaprodiFactory extends Factory
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
            'name' => 'Prof. ' . fake()->name(),
            'kode_dosen' => fake()->unique()->numberBetween(100, 300),
            'user_id' => User::factory()->state([
                'role' => 'kaprodi',
            ]),
        ];
    }
}
