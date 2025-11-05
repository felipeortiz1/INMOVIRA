@extends('layout.app')


@section('title')
Usuarios
@endsection

@section('titleContent')
Administrar Usuarios
@endsection

@section('content')
<div>
    <a href="{{ route('usuario.create') }}" class="btn btn-primary mb-3"> + Crear tipo de inmueble </a>
    <div>
        <table class="table table-bordered text-center align-middle table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>E-mail</th>
                    <td>Telefono</td>
                    <td>Tipo de Usuario</td>
                    <td>Nombre de la empresa</td>
                    <td>Fecha de registro</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                <tr>
                    <td>{{$usuario->id}}</td>
                    <td>{{$usuario->nombre}}</td>
                    <td>{{$usuario->email}}</td>
                    <td>{{$usuario->telefono}}</td>
                    <td>{{$usuario->tipoUsuario}}</td>
                    <td>{{$usuario->nombreEmpresa ?? 'No presenta empresa'}}</td>
                    <td>{{$usuario->fechaRegistro}}</td>
                    <td>
                        <a href="{{ route('usuario.edit', $usuario->id) }}" class="btn btn-warning">Actualizar</a>
                        <form action="{{ route('usuario.destroy', $usuario->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger" onclick="confirmarEliminacion(event)">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="col-12 text-center my-3">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary text-center mt-3">Volver</a>
        </div>
    </div>
</div>
@endsection

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: "{{ session('success') }}",
            confirmButtonText: 'Aceptar',
            timer: 10000
        });
    });
</script>
@endif

<script>
    function confirmarEliminacion(event) {
        event.preventDefault();
        const form = event.target.closest('form');

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script> 