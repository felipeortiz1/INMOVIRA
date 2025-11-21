<?php

namespace Database\Seeders;

use App\Models\Inmueble;
use Illuminate\Database\Seeder;

class InmueblesSeeder extends Seeder
{
    public function run(): void
    {
        $inmuebles = [
            // === 1 ===
            [
                'direccion' => 'Cra 5 #12-34',
                'titulo' => 'Casa amplia cerca al parque principal',
                'tipoOferta' => 'venta',
                'precio' => 180000000,
                'precioAdministracion' => null,
                'area' => 120,
                'nHabitaciones' => 4,
                'nBaños' => 2,
                'nParqueaderos' => 1,
                'nPiso' => 1,
                'pisoNumero' => null,
                'descripcion' => 'Casa tradicional en excelente estado.',
                'idUsuario' => 1,
                'idBarrio' => 1,
                'idTipoInmueble' => 1,
            ],
            
            // === 2 ===
            [
                'direccion' => 'Calle 8 #7-22',
                'titulo' => 'Apartamento en zona tranquila',
                'tipoOferta' => 'arriendo',
                'precio' => 650000,
                'precioAdministracion' => 50000,
                'area' => 65,
                'nHabitaciones' => 2,
                'nBaños' => 1,
                'nParqueaderos' => 0,
                'nPiso' => 3,
                'pisoNumero' => 3,
                'descripcion' => 'Apartamento iluminado, cerca a tiendas.',
                'idUsuario' => 2,
                'idBarrio' => 2,
                'idTipoInmueble' => 2,
            ],

            // === 3 ===
            [
                'direccion' => 'Vereda Zigarán',
                'titulo' => 'Finca con excelente vista',
                'tipoOferta' => 'venta',
                'precio' => 320000000,
                'precioAdministracion' => null,
                'area' => 12000,
                'nHabitaciones' => 3,
                'nBaños' => 2,
                'nParqueaderos' => 3,
                'nPiso' => 1,
                'pisoNumero' => null,
                'descripcion' => 'Finca productiva con árboles frutales.',
                'idUsuario' => 3,
                'idBarrio' => 3,
                'idTipoInmueble' => 3,
            ],

            // === 4 ===
            [
                'direccion' => 'Cra 4 #10-15',
                'titulo' => 'Local comercial en zona central',
                'tipoOferta' => 'arriendo',
                'precio' => 1500000,
                'precioAdministracion' => null,
                'area' => 40,
                'nHabitaciones' => 0,
                'nBaños' => 1,
                'nParqueaderos' => 0,
                'nPiso' => 1,
                'pisoNumero' => 1,
                'descripcion' => 'Ideal para negocio pequeño.',
                'idUsuario' => 2,
                'idBarrio' => 1,
                'idTipoInmueble' => 4,
            ],

            // === 5 ===
            [
                'direccion' => 'Calle 11 #9-18',
                'titulo' => 'Apartamento remodelado',
                'tipoOferta' => 'venta',
                'precio' => 200000000,
                'precioAdministracion' => 80000,
                'area' => 85,
                'nHabitaciones' => 3,
                'nBaños' => 2,
                'nParqueaderos' => 1,
                'nPiso' => 2,
                'pisoNumero' => 2,
                'descripcion' => 'Cerca al hospital y zonas verdes.',
                'idUsuario' => 1,
                'idBarrio' => 2,
                'idTipoInmueble' => 2,
            ],

            // === 6 ===
            [
                'direccion' => 'Vereda La Palmita',
                'titulo' => 'Lote económico',
                'tipoOferta' => 'venta',
                'precio' => 45000000,
                'precioAdministracion' => null,
                'area' => 300,
                'nHabitaciones' => 0,
                'nBaños' => 0,
                'nParqueaderos' => 0,
                'nPiso' => 0,
                'pisoNumero' => null,
                'descripcion' => 'Terreno ideal para construir.',
                'idUsuario' => 3,
                'idBarrio' => 4,
                'idTipoInmueble' => 5,
            ],

            // === 7 ===
            [
                'direccion' => 'Calle 6 #5-40',
                'titulo' => 'Casa familiar grande',
                'tipoOferta' => 'venta',
                'precio' => 250000000,
                'precioAdministracion' => null,
                'area' => 150,
                'nHabitaciones' => 5,
                'nBaños' => 3,
                'nParqueaderos' => 2,
                'nPiso' => 2,
                'pisoNumero' => null,
                'descripcion' => 'Perfecta para familia numerosa.',
                'idUsuario' => 1,
                'idBarrio' => 1,
                'idTipoInmueble' => 1,
            ],

            // === 8 ===
            [
                'direccion' => 'Sector La Cascajera',
                'titulo' => 'Finca con agua natural',
                'tipoOferta' => 'venta',
                'precio' => 500000000,
                'precioAdministracion' => null,
                'area' => 20000,
                'nHabitaciones' => 3,
                'nBaños' => 2,
                'nParqueaderos' => 4,
                'nPiso' => 1,
                'pisoNumero' => null,
                'descripcion' => 'Incluye pozo de agua cristalina.',
                'idUsuario' => 2,
                'idBarrio' => 5,
                'idTipoInmueble' => 3,
            ],

            // === 9 ===
            [
                'direccion' => 'Calle 3 #2-89',
                'titulo' => 'Local económico para inicio de negocio',
                'tipoOferta' => 'arriendo',
                'precio' => 700000,
                'precioAdministracion' => null,
                'area' => 25,
                'nHabitaciones' => 0,
                'nBaños' => 1,
                'nParqueaderos' => 0,
                'nPiso' => 1,
                'pisoNumero' => 1,
                'descripcion' => 'Perfecto para emprendimientos.',
                'idUsuario' => 3,
                'idBarrio' => 3,
                'idTipoInmueble' => 4,
            ],

            // === 10 ===
            [
                'direccion' => 'Cra 1 #4-12',
                'titulo' => 'Casa económica lista para habitar',
                'tipoOferta' => 'venta',
                'precio' => 120000000,
                'precioAdministracion' => null,
                'area' => 95,
                'nHabitaciones' => 3,
                'nBaños' => 1,
                'nParqueaderos' => 0,
                'nPiso' => 1,
                'pisoNumero' => null,
                'descripcion' => 'Buena iluminación y ubicación.',
                'idUsuario' => 1,
                'idBarrio' => 2,
                'idTipoInmueble' => 1,
            ],
        ];

        // GENERAMOS 20 EN TOTAL
        for ($i = 11; $i <= 20; $i++) {
            $inmuebles[] = [
                'direccion' => "Calle $i #$i-".($i+10),
                'titulo' => "Inmueble ejemplo $i",
                'tipoOferta' => ['venta', 'arriendo'][rand(0,1)],
                'precio' => rand(60000000, 500000000),
                'precioAdministracion' => rand(0,1) ? rand(50000, 120000) : null,
                'area' => rand(40, 300),
                'nHabitaciones' => rand(1,5),
                'nBaños' => rand(1,3),
                'nParqueaderos' => rand(0,2),
                'nPiso' => rand(1,3),
                'pisoNumero' => rand(1,3),
                'descripcion' => "Inmueble generado automáticamente.",
                'idUsuario' => rand(1,3),
                'idBarrio' => rand(1,5),
                'idTipoInmueble' => rand(1,5),
            ];
        }

        Inmueble::insert($inmuebles);
    }
}
