<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table = 'imagens';
    protected $primaryKey = 'id';
    protected $fillable = [
        'url_imagen',
        'idInmueble'
    ];

    public function inmueble()
    {
        return $this->belongsTo(Inmueble::class, 'idInmueble');
    }
}
