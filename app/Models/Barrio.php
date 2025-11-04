<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barrio extends Model
{
    protected $table = 'barrios';
    protected $fillable = ['nombre','idMunicipio'];

    public function Municipios()
    {
        return $this->belongsTo(Municipio::class, 'idMunicipio');
    }
}
