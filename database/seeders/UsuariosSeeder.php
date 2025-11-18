<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Usuario::insert([
            [
                'nombre' => 'Juan Pérez',
                'email' => 'juanperez@gmail.com',
                'telefono' => '3104567890',
                'tipoUsuario' => 'persona',
                'nombreEmpresa' => null,
                'fechaRegistro' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Inmobiliaria Los Andes',
                'email' => 'contacto@losandes.com',
                'telefono' => '3124567890',
                'tipoUsuario' => 'inmobiliaria',
                'nombreEmpresa' => 'Los Andes S.A.S',
                'fechaRegistro' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'María Gómez',
                'email' => 'maria.gomez@gmail.com',
                'telefono' => '3112223344',
                'tipoUsuario' => 'persona',
                'nombreEmpresa' => null,
                'fechaRegistro' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ]);
    }
}
