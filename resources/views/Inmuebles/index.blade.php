@extends('layout.app')

@section('title')
Inmuebles
@endsection

@section('titleContent')
Administrar Inmuebles
@endsection

@section('content')
<div>
    <a href="{{ route('inmuebles.create') }}" class="btn btn-primary mb-3"> + Crear Inmueble </a>
    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Dirección</th>
                    <th>Tipo Oferta</th>
                    <th>Precio</th>
                    <th>Área (m²)</th>
                    <th>Habitaciones</th>
                    <th>Baños</th>
                    <th>Parqueaderos</th>
                    <th>Estado</th>
                    <th>Fecha Publicación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inmuebles as $inmueble)
                <tr>
                    <td>{{ $inmueble->id }}</td>
                    <td>{{ $inmueble->titulo }}</td>
                    <td>{{ $inmueble->direccion }}</td>
                    <td>{{ ucfirst($inmueble->tipoOferta) }}</td>
                    <td>
                        @if($inmueble->precio)
                            ${{ number_format($inmueble->precio, 2, ',', '.') }}
                        @else
                            <span class="text-muted">No aplica</span>
                        @endif
                    </td>
                    <td>{{ $inmueble->area ?? '—' }}</td>
                    <td>{{ $inmueble->nHabitaciones ?? '—' }}</td>
                    <td>{{ $inmueble->nBaños ?? '—' }}</td>
                    <td>{{ $inmueble->nParqueaderos ?? '—' }}</td>
                    <td>
                        <span class="badge 
                            @if($inmueble->estadoPublicacion == 'activa') bg-success 
                            @elseif($inmueble->estadoPublicacion == 'inactiva') bg-secondary 
                            @else bg-danger @endif">
                            {{ ucfirst($inmueble->estadoPublicacion) }}
                        </span>
                    </td>
                    <td>{{ $inmueble->fechaPublicacion ? $inmueble->fechaPublicacion->format('d/m/Y') : '—' }}</td>
                    <td>
                        <a href="{{ route('inmuebles.edit', $inmueble->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('inmuebles.destroy', $inmueble->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" onclick="confirmarEliminacion(event)">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="col-12 text-center my-3">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Volver</a>
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
            timer: 6000
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
            text: "¡Esta acción eliminará el inmueble de forma permanente!",
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
