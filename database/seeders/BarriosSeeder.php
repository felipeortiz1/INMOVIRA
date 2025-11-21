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
            ['nombre' => 'Santa Helena', 'idMunicipio' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Villa María', 'idMunicipio' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'El Prado', 'idMunicipio' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Palermo', 'idMunicipio' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'San Martín', 'idMunicipio' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Altamira', 'idMunicipio' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Nueva Esperanza', 'idMunicipio' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Valle Verde', 'idMunicipio' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Los Pinos', 'idMunicipio' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Santa Rosa', 'idMunicipio' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'La Floresta', 'idMunicipio' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Los Laureles', 'idMunicipio' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Brisas del Norte', 'idMunicipio' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Villa del Sol', 'idMunicipio' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'San Miguel', 'idMunicipio' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
