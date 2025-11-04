<?php

namespace App\Http\Controllers;

use App\Models\Barrio;
use App\Models\Inmueble;
use Illuminate\Http\Request;
use App\Models\TipoInmueble;
use App\Http\Requests\InmuebleRequest;

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
        return view('inmuebles.create', compact('barrios', 'tipos'));
    }

    // Guardar nuevo inmueble
    public function store(Request $request)
    {
        $data = $request->all();
        $data['id_usuario'] = 1;

        Inmueble::create($data); 

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

        return view('inmuebles.edit', compact('inmueble', 'barrios', 'tipos'));
    }

    // Actualizar inmueble existente
    public function update(Request $request, $id)
    {
        Inmueble::findOrFail($id)->update($request->validated());

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
