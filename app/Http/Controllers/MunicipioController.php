<?php

namespace App\Http\Controllers;

use App\Http\Requests\MunicipioRequest;
use App\Models\Municipio;
use Illuminate\Http\Request;

class MunicipioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Municipio::query();

        // BUSCAR POR NOMBRE O CÓDIGO POSTAL
        if ($request->filled('buscar')) {
            $query->where(function ($q) use ($request) {
                $q->where('nombre', 'LIKE', '%' . $request->buscar . '%')
                    ->orWhere('codigoPostal', 'LIKE', '%' . $request->buscar . '%');
            });
        }

        // ORDENAR POR ID ASC | DESC
        if ($request->sort === 'id') {
            $direction = $request->direction === 'desc' ? 'desc' : 'asc';
            $query->orderBy('id', $direction);
        }

        // Mantener filtros en paginación
        $municipios = $query->paginate(6)->appends($request->all());

        return view('Municipio.index', compact('municipios'));
    }

    /**
     * Buscar usuarios para completar automaticamente.
     */
    public function buscar(Request $request)
    {
        if (!$request->filled('q')) {
            return response()->json([]);
        }

        $term = $request->q;

        $municipios = Municipio::where('nombre', 'LIKE', "%$term%")
            ->orWhere('codigoPostal', 'LIKE', "%$term%")
            ->limit(6)
            ->get(['id', 'nombre', 'codigoPostal']);

        return response()->json($municipios);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Municipio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MunicipioRequest $request)
    {
        Municipio::create($request->all());
        return redirect()->route('municipios.index')
            ->with('success', 'Municipio Creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Municipio $municipio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $municipio = Municipio::findOrfail($id);
        return view('Municipio.edit', compact('municipio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MunicipioRequest $request, $id)
    {
        $municipio = Municipio::findOrfail($id);
        $municipio->update($request->all());
        return redirect()->route('municipios.index')->with('success', 'Municipio actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $municipio = Municipio::findOrFail($id);

        if ($municipio->barrios()->count() > 0) {
            return redirect()->route('municipios.index')
                ->with('error', 'No se puede eliminar este municipio porque tiene barrios asociados.');
        }

        $municipio->delete();

        return redirect()->route('municipios.index')
            ->with('success', 'Municipio eliminado exitosamente');
    }
}
