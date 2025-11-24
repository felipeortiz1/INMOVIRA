@extends('layout.app')

@section('title', 'Localidades')

@section('titleContent', 'Administrar Localidades')

@section('content')
    <div class="container mt-4 animate-fade">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
                <h5 class="mb-0 fw-bold"><i class="fa-solid fa-mountain-city"></i> Lista de Municipios</h5>
            </div>

            {{-- FILTROS --}}
            <div class="mt-4 mb-4 p-4 border rounded bg-light shadow-sm">

                <form id="formFiltros" action="{{ route('municipios.index') }}" method="GET" class="row g-3">

                    {{-- BUSCAR --}}
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Buscar (municipio o Codigo Postal)</label>
                        <input type="text" id="buscador" name="buscar" class="form-control" autocomplete="off"
                            placeholder="Escribe para buscar...">
                        <div id="sugerencias" class="list-group position-absolute w-100 mt-1"
                            style="z-index: 1000; display: none;"></div>
                    </div>

                    {{-- BOTONES --}}
                    <div class="col-md-12 d-flex justify-content-end">
                        <button class="btn btn-primary me-3 px-4">
                            <i class="fas fa-filter"></i> Filtrar
                        </button>

                        <a href="{{ route('municipios.index') }}" class="btn btn-secondary px-4">
                            Limpiar filtros
                        </a>
                    </div>

                </form>

            </div>

            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="{{ route('municipios.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                        <i class="fas fa-plus-circle"></i> Crear Municipio
                    </a>

                    {{-- Botón filtro ID Asc - Desc --}}
                    @php
                        $query = request()->except('sort', 'direction');
                    @endphp

                    <a href="{{ route(
                        'municipios.index',
                        array_merge($query, [
                            'sort' => 'id',
                            'direction' => request('direction') === 'asc' ? 'desc' : 'asc',
                        ]),
                    ) }}"
                        class="btn btn-secondary rounded-pill px-4 shadow-sm mb-3">

                        @if (request('direction') === 'asc')
                            <i class="fas fa-sort-numeric-down-alt"></i> ID Descendente
                        @else
                            <i class="fas fa-sort-numeric-down"></i> ID Ascendente
                        @endif
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
                                    <td><span
                                            class="badge bg-light text-dark px-3 py-2">{{ $municipio->codigoPostal }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('municipios.edit', $municipio->id) }}"
                                            class="btn btn-sm btn-warning rounded-pill shadow-sm me-1">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        <form action="{{ route('municipios.destroy', $municipio->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger rounded-pill shadow-sm"
                                                onclick="confirmarEliminacion(event)">
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
                    {{-- Paginación --}}
                    <div class="d-flex justify-content-center mt-3">{{ $municipios->links('pagination::bootstrap-5') }}
                    </div>
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

        // Funcionalidad del buscador con sugerencias
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('buscador');
            const box = document.getElementById('sugerencias');

            input.addEventListener('keyup', function() {
                const query = this.value.trim();

                if (query.length < 1) {
                    box.style.display = 'none';
                    box.innerHTML = '';
                    return;
                }

                fetch("{{ route('municipios.buscar') }}?q=" + query)
                    .then(response => response.json())
                    .then(data => {
                        box.innerHTML = "";

                        if (data.length === 0) {
                            box.style.display = "none";
                            return;
                        }

                        data.forEach(municipios => {
                            const item = document.createElement('button');
                            item.type = "button";
                            item.classList.add('list-group-item', 'list-group-item-action');
                            item.innerHTML = `
                        <strong>${municipios.nombre}</strong><br>
                        <small>${municipios.codigoPostal}</small>
                    `;

                            // Al hacer clic se llena el input
                            item.addEventListener('click', function() {
                                input.value = municipios.nombre;
                                box.style.display = 'none';
                            });

                            box.appendChild(item);
                        });

                        box.style.display = "block";
                    })
                    .catch(error => console.error(error));
            });

            // Cerrar menú si se hace clic fuera
            document.addEventListener('click', function(e) {
                if (!input.contains(e.target) && !box.contains(e.target)) {
                    box.style.display = 'none';
                }
            });
        });
    </script>
@endsection
