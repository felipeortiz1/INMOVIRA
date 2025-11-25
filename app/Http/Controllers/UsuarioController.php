<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Usuario::query();

        // BUSCAR POR NOMBRE O EMAIL
        if ($request->filled('buscar')) {
            $query->where(function ($q) use ($request) {
                $q->where('nombre', 'LIKE', '%' . $request->buscar . '%')
                    ->orWhere('email', 'LIKE', '%' . $request->buscar . '%');
            });
        }

        // FILTRAR POR TIPO DE USUARIO
        if ($request->filled('tipoUsuario')) {
            $query->where('tipoUsuario', $request->tipoUsuario);
        }

        // FILTRO POR FECHAS
        if ($request->filled('fechaInicio')) {
            $query->whereDate('fechaRegistro', '>=', $request->fechaInicio);
        }

        if ($request->filled('fechaFin')) {
            $query->whereDate('fechaRegistro', '<=', $request->fechaFin);
        }

        // ORDENAR POR ID ASC | DESC
        if ($request->sort === 'id') {
            $direction = $request->direction === 'desc' ? 'desc' : 'asc';
            $query->orderBy('id', $direction);
        }

        // Mantener filtros en paginación
        $usuarios = $query->paginate(10)->appends($request->all());

        return view('Usuarios.index', compact('usuarios'));
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

        $usuarios = Usuario::where('nombre', 'LIKE', "%$term%")
            ->orWhere('email', 'LIKE', "%$term%")
            ->limit(10)
            ->get(['id', 'nombre', 'email']);

        return response()->json($usuarios);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Usuario::create($request->all());
        return redirect()->route('usuario.index')->with('success', 'Usuario registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $usuario = Usuario::findOrfail($id);
        return view('Usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrfail($id);
        $usuario->update($request->all());
        return redirect()->route('usuario.index')->with('success', 'Usuario actualizado correctamente');
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

    public function inmobiliariasVista()
    {
        $inmobiliarias = Usuario::where('tipoUsuario', 'inmobiliaria')->get();
        return view('inmobiliarias.vista', compact('inmobiliarias'));
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
    ]);
}


}
