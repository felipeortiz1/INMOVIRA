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
        // Base: cargamos relaciones necesarias para mostrar en la tabla
        $query = Inmueble::query()->with(['usuario', 'barrio.municipio', 'tipoInmueble']);

        // Búsqueda libre por título, dirección o nombre de usuario
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

        // Filtrar por municipio (vía relación barrio->municipio)
        if ($request->filled('municipio')) {
            $query->whereHas('barrio.municipio', function ($q) use ($request) {
                $q->where('id', $request->municipio);
            });
        }

        // Filtrar por barrio (id)
        if ($request->filled('barrio')) {
            $query->where('idBarrio', $request->barrio);
        }

        // Filtrar por tipo de oferta
        if ($request->filled('tipoOferta')) {
            $query->where('tipoOferta', $request->tipoOferta);
        }

        // Filtrar por estado de publicación
        if ($request->filled('estadoPublicacion')) {
            $query->where('estadoPublicacion', $request->estadoPublicacion);
        }

        // Filtrar por usuario creador (por nombre)
        if ($request->filled('usuario')) {
            $query->whereHas('usuario', function ($q) use ($request) {
                $q->where('nombre', 'LIKE', '%' . $request->usuario . '%');
            });
        }

        // Rango de precio
        if ($request->filled('precio_min')) {
            $query->where('precio', '>=', $request->precio_min);
        }
        if ($request->filled('precio_max')) {
            $query->where('precio', '<=', $request->precio_max);
        }

        // Fecha de creacion (rango o exacta) - usamos columna fechaCreacion de la migracion
        if ($request->filled('fecha_desde')) {
            $query->whereDate('fechaCreacion', '>=', $request->fecha_desde);
        }
        if ($request->filled('fecha_hasta')) {
            $query->whereDate('fechaCreacion', '<=', $request->fecha_hasta);
        }

        // ORDENAR POR ID ASC | DESC
        if ($request->sort === 'id') {
            $direction = $request->direction === 'desc' ? 'desc' : 'asc';
            $query->orderBy('id', $direction);
        }

        // PAGINACIÓN (mantiene query string para conservar filtros)
        $inmuebles = $query->paginate(10)->withQueryString();

        // Datos para selects en la vista
        $usuarios = Usuario::all();
        $municipios = Municipio::all();
        $barrios = Barrio::all();
        $tipos = TipoInmueble::all();

        return view('inmuebles.index', compact('inmuebles', 'usuarios', 'municipios', 'barrios', 'tipos'));
    }

    /**
     * Autocompletado: buscar inmuebles por título/dirección o usuario.
     * Devuelve JSON con los campos que usa el JS para autollenar.
     */
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

        // Mapear a estructura sencilla que el JS espera
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


    // Mostrar formulario de creación
    public function create(Request $request)
    {
        $municipios = Municipio::all();
        $tipos = TipoInmueble::all();
        $usuarios = Usuario::all();
        $barrios = Barrio::select('id', 'nombre', 'idMunicipio')->get();

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
                    'idInmueble' => $inmueble->id,
                    'ruta' => $path,
                    'url_imagen' => asset('storage/' . $path)
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
        // 1️⃣ Buscar el inmueble
        $inmueble = Inmueble::findOrFail($id);

        // 2️⃣ Actualizar los campos principales
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

        // 3️⃣ Eliminar imágenes seleccionadas (si el usuario marcó alguna)
        if ($request->has('eliminar_imagenes')) {
            foreach ($request->eliminar_imagenes as $idImagen) {
                $imagen = Imagen::find($idImagen);
                if ($imagen) {
                    // Borrar el archivo físico si existe
                    if (Storage::disk('public')->exists($imagen->ruta)) {
                        Storage::disk('public')->delete($imagen->ruta);
                    }
                    // Eliminar registro de la base de datos
                    $imagen->delete();
                }
            }
        }

        // 4️⃣ Subir nuevas imágenes (si se enviaron)
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $rutaImagen = $imagen->store('inmuebles', 'public');

                $inmueble->imagens()->create([
                    'ruta' => $rutaImagen,
                    'url_imagen' => asset('storage/' . $rutaImagen),
                    'idInmueble' => $inmueble->id, // 👈 Esto garantiza la relación
                ]);
            }
        }

        // 5️⃣ Redirigir con mensaje de éxito
        return redirect()
            ->route('inmuebles.index')
            ->with('success', 'Inmueble actualizado correctamente.');
    }

    // Eliminar inmueble
    public function destroy($id)
    {
        $inmueble = Inmueble::with('imagens')->findOrFail($id);

        // eliminar archivos físicos y registros de imagen
        foreach ($inmueble->imagens as $imagen) {
            Storage::disk('public')->delete($imagen->ruta);
            $imagen->delete();
        }

        $inmueble->delete();

        return redirect()->route('inmuebles.index')->with('success', 'Inmueble e imágenes eliminados correctamente.');
    }

    // Obtener imagenes de un inmueble
    public function obtenerImagenes($id)
    {
        $imagenes = Imagen::where('idInmueble', $id)->get();
        return response()->json($imagenes);
    }

    // Obtener detalles del inmueble
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
            'barrio' => $inmueble->barrio,
            'usuario' => $inmueble->usuario,
            'precio' => $inmueble->precio,
            'area' => $inmueble->area,
            'nBaños' => $inmueble->nBaños,
            'estadoPublicacion' => $inmueble->estadoPublicacion,
            'fechaPublicacion' => $inmueble->created_at->format('Y-m-d'),
            'descripcion' => $inmueble->descripcion,
            'imagenes' => $inmueble->imagens, // <- IMPORTANTE
        ]);
    }


    public function vistaArriendoPublic()
    {
        $inmuebles = Inmueble::where('tipoOferta', 'arriendo')
            ->with(['imagens', 'barrio', 'tipoInmueble'])
            ->get();

        return view('public.arriendo', compact('inmuebles'));

    }

    public function vistaVentaPublic()
    {
        $inmuebles = Inmueble::where('tipoOferta', 'venta')
            ->with(['imagens', 'barrio', 'tipoInmueble'])
            ->get();

        return view('public.venta', compact('inmuebles'));

    }

}
