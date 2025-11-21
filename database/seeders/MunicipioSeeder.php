<?php

namespace Database\Seeders;

use App\Models\Municipio;
use Illuminate\Database\Seeder;

class MunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Municipio::insert([
            ['nombre' => 'Málaga',               'codigoPostal' => '683001', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Concepción',          'codigoPostal' => '683007', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Enciso',              'codigoPostal' => '683011', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Carcasí',             'codigoPostal' => '683015', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'San José de Miranda', 'codigoPostal' => '683017', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Capitanejo',          'codigoPostal' => '683020', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Molagavita',          'codigoPostal' => '683025', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'San Andrés',          'codigoPostal' => '683030', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Guaca',               'codigoPostal' => '683040', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Aratoca',             'codigoPostal' => '684041', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Curití',              'codigoPostal' => '684031', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'San Gil',             'codigoPostal' => '684031', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Barichara',           'codigoPostal' => '684041', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Villanueva',          'codigoPostal' => '684051', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Charalá',             'codigoPostal' => '684551', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Ocamonte',            'codigoPostal' => '684541', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Chima',               'codigoPostal' => '684521', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Socorro',             'codigoPostal' => '684031', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Pinchote',            'codigoPostal' => '684071', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Cepitá',              'codigoPostal' => '681017', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
