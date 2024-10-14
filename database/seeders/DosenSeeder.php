<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Kelas;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $firstClass = Kelas::first(); 
        $secondClass = Kelas::skip(1)->first(); 

        Dosen::factory()->create([
            'kelas_id' => $firstClass->id,
        ]);

        Dosen::factory()->create([
            'kelas_id' => $secondClass->id,
        ]);
        
        Dosen::factory(3)->create();
    }
}
