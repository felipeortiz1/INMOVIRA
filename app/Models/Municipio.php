<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'municipios';

    protected $fillable = [
        'nombre',
        'codigoPostal'
    ];

    public function barrios()
    {
        return $this->hasMany(Barrio::class, 'idMunicipio');
    }

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'idUsuario');
    }
}
