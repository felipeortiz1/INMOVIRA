<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inmueble;
use App\Models\Municipio;
use App\Models\Barrio;

class BuscadorController extends Controller
{
    public function buscar(Request $request)
    {
        $tipos        = $request->input('tipos', []);
        $q            = $request->input('q');
        $municipio_id = $request->input('municipio_id');
        $barrio_id    = $request->input('barrio_id');
        $precio_min   = $request->input('precio_min');
        $precio_max   = $request->input('precio_max');

        $inmuebles = Inmueble::query()

            // ✅ FILTRO POR TIPOS
            ->when(!empty($tipos), function ($query) use ($tipos) {
                $query->whereHas('tipoInmueble', function ($q2) use ($tipos) {
                    $q2->whereIn('nombre', $tipos);
                });
            })

            // ✅ FILTRO POR MUNICIPIO (Buscando directamente por idMunicipio en la tabla barrios)
            ->when($municipio_id, function ($query) use ($municipio_id) {
                $query->whereHas('barrio', function ($b) use ($municipio_id) {
                    $b->where('idMunicipio', $municipio_id);
                });
            })

            // ✅ FILTRO POR BARRIO
            ->when($barrio_id, function ($query) use ($barrio_id) {
                $query->where('barrio_id', $barrio_id);
            })

            // ✅ FILTRO POR PRECIO MÍNIMO
            ->when($precio_min, function ($query) use ($precio_min) {
                $query->where('precio', '>=', $precio_min);
            })

            // ✅ FILTRO POR PRECIO MÁXIMO
            ->when($precio_max, function ($query) use ($precio_max) {
                $query->where('precio', '<=', $precio_max);
            })

            // ✅ FILTRO POR TEXTO (BUSCADOR GENERAL)
            ->when($q, function ($query) use ($q) {
                $qMinus = mb_strtolower($q);

                $query->where(function ($sub) use ($q, $qMinus) {
                    $sub->where('titulo', 'LIKE', "%$q%")
                        ->orWhere('direccion', 'LIKE', "%$q%")
                        ->orWhere('descripcion', 'LIKE', "%$q%")

                        // BUSCAR MUNICIPIO POR TEXTO
                        ->orWhereHas('barrio.municipio', function ($m) use ($qMinus) {
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
                            ", ['%' . $qMinus . '%']);
                        })

                        // BUSCAR BARRIO POR TEXTO
                        ->orWhereHas('barrio', function ($b) use ($q) {
                            $b->where('nombre', 'LIKE', "%$q%");
                        });
                });
            })

            ->with(['barrio.municipio', 'tipoInmueble', 'usuario'])
            ->paginate(12)
            ->withQueryString();

        // ✅ MUNICIPIOS PARA EL SELECT
        $municipios = Municipio::orderBy('nombre')->get();

        // ✅ BARRIOS FILTRADOS (Corregido 'municipio_id' por 'idMunicipio' para evitar error 1054)
        $barrios = Barrio::when($municipio_id, function ($query) use ($municipio_id) {
            $query->where('idMunicipio', $municipio_id);
        })
        ->orderBy('nombre')
        ->get();

        return view('busqueda.resultados', compact(
            'inmuebles',
            'municipios',
            'barrios',
            'q',
            'tipos',
            'municipio_id',
            'barrio_id'
        ));
    }
}   