<?php

namespace Database\Factories;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        do {
            $kelas = Kelas::all()->random();
        } while ($kelas->isFull());

        do {
            $getUniqueNim = fake()->unique()->numberBetween(2100018000, 2100018900);
        } while (Mahasiswa::where('nim', $getUniqueNim)->exists());

        return [
            'name' => fake()->name(),
            'nim' => $getUniqueNim,
            'tempat_lahir' => fake()->city(),
            'tanggal_lahir' => fake()->date(),
            'edit' => false,
            'kelas_id' => $kelas->id,
            'user_id' => User::factory()->state([
                'role' => 'mahasiswa'
            ]),
        ];
    }
}
