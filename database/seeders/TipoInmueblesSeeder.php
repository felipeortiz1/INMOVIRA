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
            ['nombre' => 'Oficina', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Bodega', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Consultorio', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Parqueadero', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Habitación', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Casa campestre', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Penthouse', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Apartaestudio', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Local en centro comercial', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Edificio', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Suite', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Cabaña', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Galpón', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Terreno rural', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Locales múltiples', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
