<?php

namespace Database\Seeders;

use App\Models\TipoInmueble;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoInmueblesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoInmueble::insert([
            ['nombre' => 'Casa', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Apartamento', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Finca', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Local comercial', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Lote', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
