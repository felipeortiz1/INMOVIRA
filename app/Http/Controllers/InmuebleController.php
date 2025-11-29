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
    // Lista de inmuebles con filtros avanzados y paginación.
    public function index(Request $request)
    {
        $query = Inmueble::query()->with(['usuario', 'barrio.municipio', 'tipoInmueble']);

        if ($request->filled('buscar')) {
            $term = $request->buscar;
            $query->where(function ($q) use ($term) {
                $q->where('titulo', 'LIKE', "%{$term}%")
                    ->orWhere('direccion', 'LIKE', "%{$term}%")
                    ->orWhereHas('usuario', function ($q2) use ($term) {
                        $q2->where('nombre', 'LIKE', "%{$term}%");
                    });
            });
        }

        if ($request->filled('municipio')) {
            $query->whereHas('barrio.municipio', function ($q) use ($request) {
                $q->where('id', $request->municipio);
            });
        }

        if ($request->filled('barrio')) {
            $query->where('idBarrio', $request->barrio);
        }

        if ($request->filled('tipoOferta')) {
            $query->where('tipoOferta', $request->tipoOferta);
        }

        if ($request->filled('estadoPublicacion')) {
            $query->where('estadoPublicacion', $request->estadoPublicacion);
        }

        if ($request->filled('usuario')) {
            $query->whereHas('usuario', function ($q) use ($request) {
                $q->where('nombre', 'LIKE', '%' . $request->usuario . '%');
            });
        }

        if ($request->filled('precio_min')) {
            $query->where('precio', '>=', $request->precio_min);
        }

        if ($request->filled('precio_max')) {
            $query->where('precio', '<=', $request->precio_max);
        }

        if ($request->filled('fecha_desde')) {
            $query->whereDate('fechaCreacion', '>=', $request->fecha_desde);
        }

        if ($request->filled('fecha_hasta')) {
            $query->whereDate('fechaCreacion', '<=', $request->fecha_hasta);
        }

        if ($request->sort === 'id') {
            $direction = $request->direction === 'desc' ? 'desc' : 'asc';
            $query->orderBy('id', $direction);
        }

        $inmuebles = $query->paginate(10)->withQueryString();

        $usuarios = Usuario::all();
        $municipios = Municipio::all();
        $barrios = Barrio::all();
        $tipos = TipoInmueble::all();

        return view('inmuebles.index', compact('inmuebles', 'usuarios', 'municipios', 'barrios', 'tipos'));
    }


    public function buscar(Request $request)
    {
        if (!$request->filled('q')) {
            return response()->json([]);
        }

        $term = $request->q;

        $resultados = Inmueble::with('usuario')
            ->where('titulo', 'LIKE', "%$term%")
            ->orWhere('direccion', 'LIKE', "%$term%")
            ->orWhereHas('usuario', function ($q) use ($term) {
                $q->where('nombre', 'LIKE', "%$term%");
            })
            ->limit(8)
            ->get();

        $data = $resultados->map(function ($i) {
            return [
                'id' => $i->id,
                'titulo' => $i->titulo,
                'direccion' => $i->direccion,
                'usuario_id' => $i->idUsuario ?? null,
                'usuario_nombre' => $i->usuario->nombre ?? null,
            ];
        });

        return response()->json($data);
    }


    public function create(Request $request)
    {
        $municipios = Municipio::all();
        $tipos = TipoInmueble::all();
        $usuarios = Usuario::all();
        $barrios = Barrio::select('id', 'nombre', 'idMunicipio')->get();

        return view('inmuebles.create', compact('barrios', 'tipos', 'usuarios', 'municipios'));
    }


    public function store(InmuebleRequest $request)
    {
        $inmueble = Inmueble::create($request->validated());

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $path = $imagen->store('inmuebles', 'public');
                Imagen::create([
                    'idInmueble' => $inmueble->id,
                    'ruta' => $path,
                    'url_imagen' => asset('storage/' . $path)
                ]);
            }
        }

        return redirect()->route('inmuebles.index')->with('success', 'Inmueble registrado correctamente.');
    }


    public function show($id)
    {
        $inmueble = Inmueble::with(['imagen', 'barrio', 'usuario', 'tipoInmueble'])->findOrFail($id);
        return view('inmuebles.show', compact('inmueble'));
    }


    public function edit($id)
    {
        $inmueble = Inmueble::with('imagens')->findOrFail($id);
        $municipios = Municipio::all();
        $barrios = Barrio::all();
        $tipos = TipoInmueble::all();
        $usuarios = Usuario::all();

        return view('inmuebles.edit', compact('inmueble', 'barrios', 'tipos', 'usuarios', 'municipios'));
    }


    public function update(InmuebleRequest $request, $id)
    {
        $inmueble = Inmueble::findOrFail($id);

        $inmueble->update([
            'titulo' => $request->titulo,
            'direccion' => $request->direccion,
            'idUsuario' => $request->idUsuario,
            'idTipoInmueble' => $request->idTipoInmueble,
            'tipoOferta' => $request->tipoOferta,
            'idMunicipio' => $request->idMunicipio,
            'idBarrio' => $request->idBarrio,
            'precio' => $request->precio,
            'area' => $request->area,
            'nHabitaciones' => $request->nHabitaciones,
            'nBaños' => $request->nBaños,
            'descripcion' => $request->descripcion,
            'estadoPublicacion' => $request->estadoPublicacion,
            'fechaPublicacion' => $request->fechaPublicacion,
        ]);

        if ($request->has('eliminar_imagenes')) {
            foreach ($request->eliminar_imagenes as $idImagen) {
                $imagen = Imagen::find($idImagen);
                if ($imagen) {
                    if (Storage::disk('public')->exists($imagen->ruta)) {
                        Storage::disk('public')->delete($imagen->ruta);
                    }
                    $imagen->delete();
                }
            }
        }

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $rutaImagen = $imagen->store('inmuebles', 'public');

                $inmueble->imagens()->create([
                    'ruta' => $rutaImagen,
                    'url_imagen' => asset('storage/' . $rutaImagen),
                    'idInmueble' => $inmueble->id,
                ]);
            }
        }

        return redirect()
            ->route('inmuebles.index')
            ->with('success', 'Inmueble actualizado correctamente.');
    }


    public function destroy($id)
    {
        $inmueble = Inmueble::with('imagens')->findOrFail($id);

        foreach ($inmueble->imagens as $imagen) {
            Storage::disk('public')->delete($imagen->ruta);
            $imagen->delete();
        }

        $inmueble->delete();

        return redirect()->route('inmuebles.index')->with('success', 'Inmueble e imágenes eliminados correctamente.');
    }


    public function obtenerImagenes($id)
    {
        $imagenes = Imagen::where('idInmueble', $id)->get();
        return response()->json($imagenes);
    }


    public function obtenerDetalles($id)
    {
        $inmueble = Inmueble::with(['usuario', 'tipoInmueble', 'barrio', 'imagens'])
            ->findOrFail($id);

        return response()->json([
            'id' => $inmueble->id,
            'titulo' => $inmueble->titulo,
            'direccion' => $inmueble->direccion,
            'tipoOferta' => $inmueble->tipoOferta,
            'tipo_inmueble' => $inmueble->tipoInmueble,
            'municipio' => $inmueble->barrio->municipio,
            'barrio' => $inmueble->barrio,
            'usuario' => $inmueble->usuario,
            'precio' => $inmueble->precio,
            'area' => $inmueble->area,
            'nBaños' => $inmueble->nBaños,
            'estadoPublicacion' => $inmueble->estadoPublicacion,
            'fechaPublicacion' => $inmueble->created_at->format('Y-m-d'),
            'descripcion' => $inmueble->descripcion,
            'imagenes' => $inmueble->imagens,
        ]);
    }


    public function vistaArriendoPublic(Request $request)
    {
        $query = Inmueble::where('tipoOferta', 'arriendo')
            ->with(['imagens', 'barrio.municipio', 'usuario']);

        if ($request->filled('tipo')) {
            $query->whereHas('tipoInmueble', function ($q) use ($request) {
                $q->where('nombre', $request->tipo);
            });
        }

        if ($request->filled('municipio')) {
            $query->whereHas('barrio.municipio', function ($q) use ($request) {
                $q->where('id', $request->municipio);
            });
        }

        if ($request->filled('barrio')) {
            $query->where('idBarrio', $request->barrio);
        }

        if ($request->filled('min')) {
            $query->where('precio', '>=', $request->min);
        }

        if ($request->filled('max')) {
            $query->where('precio', '<=', $request->max);
        }

        $inmuebles = $query->orderBy('created_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        $municipios = Municipio::all();
        $barrios = Barrio::all();

        return view('public.arriendo', compact('inmuebles', 'municipios', 'barrios'));
    }


    public function vistaVentaPublic(Request $request)
    {
        $query = Inmueble::where('tipoOferta', 'venta')
            ->with(['imagens', 'barrio.municipio', 'usuario', 'tipoInmueble']);

        if ($request->filled('q')) {
            $term = $request->q;
            $query->where(function($q) use ($term) {
                $q->where('titulo', 'LIKE', "%{$term}%")
                ->orWhere('direccion', 'LIKE', "%{$term}%")
                ->orWhereHas('usuario', function($q2) use ($term){
                    $q2->where('nombre', 'LIKE', "%{$term}%");
                });
            });
        }

        if ($request->filled('tipo')) {
            $query->whereHas('tipoInmueble', function ($q) use ($request) {
                $q->where('nombre', $request->tipo);
            });
        }

        if ($request->filled('municipio')) {
            $query->whereHas('barrio.municipio', function ($q) use ($request) {
                $q->where('id', $request->municipio);
            });
        }

        if ($request->filled('barrio')) {
            $query->where('idBarrio', $request->barrio);
        }

        if ($request->filled('min')) {
            $query->where('precio', '>=', $request->min);
        }

        if ($request->filled('max')) {
            $query->where('precio', '<=', $request->max);
        }

        $inmuebles = $query->orderBy('created_at', 'desc')->paginate(12)->withQueryString();

        $municipios = Municipio::all();
        $barrios = Barrio::all();

        return view('public.venta', compact('inmuebles', 'municipios', 'barrios'));
    }


    // 👉 NUEVO: Vista pública de inmobiliarias con buscador
    public function vistaInmobiliariasPublic(Request $request)
    {
        $query = Usuario::where('tipoUsuario', 'inmobiliaria');

        if ($request->filled('q')) {
            $term = $request->q;
            $query->where(function($q2) use ($term) {
                $q2->where('nombreEmpresa', 'LIKE', "%{$term}%")
                    ->orWhere('nombre', 'LIKE', "%{$term}%")
                    ->orWhere('email', 'LIKE', "%{$term}%")
                    ->orWhere('telefono', 'LIKE', "%{$term}%");
            });
        }

        $inmobiliarias = $query->orderBy('nombreEmpresa')->get();

        return view('public.inmobiliarias', compact('inmobiliarias'));
    }
}
