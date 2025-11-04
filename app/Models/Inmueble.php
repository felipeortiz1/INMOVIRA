<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inmueble extends Model
{

    protected $table = 'inmuebles';
    protected $primaryKey = 'id';
    protected $fillable = [
        'direccion',
        'titulo',
        'tipoOferta',
        'precio',
        'precioAdministracion',
        'area',
        'nHabitaciones',
        'nBaños',
        'nParqueaderos',
        'nPiso',
        'pisoNumero',
        'descripcion',
        'fechaPublicacion',
        'estadoPublicacion',
        'fechaCreacion',
        'idUsuario',
        'idBarrio',
        'idTipoInmueble'
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
        return $this->hasMany(Imagen::class, 'idInmueble');
    }

    protected $casts = [
    'fechaPublicacion' => 'datetime',
];

}
