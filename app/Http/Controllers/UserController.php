<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{

    /**
     * Vista del perfil de usuarios
     */
    public function profile()
    {
        return view('AdminUser.perfil');
    }

    /**
     * Mostar editar perfil
     */
    public function edit()
    {
        return view('AdminUser.editperfil');
    }

    /**
     * Actualizar perfil de usuario
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255|unique:users,email,' . $user->id,
            'avatar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'password'  => 'nullable|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // SUBIR ARCHIVO
        if ($request->hasFile('avatar')) {

            // borrar foto anterior
            if ($user->avatar && Storage::exists('public/adminAvatar/' . $user->avatar)) {
                Storage::delete('public/adminAvatar/' . $user->avatar);
            }

            // guardar nuevo avatar
            $imageName = time() . '.' . $request->avatar->extension();
            $request->avatar->storeAs('public/adminAvatar', $imageName);

            $user->avatar = $imageName;
        }

        // actualizar password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('perfil')->with('success', 'Perfil actualizado correctamente.');
    }


    /**
     * Eliminar avatar de usuario
     */
    public function deleteAvatar()
    {
        $user = Auth::user();

        if ($user->avatar && Storage::exists('public/adminAvatar/' . $user->avatar)) {
            Storage::delete('public/adminAvatar/' . $user->avatar);
        }

        $user->avatar = null;
        $user->save();

        return redirect()->route('perfil')->with('success', 'Tu avatar fue eliminado correctamente.');
    }
}
