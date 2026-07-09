<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    /**
     * Paso 1: Muestra la vista donde el usuario ingresa su correo.
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Paso 2: Valida el correo y envía el enlace de recuperación.
     */
    public function store(Request $request)
    {
        // Validar que el correo sea obligatorio y tenga formato válido
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Intentar enviar el enlace de recuperación usando la Facade de Laravel
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Retornar mensaje de éxito o de error
        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('success', 'Te hemos enviado el enlace de recuperación a tu correo.');
        }

        return back()->withErrors(['email' => 'No pudimos encontrar un usuario con ese correo.']);
    }

    /**
     * Paso 3: Muestra el formulario para escribir la nueva contraseña.
     * (A esta ruta llega el usuario al hacer clic en el correo)
     */
    public function edit(Request $request, $token)
    {
        return view('auth.reset-password', [
            'token' => $token, 
            'email' => $request->email
        ]);
    }

    /**
     * Paso 4: Procesa el cambio y guarda la nueva contraseña en la base de datos.
     */
    public function update(Request $request)
    {
        // Validar los datos del formulario (token, email y contraseña confirmada)
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed', // 'confirmed' valida contra 'password_confirmation'
        ]);

        // Intentar restablecer la contraseña
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                // Encriptar la nueva contraseña y actualizar el token de sesión
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
                
                // Disparar el evento nativo de Laravel
                event(new PasswordReset($user));
            }
        );

        // Si se cambió con éxito, redirige al login. Si no, devuelve el error.
        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', '¡Tu contraseña ha sido restablecida exitosamente!');
        }

        return back()->withErrors(['email' => [trans($status)]]);
    }
}