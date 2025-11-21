<?php

namespace App\Http\Controllers;

use App\Models\Inmueble;
use Illuminate\Http\Request;

class BuscadorController extends Controller
{
    public function buscar(Request $request)
    {
        $tipo = $request->tipo;
        $q = $request->q;

        $inmuebles = Inmueble::query()
            ->when($tipo, function ($query) use ($tipo) {
                $query->whereHas('tipoInmueble', function ($sub) use ($tipo) {
                    $sub->where('nombre', $tipo);
                });
            })
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('titulo', 'LIKE', "%$q%")
                        ->orWhere('direccion', 'LIKE', "%$q%")
                        ->orWhere('descripcion', 'LIKE', "%$q%");
                });
            })
            ->with(['tipoInmueble', 'barrio'])
            ->paginate(12);

        return view('busqueda.resultados', compact('inmuebles', 'tipo', 'q'));
    }
}
