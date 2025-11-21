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
    Route::post('/municipio/update/{id}', [MunicipioController::class, 'update'])->name('municipios.update');
    Route::post('/municipio/destroy/{id}', [MunicipioController::class, 'destroy'])->name('municipios.destroy');

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

    // Barrios
    Route::get('/barrio/index', [BarrioController::class, 'index'])->name('barrios.index');
    Route::get('/barrio/create', [BarrioController::class, 'create'])->name('barrios.create');
    Route::post('/barrio/store', [BarrioController::class, 'store'])->name('barrios.store');
    Route::get('/barrio/edit/{id}', [BarrioController::class, 'edit'])->name('barrios.edit');
    Route::post('/barrio/update/{id}', [BarrioController::class, 'update'])->name('barrios.update');
    Route::post('/barrio/destroy/{id}', [BarrioController::class, 'destroy'])->name('barrios.destroy');

    // Inmuebles
    Route::get('/inmueble/index', [InmuebleController::class, 'index'])->name('inmuebles.index');
    Route::get('/inmueble/create', [InmuebleController::class, 'create'])->name('inmuebles.create');
    Route::post('/inmueble/store', [InmuebleController::class, 'store'])->name('inmuebles.store');
    Route::get('/inmueble/edit/{id}', [InmuebleController::class, 'edit'])->name('inmuebles.edit');
    Route::put('/inmueble/update/{id}', [InmuebleController::class, 'update'])->name('inmuebles.update');
    Route::post('/inmueble/destroy/{id}', [InmuebleController::class, 'destroy'])->name('inmuebles.destroy');
    Route::get('/inmueble/{id}/imagenes', [InmuebleController::class, 'obtenerImagenes']);
    Route::get('/inmueble/{id}/detalles', [InmuebleController::class, 'obtenerDetalles']);


    // ruta para la vista principal

    Route::get('/pagina-principal', function () {
        return view('PaginaPrincipal.Vista');
    })->name('pagina.principal');
    

    // Página pública: Arriendo
    Route::get('/arriendo', [App\Http\Controllers\InmuebleController::class, 'vistaArriendo'])
        ->name('vista.arriendo');

    // Página pública: Venta
    Route::get('/venta', [App\Http\Controllers\InmuebleController::class, 'vistaVenta'])
        ->name('vista.venta');

    // Página pública: Inmobiliarias (tú decides contenido)
    Route::get('/inmobiliarias', function () {
        return view('paginaPrincipal.inmobiliarias'); 
    })->name('vista.inmobiliarias');



