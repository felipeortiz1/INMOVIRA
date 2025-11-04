<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inmueble extends Model
{

    protected $table = 'inmuebles';
    protected $fillable = [
        'titulo',
        'direccion',
        'tipoOferta',
        'idTipoInmueble',
        'idBarrio',
        'idUsuario',
        'precio',
        'precioAdministracion',
        'area',
        'nHabitaciones',
        'nBaños',
        'nParqueaderos',
        'nPiso',
        'pisoNumero',
        'descripcion',
        'estadoPublicacion',
    ];

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario');
    }

    public function barrio()
    {
        return $this->belongsTo(Barrio::class, 'idBarrio');
    }

    public function tipoInmueble()
    {
        return $this->belongsTo(TipoInmueble::class, 'idTipoInmueble');
    }

    public function imagenes()
    {
        return $this->hasMany(Imagen::class);
    }

    protected $casts = [
        'fechaPublicacion' => 'datetime',
    ];
}
