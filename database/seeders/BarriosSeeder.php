<?php

namespace Database\Seeders;

use App\Models\Barrio;
use Illuminate\Database\Seeder;

class BarriosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Barrio::insert(
            [
                // ---------------------------------------------------------
                // MUNICIPIO 1: Capitanejo
                // ---------------------------------------------------------
                ['nombre' => 'Centro',        'idMunicipio' => 1, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'La Loma',       'idMunicipio' => 1, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'Altos del Puente', 'idMunicipio' => 1, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'El Bosque',     'idMunicipio' => 1, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'San Martín',    'idMunicipio' => 1, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'San Rafael',    'idMunicipio' => 1, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'La Floresta',   'idMunicipio' => 1, 'created_at' => now(), 'updated_at' => now()],


                // ---------------------------------------------------------
                // MUNICIPIO 2: Carcasí
                // ---------------------------------------------------------
                ['nombre' => 'Centro',        'idMunicipio' => 2, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'La Esperanza',  'idMunicipio' => 2, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'La Pradera',    'idMunicipio' => 2, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'El Progreso',   'idMunicipio' => 2, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'San Antonio',   'idMunicipio' => 2, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'El Mirador',    'idMunicipio' => 2, 'created_at' => now(), 'updated_at' => now()],


                // ---------------------------------------------------------
                // MUNICIPIO 3: Cerrito
                // ---------------------------------------------------------
                ['nombre' => 'Centro',        'idMunicipio' => 3, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'San Isidro',    'idMunicipio' => 3, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'El Encanto',    'idMunicipio' => 3, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'Villa Nueva',   'idMunicipio' => 3, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'La Colina',     'idMunicipio' => 3, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'Santa Bárbara', 'idMunicipio' => 3, 'created_at' => now(), 'updated_at' => now()],


                // ---------------------------------------------------------
                // MUNICIPIO 4: Concepción
                // ---------------------------------------------------------
                ['nombre' => 'Centro',        'idMunicipio' => 4, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'El Recreo',     'idMunicipio' => 4, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'Bellavista',    'idMunicipio' => 4, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'San Francisco', 'idMunicipio' => 4, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'La Colina',     'idMunicipio' => 4, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'Los Pinos',     'idMunicipio' => 4, 'created_at' => now(), 'updated_at' => now()],


                // ---------------------------------------------------------
                // MUNICIPIO 5: Enciso
                // ---------------------------------------------------------
                ['nombre' => 'Centro',        'idMunicipio' => 5, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'Santa Ana',     'idMunicipio' => 5, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'El Bosque',     'idMunicipio' => 5, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'San Miguel',    'idMunicipio' => 5, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'Los Robles',    'idMunicipio' => 5, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'La Unión',      'idMunicipio' => 5, 'created_at' => now(), 'updated_at' => now()],


                // ---------------------------------------------------------
                // MUNICIPIO 6: Guaca
                // ---------------------------------------------------------
                ['nombre' => 'Centro',        'idMunicipio' => 6, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'Alto del Río',  'idMunicipio' => 6, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'La Unión',      'idMunicipio' => 6, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'San José',      'idMunicipio' => 6, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'La Floresta',   'idMunicipio' => 6, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'Las Villas',    'idMunicipio' => 6, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'Villa Nueva',   'idMunicipio' => 6, 'created_at' => now(), 'updated_at' => now()],


                // ---------------------------------------------------------
                // MUNICIPIO 7: Macaravita
                // ---------------------------------------------------------
                ['nombre' => 'Centro',        'idMunicipio' => 7, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'Los Pinos',     'idMunicipio' => 7, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'El Mirador',    'idMunicipio' => 7, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'San Antonio',   'idMunicipio' => 7, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'La Unión',      'idMunicipio' => 7, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'Villa del Río', 'idMunicipio' => 7, 'created_at' => now(), 'updated_at' => now()],


                // ---------------------------------------------------------
                // MUNICIPIO 8: Málaga
                // ---------------------------------------------------------
                ['nombre' => 'Centro',        'idMunicipio' => 8, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'El Progreso',   'idMunicipio' => 8, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'La Granja',     'idMunicipio' => 8, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'Los Pinos',     'idMunicipio' => 8, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'Villa del Rosario', 'idMunicipio' => 8, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'Santa Bárbara', 'idMunicipio' => 8, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'La Libertad',   'idMunicipio' => 8, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'El Bosque',     'idMunicipio' => 8, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'San Luis',      'idMunicipio' => 8, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'San Francisco', 'idMunicipio' => 8, 'created_at' => now(), 'updated_at' => now()],


                // ---------------------------------------------------------
                // MUNICIPIO 9: Molagavita
                // ---------------------------------------------------------
                ['nombre' => 'Centro',        'idMunicipio' => 9, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'San Miguel',    'idMunicipio' => 9, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'Villa del Carmen', 'idMunicipio' => 9, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'La Unión',      'idMunicipio' => 9, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'Altos del Sol', 'idMunicipio' => 9, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'El Portal',     'idMunicipio' => 9, 'created_at' => now(), 'updated_at' => now()],


                // ---------------------------------------------------------
                // MUNICIPIO 10: San Andrés
                // ---------------------------------------------------------
                ['nombre' => 'Centro',        'idMunicipio' => 10, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'La Loma',       'idMunicipio' => 10, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'San Antonio',   'idMunicipio' => 10, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'La Pradera',    'idMunicipio' => 10, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'El Porvenir',   'idMunicipio' => 10, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'Campo Alegre',  'idMunicipio' => 10, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'El Mirador',    'idMunicipio' => 10, 'created_at' => now(), 'updated_at' => now()],


                // ---------------------------------------------------------
                // MUNICIPIO 11: San José de Miranda
                // ---------------------------------------------------------
                ['nombre' => 'Centro',        'idMunicipio' => 11, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'Santa Helena',  'idMunicipio' => 11, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'San Pedro',     'idMunicipio' => 11, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'El Progreso',   'idMunicipio' => 11, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'La Esperanza',  'idMunicipio' => 11, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'Altos del Rosario', 'idMunicipio' => 11, 'created_at' => now(), 'updated_at' => now()],


                // ---------------------------------------------------------
                // MUNICIPIO 12: San Miguel
                // ---------------------------------------------------------
                ['nombre' => 'Centro',        'idMunicipio' => 12, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'La Floresta',   'idMunicipio' => 12, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'Barrio Nuevo',  'idMunicipio' => 12, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'San Rafael',    'idMunicipio' => 12, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'El Carmen',     'idMunicipio' => 12, 'created_at' => now(), 'updated_at' => now()],
                ['nombre' => 'El Porvenir',   'idMunicipio' => 12, 'created_at' => now(), 'updated_at' => now()],
            ]
        );
    }
}
