<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarrioController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\InmuebleController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\TipoInmuebleController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BuscadorController;
use App\Models\Municipio;

// Ruta inicial -> redirige siempre al login
Route::get('/', function () {
    return redirect()->route('pagina.principal');
});

// Rutas públicas (sin autenticación)
Route::get('/login', [AuthController::class, 'verlogin'])->name('login');
Route::post('/loginsubmit', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Registro de usuarios
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// Dashboard (pantalla principal después del login)
Route::get('/dashboard', function () {
    return view('welcome');
})->name('dashboard');

// Municipios
Route::get('/municipio/index', [MunicipioController::class, 'index'])->name('municipios.index');
Route::get('/municipio/create', [MunicipioController::class, 'create'])->name('municipios.create');
Route::post('/municipio/store', [MunicipioController::class, 'store'])->name('municipios.store');
Route::get('/municipio/edit/{id}', [MunicipioController::class, 'edit'])->name('municipios.edit');
Route::put('/municipio/update/{id}', [MunicipioController::class, 'update'])->name('municipios.update');
Route::post('/municipio/destroy/{id}', [MunicipioController::class, 'destroy'])->name('municipios.destroy');
Route::get('/municipio/buscar', [MunicipioController::class, 'buscar'])->name('municipios.buscar'); // Ruta para la función de búsqueda avanzada

// Tipo de Inmueble
Route::get('/tipoInmueble/index', [TipoInmuebleController::class, 'index'])->name('tipoInmueble.index');
Route::get('/tipoInmueble/create', [TipoInmuebleController::class, 'create'])->name('tipoInmueble.create');
Route::post('/tipoInmueble/store', [TipoInmuebleController::class, 'store'])->name('tipoInmueble.store');
Route::get('/tipoInmueble/edit/{id}', [TipoInmuebleController::class, 'edit'])->name('tipoInmueble.edit');
Route::post('/tipoInmueble/update/{id}', [TipoInmuebleController::class, 'update'])->name('tipoInmueble.update');
Route::delete('/tipoInmueble/destroy/{id}', [TipoInmuebleController::class, 'destroy'])->name('tipoInmueble.destroy');

// Usuarios
Route::get('/usuario/index', [UsuarioController::class, 'index'])->name('usuario.index');
Route::get('/usuario/create', [UsuarioController::class, 'create'])->name('usuario.create');
Route::post('/usuario/store', [UsuarioController::class, 'store'])->name('usuario.store');
Route::get('/usuario/edit/{id}', [UsuarioController::class, 'edit'])->name('usuario.edit');
Route::post('/usuario/update/{id}', [UsuarioController::class, 'update'])->name('usuario.update');
Route::post('/usuario/destroy/{id}', [UsuarioController::class, 'destroy'])->name('usuario.destroy');
Route::get('/usuario/buscar', [UsuarioController::class, 'buscar'])->name('usuario.buscar'); // Ruta para la función de búsqueda avanzada

// Barrios
Route::get('/barrio/index', [BarrioController::class, 'index'])->name('barrios.index');
Route::get('/barrio/create', [BarrioController::class, 'create'])->name('barrios.create');
Route::post('/barrio/store', [BarrioController::class, 'store'])->name('barrios.store');
Route::get('/barrio/edit/{id}', [BarrioController::class, 'edit'])->name('barrios.edit');
Route::post('/barrio/update/{id}', [BarrioController::class, 'update'])->name('barrios.update');
Route::post('/barrio/destroy/{id}', [BarrioController::class, 'destroy'])->name('barrios.destroy');
Route::get('/barrio/buscar', [BarrioController::class, 'buscar'])->name('barrios.buscar'); // Ruta para la función de búsqueda avanzada

// Inmuebles
Route::get('/inmueble/index', [InmuebleController::class, 'index'])->name('inmuebles.index');
Route::get('/inmueble/create', [InmuebleController::class, 'create'])->name('inmuebles.create');
Route::post('/inmueble/store', [InmuebleController::class, 'store'])->name('inmuebles.store');
Route::get('/inmueble/edit/{id}', [InmuebleController::class, 'edit'])->name('inmuebles.edit');
Route::put('/inmueble/update/{id}', [InmuebleController::class, 'update'])->name('inmuebles.update');
Route::post('/inmueble/destroy/{id}', [InmuebleController::class, 'destroy'])->name('inmuebles.destroy');

// Endpoints auxiliares
Route::get('/inmuebles/buscar', [InmuebleController::class, 'buscar'])->name('inmuebles.buscar'); // autocompletado
Route::get('/inmueble/{id}/imagenes', [InmuebleController::class, 'obtenerImagenes'])->name('inmuebles.imagenes');
Route::get('/inmueble/{id}/detalles', [InmuebleController::class, 'obtenerDetalles'])->name('inmuebles.detalles');

// Obtener barrios por municipio (select dependiente)
Route::get('/barrios-por-municipio/{id}', function ($id) {
    return App\Models\Barrio::where('idMunicipio', $id)->get();
})->name('barrios.porMunicipio');

// ruta para la vista principal

Route::get('/pagina-principal', function () {
    return view('PaginaPrincipal.Vista');
})->name('pagina.principal');


// Página pública: Arriendo
Route::get('/arriendo', [InmuebleController::class, 'vistaArriendoPublic'])
    ->name('vista.arriendo');

Route::get('/venta', [InmuebleController::class, 'vistaVentaPublic'])
    ->name('vista.venta');


// Página pública: Inmobiliarias 
Route::get('/inmobiliarias', [UsuarioController::class, 'inmobiliariasVista'])
    ->name('vista.inmobiliarias');

Route::get('/inmobiliaria/{id}/detalles', [UsuarioController::class, 'detalles'])
    ->name('inmobiliarias.detalles');


//Ruta para filtros
Route::get('/buscar', [BuscadorController::class, 'buscar'])
    ->name('buscador.inmuebles');
