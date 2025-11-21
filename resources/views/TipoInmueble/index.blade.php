@extends('layout.app')

@section('title', 'Tipos de Inmuebles')

@section('titleContent', 'Administrar Tipos de Inmuebles')

@section('content')
    <div class="container mt-4 animate-fade">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header text-white rounded-top-4"
                style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
                <h5 class="mb-0 fw-bold"><i class="fa-solid fa-warehouse"></i> Lista de Tipos de Inmuebles</h5>
            </div>

            <div class="card-body p-4">

                {{-- Botones superiores --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="{{ route('tipoInmueble.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                        <i class="fas fa-plus-circle"></i> Crear Tipo de Inmueble
                    </a>

                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>

                {{-- Tabla de tipos de inmuebles --}}
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center shadow-sm">
                        <thead class="table-primary">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tipoInmuebles as $tipoInmueble)
                                <tr>
                                    <td class="fw-semibold text-secondary">{{ $tipoInmueble->id }}</td>
                                    <td>{{ $tipoInmueble->nombre }}</td>
                                    <td>
                                        <a href="{{ route('tipoInmueble.edit', $tipoInmueble->id) }}"
                                            class="btn btn-sm btn-warning rounded-pill shadow-sm me-1">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>

                                        <form action="{{ route('tipoInmueble.destroy', $tipoInmueble->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger rounded-pill shadow-sm"
                                                onclick="confirmarEliminacion(event)">
                                                <i class="fas fa-trash-alt"></i> Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-muted py-3">
                                        <i class="fas fa-inbox fs-5"></i> No hay tipos de inmuebles registrados aún.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    {{-- Estilos personalizados --}}
    <style>
        .card {
            background-color: #fff;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        table thead tr {
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        table tbody tr:hover {
            background-color: #f9fafc;
        }

        th,
        td {
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

        .btn-outline-warning,
        .btn-outline-danger {
            border-radius: 30px;
            font-weight: 500;
        }
    </style>

    @if (session('success'))
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
