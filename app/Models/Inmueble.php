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
        'n_habitaciones',
        'n_baños',
        'n_parqueaderos',
        'n_piso',
        'pisoNumero',
        'descripcion',
        'fechaPublicacion',
        'estadoPublicacion',
        'fechaCreacion',
        'id_usuario',
        'id_barrio',
        'id_tipo'
    ];

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function barrio()
    {
        return $this->belongsTo(Barrio::class, 'id_barrio');
    }

    public function tipoInmueble()
    {
        return $this->belongsTo(TipoInmueble::class, 'id_tipo');
    }

    public function imagenes()
    {
        return $this->hasMany(Imagen::class, 'id_inmueble');
    }
}
