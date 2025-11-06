<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interaccion extends Model
{
    protected $table = 'interaccions';

    protected $fillable = [
        'idUsuario',
        'idInmueble',
        'tipoInteraccion',
        'fecgaInteraccion'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'idUsuario');
    }

    public function inmueble()
    {
        return $this->belongsTo(Inmueble::class, 'idInmueble');
    }
}
