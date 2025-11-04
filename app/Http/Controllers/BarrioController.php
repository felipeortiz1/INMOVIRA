<?php

namespace App\Http\Controllers;

use App\Models\Barrio;
use App\Models\Municipio;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class BarrioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barrios = Barrio::all();
        return view('Barrios.index', compact('barrios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $municipios = Municipio::all();
        return view('Barrios.create', compact('municipios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Barrio::create($request->all());
        return redirect()->route('barrios.index')
        ->with('success','Barrio creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barrio $barrio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $barrio = Barrio::findOrfail($id);
        $municipios = Municipio::all();
        return view('Barrios.edit', compact('barrio','municipios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $barrio = Barrio::findOrfail($id);
        $barrio->update($request->all());
        return redirect()->route('barrios.index')
        ->with('success','Barrio editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $barrio = Barrio::findOrfail($id);
            $barrio->delete();
            return redirect()->route('barrios.index')
            ->with('success','Barrio eliminado exitosamente');
    
        }catch(QueryException $e){
            if ($e->getCode() === '23000') { // Violación de restricción
            return redirect()->route('inmuebles.index')
                ->with('error', 'No se puede eliminar este barrio porque está asociado a otros registros.');
        }

        return redirect()->route('barrios.index')
            ->with('error', 'Error al eliminar el barrio.');
        }
    }
}