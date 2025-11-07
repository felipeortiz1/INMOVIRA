<?php

namespace App\Http\Controllers;

use App\Models\Barrio;
use App\Models\Inmueble;
use Illuminate\Http\Request;
use App\Models\TipoInmueble;
use App\Http\Requests\InmuebleRequest;
use App\Models\Imagen;
use App\Models\Municipio;
use App\Models\Usuario;
use Illuminate\Support\Facades\Storage;

class InmuebleController extends Controller
{
    // Mostrar lista de inmuebles
    public function index()
    {
        $inmuebles = Inmueble::with('barrio', 'usuario', 'tipoInmueble', 'imagens')->paginate(10);
        return view('inmuebles.index', compact('inmuebles'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        $municipios = Municipio::all();
        $barrios = Barrio::all();
        $tipos = TipoInmueble::all();
        $usuarios = Usuario::all();
        return view('inmuebles.create', compact('barrios', 'tipos', 'usuarios', 'municipios'));
    }

    // Guardar nuevo inmueble
    public function store(InmuebleRequest $request)
    {
        // Crear inmueble con datos validados
        $inmueble = Inmueble::create($request->validated());

        // Guardar imágenes
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $path = $imagen->store('inmuebles', 'public');
                Imagen::create([
                    'idInmueble' => $inmueble->idInmueble,
                    'url_imagen' => $path
                ]);
            }
        }

        return redirect()->route('inmuebles.index')->with('success', 'Inmueble registrado correctamente.');
    }


    // Mostrar detalles de un inmueble
    public function show($id)
    {
        // Retorna la vista parcial con el contenido del inmueble (no JSON)
        $inmueble = Inmueble::with(['imagen', 'barrio', 'usuario', 'tipoInmueble'])->findOrFail($id);
        return view('inmuebles.show', compact('inmueble'));
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $inmueble = Inmueble::with('imagens')->findOrFail($id);
        $municipios = Municipio::all();
        $barrios = Barrio::all();
        $tipos = TipoInmueble::all();
        $usuarios = Usuario::all();

        return view('inmuebles.edit', compact('inmueble', 'barrios', 'tipos', 'usuarios', 'municipios'));
    }

    // Actualizar inmueble existente
    public function update(InmuebleRequest $request, $id)
    {
        $inmueble = Inmueble::findOrFail($id);
        $inmueble->update($request->validated());

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagens') as $imagen) {
                $path = $imagen->store('inmuebles', 'public');
                Imagen::create([
                    'id_inmueble' => $inmueble->id_inmueble,
                    'url_imagen' => $path
                ]);
            }
        }

        return redirect()->route('inmuebles.index')->with('success', 'Inmueble actualizado correctamente.');
    }

    // Eliminar inmueble
    public function destroy($id)
    {
        $inmueble = Inmueble::with('imagenes')->findOrFail($id);

        // eliminar archivos físicos y registros de imagen
        foreach ($inmueble->imagenes as $imagen) {
            Storage::disk('public')->delete($imagen->url_imagen);
            $imagen->delete();
        }

        $inmueble->delete();

        return redirect()->route('inmuebles.index')->with('success', 'Inmueble e imágenes eliminados correctamente.');
    }

    // Obtener imagenes de un inmueble
    public function getImagenes($id)
    {
        $inmueble = Inmueble::with('imagenes')->findOrFail($id);
        return response()->json($inmueble->imagenes);
    }
}
