<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Faker\Factory as Faker;

class InmueblesSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Obtenemos los IDs existentes
        $usuarios = DB::table('usuarios')->pluck('id');
        $barrios = DB::table('barrios')->pluck('id');
        $tipos = DB::table('tipo_inmuebles')->pluck('id');

        if ($usuarios->isEmpty() || $barrios->isEmpty() || $tipos->isEmpty()) {
            echo "⚠️ No hay usuarios, barrios o tipos de inmueble. Asegúrate de tener datos antes de ejecutar este seeder.\n";
            return;
        }

        foreach (range(1, 20) as $i) {
            DB::table('inmuebles')->insert([
                'direccion' => $faker->streetAddress,
                'titulo' => ucfirst($faker->words(3, true)),
                'tipoOferta' => $faker->randomElement(['venta', 'arriendo', 'venta y arriendo']),
                'precio' => $faker->randomFloat(2, 90000000, 900000000),
                'precioAdministracion' => $faker->randomFloat(2, 0, 300000),
                'area' => $faker->randomFloat(2, 40, 800),
                'nHabitaciones' => $faker->numberBetween(1, 6),
                'nBaños' => $faker->numberBetween(1, 4),
                'nParqueaderos' => $faker->numberBetween(0, 3),
                'nPiso' => $faker->numberBetween(1, 5),
                'pisoNumero' => $faker->numberBetween(1, 20),
                'descripcion' => $faker->sentence(15),
                'fechaPublicacion' => Carbon::now()->subDays(rand(0, 60)),
                'estadoPublicacion' => $faker->randomElement(['disponible', 'arrendado', 'vendido', 'reservado', 'inactivo']),
                'fechaCreacion' => Carbon::now(),
                'idUsuario' => $usuarios->random(),
                'idBarrio' => $barrios->random(),
                'idTipoInmueble' => $tipos->random(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
