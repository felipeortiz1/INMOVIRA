<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use App\Models\Inmueble;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagenController extends Controller
{
    // Mostrar lista de imágenes
    public function index()
    {
        $imagenes = Imagen::with('inmueble')->paginate(10);
        return view('imagenes.index', compact('imagenes'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        $inmuebles = Inmueble::all();
        return view('imagenes.create', compact('inmuebles'));
    }

    // Guardar nueva imagen
    public function store(Request $request)
    {
        $data = $request->validated();

        // Subir imagen si existe archivo
        if ($request->hasFile('ruta')) {
            $data['ruta'] = $request->file('ruta')->store('imagenes', 'public');
        }

        Imagen::create($data);

        return redirect()->route('imagenes.index')
            ->with('success', 'Imagen guardada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Imagen $imagen)
    {
        //
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $imagen = Imagen::findOrFail($id);
        $inmuebles = Inmueble::all();

        return view('imagenes.edit', compact('imagen', 'inmuebles'));
    }

    // Actualizar imagen existente
    public function update(Request $request, $id)
    {
        $imagen = Imagen::findOrFail($id);
        $data = $request->validated();

        // Reemplazar imagen si se sube una nueva
        if ($request->hasFile('ruta')) {
            if ($imagen->ruta && Storage::disk('public')->exists($imagen->ruta)) {
                Storage::disk('public')->delete($imagen->ruta);
            }
            $data['ruta'] = $request->file('ruta')->store('imagenes', 'public');
        }

        $imagen->update($data);

        return redirect()->route('imagenes.index')
            ->with('success', 'Imagen actualizada correctamente.');
    }

    // Eliminar imagen
    public function destroy($id)
    {
        $imagen = Imagen::findOrFail($id);

        if ($imagen->ruta && Storage::disk('public')->exists($imagen->ruta)) {
            Storage::disk('public')->delete($imagen->ruta);
        }

        $imagen->delete();

        return redirect()->route('imagenes.index')
            ->with('success', 'Imagen eliminada correctamente.');
    }
}
