<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inmueble;

class BuscadorController extends Controller
{
    public function buscar(Request $request)
    {
        $tipos = $request->input('tipos', []);  // array
        $q = $request->input('q');             // keyword

        $inmuebles = Inmueble::query()

            // FILTRO POR VARIOS TIPOS DE INMUEBLE
            ->when(!empty($tipos), function ($query) use ($tipos) {
                $query->whereHas('tipoInmueble', function ($q2) use ($tipos) {
                    $q2->whereIn('nombre', $tipos);
                });
            })

            // FILTRO POR MUNICIPIO + keyword
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {

                    $sub->where('titulo', 'LIKE', "%$q%")
                        ->orWhere('direccion', 'LIKE', "%$q%")
                        ->orWhere('descripcion', 'LIKE', "%$q%")

                        // 🔥 AQUI SE FILTRA POR MUNICIPIO CORRECTAMENTE
                        ->orWhereHas('barrio.municipio', function ($m) use ($q) {
                            $q = mb_strtolower($q);

                            $m->whereRaw("
                                LOWER(
                                    REPLACE(
                                    REPLACE(
                                    REPLACE(
                                    REPLACE(
                                    REPLACE(nombre, 'á', 'a'),
                                    'é', 'e'),
                                    'í', 'i'),
                                    'ó', 'o'),
                                    'ú', 'u')
                                )
                                LIKE ?
                            ", ["%$q%"]);
                        })

                        // 🔥 También filtra por nombre del barrio
                        ->orWhereHas('barrio', function ($b) use ($q) {
                            $b->where('nombre', 'LIKE', "%$q%");
                        });
                });
            })

            ->with(['barrio.municipio', 'tipoInmueble'])
            ->paginate(12);

        return view('busqueda.resultados', compact('inmuebles', 'q', 'tipos'));
    }
}
