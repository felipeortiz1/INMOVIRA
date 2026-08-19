@extends('layout.app')

@section('title', 'Tipos de Inmuebles')

@section('titleContent', 'Administrar Tipos de Inmuebles')

@section('content')
    <div class="container-fluid px-4 py-4 animate-fade">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">

            <!-- Card Header Principal -->
            <div class="card-header bg-gradient-dark text-white p-4 border-0">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="header-icon-box bg-primary text-white rounded-3 p-3 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-warehouse fa-lg"></i>
                        </div>
                        <div>
                            <h4 class="mb-1 fw-bold text-white">Lista de Tipos de Inmuebles</h4>
                            <p class="mb-0 text-white-50 fs-7">Administra las categorías y clasificaciones de propiedades en el sistema</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">

                <!-- BARRA DE ACCIONES SUPERIORES -->
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                    <a href="{{ route('tipoInmueble.create') }}" class="btn btn-success rounded-pill px-4 py-2 shadow-sm fw-semibold">
                        <i class="fas fa-plus-circle me-1"></i> Crear Tipo de Inmueble
                    </a>

                    <a href="{{ route('dashboard') }}" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-medium shadow-sm">
                        <i class="fas fa-arrow-left me-1"></i> Volver
                    </a>
                </div>

                <!-- TABLA DE TIPOS DE INMUEBLE -->
                <div class="table-responsive rounded-3 border">
                    <table class="table table-hover align-middle mb-0 text-center custom-table">
                        <thead class="bg-light border-bottom">
                            <tr>
                                <th class="text-secondary text-uppercase fs-7 fw-bold py-3" style="width: 100px;">ID</th>
                                <th class="text-secondary text-uppercase fs-7 fw-bold py-3 text-start ps-4">Nombre</th>
                                <th class="text-secondary text-uppercase fs-7 fw-bold py-3" style="width: 150px;">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($tipoInmuebles as $tipoInmueble)
                                <tr>
                                    <td class="fw-bold text-muted">#{{ $tipoInmueble->id }}</td>
                                    <td class="text-start ps-4 fw-bold text-dark">{{ $tipoInmueble->nombre }}</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            <a href="{{ route('tipoInmueble.edit', $tipoInmueble->id) }}"
                                                class="btn btn-sm btn-outline-warning rounded-circle action-btn"
                                                title="Editar">
                                                <i class="fas fa-pen"></i>
                                            </a>

                                            <form action="{{ route('tipoInmueble.destroy', $tipoInmueble->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle action-btn"
                                                    onclick="confirmarEliminacion(event)" title="Eliminar">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-muted py-5">
                                        <div class="py-3">
                                            <i class="fas fa-inbox display-6 text-light-gray d-block mb-3"></i>
                                            <span class="fw-medium">No hay tipos de inmuebles registrados aún.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    {{-- ESTILOS EXCLUSIVOS DE LA VISTA --}}
    <style>
        .bg-gradient-dark {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        }

        .fs-7 { font-size: 0.8rem; }

        .custom-table tbody tr {
            transition: all 0.2s ease;
        }

        .custom-table tbody tr:hover {
            background-color: #f8fafc;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .text-light-gray { color: #cbd5e1; }

        .animate-fade {
            animation: fadeIn 0.4s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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