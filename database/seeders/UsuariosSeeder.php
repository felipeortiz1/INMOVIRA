<?php

namespace Database\Seeders;

use App\Models\Usuario;
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
                'direccion' => 'Carrera 4 #12-08',
                'idMunicipio' => 8, // Málaga
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
                'direccion' => 'Calle 6 #8-32',
                'idMunicipio' => 10, // San Andrés
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
                'direccion' => 'Barrio Centro, Calle 3 #5-21',
                'idMunicipio' => 1, // Capitanejo
                'tipoUsuario' => 'persona',
                'nombreEmpresa' => null,
                'fechaRegistro' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Carlos Rodríguez',
                'email' => 'carlos.rodriguez@example.com',
                'telefono' => '3001112233',
                'direccion' => 'Vereda La Laja',
                'idMunicipio' => 3, // Cerrito
                'tipoUsuario' => 'persona',
                'nombreEmpresa' => null,
                'fechaRegistro' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Inmobiliaria Málaga Hogar',
                'email' => 'info@malagahogar.com',
                'telefono' => '3145566778',
                'direccion' => 'Carrera 7 #9-44',
                'idMunicipio' => 8, // Málaga
                'tipoUsuario' => 'inmobiliaria',
                'nombreEmpresa' => 'Málaga Hogar Ltda.',
                'fechaRegistro' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Laura Rincón',
                'email' => 'laura.rincon@example.com',
                'telefono' => '3019988776',
                'direccion' => 'Calle Real #2-50',
                'idMunicipio' => 5, // Enciso
                'tipoUsuario' => 'persona',
                'nombreEmpresa' => null,
                'fechaRegistro' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Pedro Herrera',
                'email' => 'pedro.herrera@example.com',
                'telefono' => '3215566789',
                'direccion' => 'Calle 1 #3-10',
                'idMunicipio' => 9, // Molagavita
                'tipoUsuario' => 'persona',
                'nombreEmpresa' => null,
                'fechaRegistro' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Constructora Altavista',
                'email' => 'contacto@altavista.com',
                'telefono' => '3157788990',
                'direccion' => 'Avenida Principal #10-20',
                'idMunicipio' => 4, // Concepción
                'tipoUsuario' => 'inmobiliaria',
                'nombreEmpresa' => 'Altavista S.A.',
                'fechaRegistro' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Sofía López',
                'email' => 'sofia.lopez@example.com',
                'telefono' => '3201122334',
                'direccion' => 'Barrio San José, Calle 4',
                'idMunicipio' => 12, // San Miguel
                'tipoUsuario' => 'persona',
                'nombreEmpresa' => null,
                'fechaRegistro' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Miguel Ramírez',
                'email' => 'miguel.ramirez@example.com',
                'telefono' => '3054433221',
                'direccion' => 'Sector El Llano',
                'idMunicipio' => 2, // Carcasí
                'tipoUsuario' => 'persona',
                'nombreEmpresa' => null,
                'fechaRegistro' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Inmobiliaria Santander Real',
                'email' => 'info@santanderreal.com',
                'telefono' => '3162211987',
                'direccion' => 'Carrera 8 #15-30',
                'idMunicipio' => 8, // Málaga
                'tipoUsuario' => 'inmobiliaria',
                'nombreEmpresa' => 'Santander Real S.A.',
                'fechaRegistro' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Daniela Torres',
                'email' => 'daniela.torres@example.com',
                'telefono' => '3114433556',
                'direccion' => 'Calle 7 #6-12',
                'idMunicipio' => 11, // San José de Miranda
                'tipoUsuario' => 'persona',
                'nombreEmpresa' => null,
                'fechaRegistro' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Cristian Medina',
                'email' => 'cristian.medina@example.com',
                'telefono' => '3005632289',
                'direccion' => 'Vereda Alto Grande',
                'idMunicipio' => 6, // Guaca
                'tipoUsuario' => 'persona',
                'nombreEmpresa' => null,
                'fechaRegistro' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Agencia El Roble Inmobiliaria',
                'email' => 'contacto@elroble.com',
                'telefono' => '3175566771',
                'direccion' => 'Calle 3 #7-11',
                'idMunicipio' => 7, // Macaravita
                'tipoUsuario' => 'inmobiliaria',
                'nombreEmpresa' => 'El Roble S.A.S',
                'fechaRegistro' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Paula Suárez',
                'email' => 'paula.suarez@example.com',
                'telefono' => '3026655987',
                'direccion' => 'Barrio Centro',
                'idMunicipio' => 10, // San Andrés
                'tipoUsuario' => 'persona',
                'nombreEmpresa' => null,
                'fechaRegistro' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Luis Herrera',
                'email' => 'luis.herrera@example.com',
                'telefono' => '3119988773',
                'direccion' => 'Calle 2 #4-06',
                'idMunicipio' => 3, // Cerrito
                'tipoUsuario' => 'persona',
                'nombreEmpresa' => null,
                'fechaRegistro' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Inmobiliaria Colinas del Sol',
                'email' => 'info@colinasdelsol.com',
                'telefono' => '3146677885',
                'direccion' => 'Carrera 10 #8-40',
                'idMunicipio' => 5, // Enciso
                'tipoUsuario' => 'inmobiliaria',
                'nombreEmpresa' => 'Colinas del Sol SAS',
                'fechaRegistro' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Esteban Vargas',
                'email' => 'esteban.vargas@example.com',
                'telefono' => '3045567889',
                'direccion' => 'Calle 1 #3-09',
                'idMunicipio' => 9, // Molagavita
                'tipoUsuario' => 'persona',
                'nombreEmpresa' => null,
                'fechaRegistro' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Juliana Acevedo',
                'email' => 'juliana.acevedo@example.com',
                'telefono' => '3226677889',
                'direccion' => 'Vereda El Cerro',
                'idMunicipio' => 1, // Capitanejo
                'tipoUsuario' => 'persona',
                'nombreEmpresa' => null,
                'fechaRegistro' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Constructora Horizonte',
                'email' => 'contacto@horizonte.com',
                'telefono' => '3197788992',
                'direccion' => 'Calle 5 #4-90',
                'idMunicipio' => 8, // Málaga
                'tipoUsuario' => 'inmobiliaria',
                'nombreEmpresa' => 'Horizonte Constructores S.A.',
                'fechaRegistro' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
