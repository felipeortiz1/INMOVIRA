<?php

namespace App\Http\Controllers;

use App\Models\Barrio;
use App\Models\Inmueble;
use Illuminate\Http\Request;
use App\Models\TipoInmueble;
use App\Http\Requests\InmuebleRequest;
use App\Models\Usuario;

class InmuebleController extends Controller
{
    // Mostrar lista de inmuebles
    public function index()
    {
        $inmuebles = Inmueble::with('barrio')->paginate(10);
        return view('inmuebles.index', compact('inmuebles'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        $barrios = Barrio::all();
        $tipos = TipoInmueble::all();
        $usuarios = Usuario::all(); 
        return view('inmuebles.create', compact('barrios', 'tipos', 'usuarios'));
    }

    // Guardar nuevo inmueble
    public function store(Request $request)
    {
        Inmueble::create($request->all()); 

        return redirect()->route('inmuebles.index')
            ->with('success', 'Inmueble registrado correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Inmueble $inmueble)
    {
        //
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $inmueble = Inmueble::findOrFail($id);
        $barrios = Barrio::all();
        $tipos = TipoInmueble::all();
        $usuarios = Usuario::all(); 

        return view('inmuebles.edit', compact('inmueble', 'barrios', 'tipos', 'usuarios'));
    }

    // Actualizar inmueble existente
    public function update(Request $request, $id)
    {
        $inmueble = Inmueble::findOrFail($id);
        $inmueble->update($request->all());

        return redirect()->route('inmuebles.index')
            ->with('success', 'Inmueble actualizado correctamente.');
    }

    // Eliminar inmueble
    public function destroy($id)
    {
        $inmueble = Inmueble::findOrFail($id);
        $inmueble->delete();

        return redirect()->route('inmuebles.index')
            ->with('success', 'Inmueble eliminado correctamente.');
    }
}
