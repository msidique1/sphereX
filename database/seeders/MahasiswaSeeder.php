<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Mahasiswa::factory(20)->create();
    }
}
