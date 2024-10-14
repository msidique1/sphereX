<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kelas::firstOrCreate(['name' => 'Sistem Cerdas'], ['jumlah' => 10]);
        Kelas::firstOrCreate(['name' => 'Relata'], ['jumlah' => 10]);
    }
}
