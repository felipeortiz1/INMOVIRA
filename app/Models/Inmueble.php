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
        'idusuario',
        'idbarrio',
        'idtipoInmueble'
    ];

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idusuario');
    }

    public function barrio()
    {
        return $this->belongsTo(Barrio::class, 'idbarrio');
    }

    public function tipoInmueble()
    {
        return $this->belongsTo(TipoInmueble::class, 'idtipoInmueble');
    }

    public function imagenes()
    {
        return $this->hasMany(Imagen::class, 'idinmueble');
    }
}
