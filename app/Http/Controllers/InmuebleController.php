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
        $inmuebles = Inmueble::all();
        return view('inmuebles.index', compact('inmuebles'));
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
        $inmueble = Inmueble::with('imagens')->findOrFail($id);
        return response()->json($inmueble->imagens);
    }

    // Obtener detalles del inmueble
    public function obtenerDetalles($id)
    {
        $inmueble = Inmueble::with(['usuario', 'tipoInmueble', 'barrio'])
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
            'fechaPublicacion' => $inmueble->fechaPublicacion,
            'descripcion' => $inmueble->descripcion,
        ]);
    }


}
