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
            ['nombre' => 'Capitanejo',         'codigoPostal' => '683100', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Carcasí',            'codigoPostal' => '683030', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Cerrito',            'codigoPostal' => '683040', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Concepción',         'codigoPostal' => '683010', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Enciso',             'codigoPostal' => '683020', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Guaca',              'codigoPostal' => '683050', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Macaravita',         'codigoPostal' => '683090', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Málaga',             'codigoPostal' => '683001', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Molagavita',         'codigoPostal' => '683060', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'San Andrés',         'codigoPostal' => '683110', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'San José de Miranda', 'codigoPostal' => '683070', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'San Miguel',         'codigoPostal' => '683080', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
