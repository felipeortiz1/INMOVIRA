<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Models\Inmueble;
use App\Models\Municipio;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Usuario::query()

            // BUSCAR por nombre o empresa
            ->when($request->buscar, function ($q) use ($request) {
                $q->where(function ($query) use ($request) {
                    $query->where('nombre', 'like', "%{$request->buscar}%")
                        ->orWhere('nombreEmpresa', 'like', "%{$request->buscar}%");
                });
            })

            // FILTRO municipio
            ->when(
                $request->municipio,
                fn($q) =>
                $q->where('idMunicipio', $request->municipio)
            )

            // FILTRO tipo
            ->when(
                $request->tipoUsuario,
                fn($q) =>
                $q->where('tipoUsuario', $request->tipoUsuario)
            )

            ->with('municipio');

        // ✅ ORDENAMIENTO POR ID (ASC o DESC)
        if ($request->sort === 'id') {
            $direction = $request->direction === 'desc' ? 'desc' : 'asc';
            $query->orderBy('id', $direction);
        }

        $usuarios = $query->paginate(10)->appends($request->all());

        // Para el filtro de municipios
        $municipios = Municipio::orderBy('nombre')->get();

        return view('Usuarios.index', compact('usuarios', 'municipios'));
    }

    /**
     * Buscar usuarios para completar automaticamente.
     */
    public function buscar(Request $request)
    {
        $query = $request->q;
        $municipio = $request->municipio;

        $usuarios = Usuario::with('municipio')
            ->where(function ($q) use ($query) {
                $q->where('nombre', 'like', "%$query%")
                    ->orWhere('nombreEmpresa', 'like', "%$query%");
            })
            ->when($municipio, fn($q) => $q->where('idMunicipio', $municipio))
            ->limit(8)
            ->get();

        return response()->json($usuarios);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $municipios = Municipio::all();
        return view('Usuarios.create', compact('municipios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsuarioRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $name = time() . '_' . $file->getClientOriginalName();

            // Se guarda en storage/app/public/usuarios
            $path = $file->storeAs('usuarios', $name, 'public');

            $data['imagen'] = $path;
        }

        Usuario::create($data);

        return redirect()
            ->route('usuario.index')
            ->with('success', 'Usuario registrado correctamente');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $usuario = Usuario::findOrfail($id);
        $municipios = Municipio::all();

        return view('Usuarios.edit', compact('usuario', 'municipios'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UsuarioRequest $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        $data = $request->all();

        // ✅ Si marcó eliminar imagen
        if ($request->filled('eliminar_imagen') && $usuario->imagen) {
            Storage::disk('public')->delete($usuario->imagen);
            $data['imagen'] = null;
        }

        // ✅ Si subió nueva imagen
        if ($request->hasFile('imagen')) {

            // Eliminar la anterior si existe
            if ($usuario->imagen) {
                Storage::disk('public')->delete($usuario->imagen);
            }

            $file = $request->file('imagen');
            $name = time() . '_' . $file->getClientOriginalName();

            $path = $file->storeAs('usuarios', $name, 'public');

            $data['imagen'] = $path;
        }

        $usuario->update($data);

        return redirect()
            ->route('usuario.index')
            ->with('success', 'Usuario actualizado correctamente');
    }






    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);

        if ($usuario->inmuebles()->count() > 0) {
            return redirect()->route('usuario.index')
                ->with('error', 'No se puede eliminar este usuario porque tiene inmuebles asociados.');
        }

        $usuario->delete();

        return redirect()->route('usuario.index')
            ->with('success', 'Usuario eliminado correctamente');
    }

    public function inmobiliariasVista(Request $request)
    {
        $query = Usuario::where('tipoUsuario', 'inmobiliaria');

        // 🔍 Filtro por texto
        if ($request->filled('q')) {
            $t = $request->q;

            $query->where(function ($q) use ($t) {
                $q->where('nombreEmpresa', 'LIKE', "%{$t}%")
                    ->orWhere('nombre', 'LIKE', "%{$t}%")
                    ->orWhere('email', 'LIKE', "%{$t}%")
                    ->orWhere('telefono', 'LIKE', "%{$t}%");
            });
        }

        //Filtro por municipio (CORREGIDO)
        if ($request->filled('municipio')) {
            $query->where('idMunicipio', $request->municipio);
        }

        $inmobiliarias = $query->get();

        // Municipios para el select
        $municipios = Municipio::all();

        return view('inmobiliarias.vista', compact('inmobiliarias', 'municipios'));
    }

    public function detallesInmobiliaria($id)
    {
        $inm = Usuario::findOrFail($id);

        return response()->json([
            'id' => $inm->id,
            'nombreEmpresa' => $inm->nombreEmpresa,
            'nombre' => $inm->nombre,
            'email' => $inm->email,
            'telefono' => $inm->telefono,
            'direccion' => $inm->direccion,
            'imagen' => $inm->imagen
                ? asset('storage/' . $inm->imagen)
                : asset('storage/inmobiliarias/default.png'),

        ]);
    }


    public function detalles($id)
    {
        $user = Usuario::findOrFail($id);

        return response()->json([
            'id' => $user->id,
            'nombreEmpresa' => $user->nombreEmpresa,
            'nombre' => $user->nombre,
            'email' => $user->email,
            'telefono' => $user->telefono,
            'direccion' => $user->direccion,
        ]);
    }

    public function verInmobiliaria($id)
    {
        $inmobiliaria = Usuario::findOrFail($id);

        return view('Inmobiliarias.detalle', compact('inmobiliaria'));
    }

    public function buscarInmuebles(Request $request)
    {
        $tipo = $request->input('tipo');
        $municipio = $request->input('municipio');

        $inmuebles = Inmueble::query();

        // Filtro por tipo
        if ($tipo) {
            $inmuebles->where('tipo', 'LIKE', "%{$tipo}%");
        }

        // Filtro por municipio
        if ($municipio) {
            $inmuebles->where('municipio', 'LIKE', "%{$municipio}%");
        }


        $inmuebles = $inmuebles->latest()->get();

        return view('buscador.resultados', compact('inmuebles'));
    }


    public function inmuebles($id)
    {
        $usuario = Usuario::with([
            'inmuebles.municipio',
            'inmuebles.barrio',
            'inmuebles.tipoInmueble'
        ])->findOrFail($id);

        $inmuebles = $usuario->inmuebles;

        return view('usuarios.inmuebles', compact('usuario', 'inmuebles'));
    }
}
