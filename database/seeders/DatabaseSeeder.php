<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $this->call([
                KelasSeeder::class,
                UserSeeder::class,
                MahasiswaSeeder::class,
                DosenSeeder::class,
                KaprodiSeeder::class,
            ]);
        });
    }
}
