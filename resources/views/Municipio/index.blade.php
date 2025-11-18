@extends('layout.app')

@section('title', 'Localidades')

@section('titleContent', 'Administrar Localidades')

@section('content')
<div class="container mt-4 animate-fade">
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-header bg-gradient text-white rounded-top-4" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
            <h5 class="mb-0 fw-bold"><i class="fas fa-map-marked-alt"></i> Lista de Localidades</h5>
        </div>
        <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('municipios.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                    <i class="fas fa-plus-circle"></i> Crear Municipio
                </a>

                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center shadow-sm">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Código Postal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($municipios as $municipio)
                        <tr>
                            <td class="fw-semibold text-secondary">{{ $municipio->id }}</td>
                            <td>{{ $municipio->nombre }}</td>
                            <td><span class="badge bg-light text-dark px-3 py-2">{{ $municipio->codigoPostal }}</span></td>
                            <td>
                                <a href="{{ route('municipios.edit', $municipio->id) }}" class="btn btn-sm btn-warning rounded-pill shadow-sm me-1">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('municipios.destroy', $municipio->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger rounded-pill shadow-sm" onclick="confirmarEliminacion(event)">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-muted py-3">No hay municipios registrados aún.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
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
