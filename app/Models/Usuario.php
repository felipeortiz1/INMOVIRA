<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'tipoUsuario',
        'nombreEmpresa',
        'fechaRegistro'
    ];

        // Mutator para limpiar nombreEmpresa si no es inmobiliaria
    public function setTipoUsuarioAttribute($value)
    {
        $this->attributes['tipoUsuario'] = $value;

        if ($value === 'persona') {
            $this->attributes['nombreEmpresa'] = null;
        }
    }

    public function inmuebles()
    {
        return $this->hasMany(Inmueble::class, 'idUsuario');
    }

    public function interacciones()
    {
        return $this->hasMany(Interaccion::class);
    }

}
