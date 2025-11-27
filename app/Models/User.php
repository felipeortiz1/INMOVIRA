<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Metodo para el perfil de usuario en AdminLTE
    public function adminlte_profile_url()
    {
        return route('perfil');
    }

    // Metodo para la imagen de usuario en AdminLTE
    public function adminlte_image()
    {
        // Si el usuario tiene una imagen guardada en BD
        if ($this->avatar) {
            return asset('storage/adminAvatar/' . $this->avatar);
        }

        // Si no tiene imagen → generar avatar con inicial
        $initial = strtoupper(substr($this->name, 0, 1));

        // Generar imagen usando UI Avatars
        return "https://ui-avatars.com/api/?name={$initial}&background=3c8dbc&color=fff&size=300&bold=true";
    }

    // Metodo para la descripcion de usuario en AdminLTE
    public function adminlte_desc()
    {
        return "Administrador del sistema";
    }
}
