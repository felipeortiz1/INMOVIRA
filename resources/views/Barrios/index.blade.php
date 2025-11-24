@extends('layout.app')

@section('title', 'Barrios')
@section('titleContent', 'Administrar Barrios')

@section('content')
    <div class="container-fluid mt-3">
        <div class="container mt-4 animate-fade">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header text-white rounded-top-4"
                    style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
                    <h5 class="mb-0 fw-bold"><i class="fa-solid fa-map-pin"></i> Lista de Barrios</h5>
                </div>

                {{-- FILTROS --}}
                <div class="mt-4 mb-4 p-4 border rounded bg-light shadow-sm">

                    <form id="formFiltros" action="{{ route('barrios.index') }}" method="GET" class="row g-3">

                        {{-- BUSCAR --}}
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Buscar (Barrio o su Municipio)</label>
                            <input type="text" id="buscador" name="buscar" class="form-control" autocomplete="off"
                                placeholder="Escribe para buscar...">
                            <div id="sugerencias" class="list-group position-absolute w-100 mt-1"
                                style="z-index: 1000; display: none;"></div>
                        </div>

                        {{-- SELECT MUNICIPIO --}}
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Municipio</label>
                            <select name="municipio" class="form-select">
                                <option value=""> Seleccionar </option>

                                @foreach ($municipios as $m)
                                    <option value="{{ $m->id }}"
                                        {{ request('municipio') == $m->id ? 'selected' : '' }}>
                                        {{ $m->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- BOTONES --}}
                        <div class="col-md-12 d-flex justify-content-end">
                            <button class="btn btn-primary me-3 px-4">
                                <i class="fas fa-filter"></i> Filtrar
                            </button>

                            <a href="{{ route('barrios.index') }}" class="btn btn-secondary px-4">
                                Limpiar filtros
                            </a>
                        </div>

                    </form>

                </div>

                <div class="card-body p-4">

                    {{-- Botones superiores --}}
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <a href="{{ route('barrios.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                            <i class="fas fa-plus-circle"></i> Crear Barrio
                        </a>

                        {{-- Botón filtro ID Asc - Desc --}}
                        @php
                            $query = request()->except('sort', 'direction');
                        @endphp

                        <a href="{{ route(
                            'barrios.index',
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

                    {{-- Tabla de Municipios --}}
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center shadow-sm">
                            <thead class="table-primary">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Municipio</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barrios as $barrio)
                                    <tr>
                                        <td class="fw-semibold">{{ $barrio->id }}</td>
                                        <td>{{ $barrio->nombre }}</td>
                                        <td>{{ $barrio->municipio->nombre }}</td>
                                        <td>
                                            <a href="{{ route('barrios.edit', $barrio->id) }}"
                                                class="btn btn-sm btn-warning rounded-pill shadow-sm me-1">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <form action="{{ route('barrios.destroy', $barrio->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger rounded-pill shadow-sm"
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
                    {{-- Paginación --}}
                    <div class="d-flex justify-content-center mt-3">{{ $barrios->links('pagination::bootstrap-5') }}</div>
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

                    fetch("{{ route('barrios.buscar') }}?q=" + query + "&municipio=" + document.querySelector('select[name=municipio]').value)
                        .then(response => response.json())
                        .then(data => {
                            box.innerHTML = "";

                            if (data.length === 0) {
                                box.style.display = "none";
                                return;
                            }

                            data.forEach(barrios => {
                                const item = document.createElement('button');
                                item.type = "button";
                                item.classList.add('list-group-item', 'list-group-item-action');
                                item.innerHTML = `
                        <strong>${barrios.nombre}</strong><br>
                        <small>${barrios.municipio?.nombre ?? "Sin municipio"}</small>                    `;

                                // Al hacer clic se llena el input
                                item.addEventListener('click', function() {
                                    input.value = barrios.nombre;
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
