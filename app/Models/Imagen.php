<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table = 'imagenes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'url_imagen',
        'id_inmueble'
    ];

    public function inmueble()
    {
        return $this->belongsTo(Inmueble::class, 'idinmueble');
    }
}
