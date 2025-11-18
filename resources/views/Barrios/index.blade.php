@extends('layout.app')

@section('title', 'Barrios')
@section('titleContent', 'Administrar Barrios')

@section('content')
<div class="container-fluid mt-3">

    <!-- Encabezado y botón -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-dark mb-0"><i class="fas fa-city me-2"></i>Listado de Barrios</h4>
        <a href="{{ route('barrios.create') }}" class="btn btn-primary shadow-sm px-4 py-2">
            <i class="fas fa-plus-circle me-1"></i> Crear Barrio
        </a>
    </div>

    <!-- Card envolvente -->
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Municipio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barrios as $barrio)
                        <tr>
                            <td class="fw-semibold">{{ $barrio->id }}</td>
                            <td>{{ $barrio->nombre }}</td>
                            <td>{{ $barrio->municipios->nombre }}</td>
                            <td>
                                <a href="{{ route('barrios.edit', $barrio->id) }}" 
                                    class="btn btn-outline-warning btn-sm px-3 me-2">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('barrios.destroy', $barrio->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm px-3"
                                            onclick="confirmarEliminacion(event)">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Botón volver -->
    <div class="text-center mt-4">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary shadow-sm px-4 py-2">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
    </div>
</div>

<style>
    .card {
        background-color: #fff;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease-in-out;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    table thead tr {
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    table tbody tr:hover {
        background-color: #f9fafc;
    }

    th, td {
        padding: 1rem 1.2rem !important;
        vertical-align: middle !important;
    }

    .btn-outline-warning:hover {
        background-color: #ffc107;
        color: white;
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
    }

    .btn-outline-warning, .btn-outline-danger {
        border-radius: 30px;
        font-weight: 500;
    }
</style>

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: "{{ session('success') }}",
            confirmButtonText: 'Aceptar',
            timer: 5000
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
        text: "¡No podrás revertir esta acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) form.submit();
    });
}
</script>
@endsection
