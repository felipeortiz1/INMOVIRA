@extends('layout.app')


@section('title')
Tipos de inmuebles
@endsection

@section('titleContent')
Administrar tipos de inmuebles
@endsection

@section('content')
<div>
    <a href="{{ route('tipoInmueble.create') }}" class="btn btn-primary mb-3"> + Crear tipo de inmueble </a>
    <div>
        <table class="table table-bordered text-center align-middle table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tipoInmuebles as $tipoInmueble)
                <tr>
                    <td>{{$tipoInmueble->id}}</td>
                    <td>{{$tipoInmueble->nombre}}</td>
                    <td>
                        <a href="{{ route('tipoInmueble.edit', $tipoInmueble->id) }}" class="btn btn-warning">Actualizar</a>
                        <form action="{{ route('tipoInmueble.destroy', $tipoInmueble->id) }}" method="POST" style="display:inline;">
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