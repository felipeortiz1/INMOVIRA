<?php

namespace Database\Seeders;

use App\Models\Barrio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarriosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Barrio::insert([
            ['nombre' => 'Centro', 'idMunicipio' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'San Antonio', 'idMunicipio' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Libertador', 'idMunicipio' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'El Bosque', 'idMunicipio' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'La Candelaria', 'idMunicipio' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
