@extends('layout.app')

@section('title', 'Barrios')
@section('titleContent', 'Administrar Barrios')

@section('content')
    <div class="container-fluid px-4 py-4 animate-fade">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">

            <!-- Card Header Principal -->
            <div class="card-header bg-gradient-dark text-white p-4 border-0">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="header-icon-box bg-primary text-white rounded-3 p-3 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-map-pin fa-lg"></i>
                        </div>
                        <div>
                            <h4 class="mb-1 fw-bold text-white">Lista de Barrios</h4>
                            <p class="mb-0 text-white-50 fs-7">Administra y gestiona los barrios registrados en cada municipio</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">

                <!-- PANEL DE FILTROS -->
                <div class="filter-panel p-4 rounded-4 mb-4 border bg-light-subtle">
                    <div class="d-flex align-items-center mb-3 gap-2 border-bottom pb-2">
                        <i class="fas fa-sliders text-primary"></i>
                        <h6 class="fw-bold mb-0 text-dark">Filtros de Búsqueda Avanzada</h6>
                    </div>

                    <form id="formFiltros" action="{{ route('barrios.index') }}" method="GET" class="row g-3">

                        {{-- BUSCAR --}}
                        <div class="col-md-6 position-relative">
                            <label class="form-label text-muted small fw-semibold">Buscar (Barrio o su Municipio)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-search"></i></span>
                                <input type="text" id="buscador" name="buscar" class="form-control border-start-0 ps-0" autocomplete="off"
                                    placeholder="Escribe para buscar..." value="{{ request('buscar') }}">
                            </div>
                            <div id="sugerencias" class="list-group position-absolute w-100 mt-1 shadow-lg rounded-3"
                                style="z-index: 1000; display: none;"></div>
                        </div>

                        {{-- SELECT MUNICIPIO --}}
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-semibold">Municipio</label>
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
                        <div class="col-md-12 d-flex justify-content-end gap-2 mt-4 pt-2 border-top">
                            <a href="{{ route('barrios.index') }}" class="btn btn-light rounded-pill px-4 fw-semibold border">
                                <i class="fas fa-rotate-left me-1"></i> Limpiar filtros
                            </a>
                            <button class="btn btn-primary rounded-pill px-4 fw-semibold shadow-sm">
                                <i class="fas fa-filter me-1"></i> Filtrar
                            </button>
                        </div>

                    </form>
                </div>

                <!-- BARRA DE ACCIONES SUPERIORES -->
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                    <a href="{{ route('barrios.create') }}" class="btn btn-success rounded-pill px-4 py-2 shadow-sm fw-semibold">
                        <i class="fas fa-plus-circle me-1"></i> Crear Barrio
                    </a>

                    <div class="d-flex align-items-center gap-2">
                        @php
                            $currentDirection = request('direction') === 'desc' ? 'desc' : 'asc';
                            $nextDirection = $currentDirection === 'asc' ? 'desc' : 'asc';

                            $toggleParams = array_merge(request()->all(), [
                                'sort' => 'id',
                                'direction' => $nextDirection
                            ]);

                            $buttonText = $currentDirection === 'asc'
                                ? 'Ordenar por ID ↓ Descendente'
                                : 'Ordenar por ID ↑ Ascendente';
                        @endphp
                        <a href="{{ route('barrios.index', $toggleParams) }}" class="btn btn-outline-secondary rounded-pill px-3 py-2 text-dark border fw-medium bg-white shadow-sm">
                            <i class="fas fa-sort me-1 text-primary"></i> {{ $buttonText }}
                        </a>

                        <a href="{{ route('dashboard') }}" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-medium shadow-sm">
                            <i class="fas fa-arrow-left me-1"></i> Volver
                        </a>
                    </div>
                </div>

                <!-- TABLA DE BARRIOS -->
                <div class="table-responsive rounded-3 border">
                    <table class="table table-hover align-middle mb-0 text-center custom-table">
                        <thead class="bg-light border-bottom">
                            <tr>
                                <th class="text-secondary text-uppercase fs-7 fw-bold py-3">ID</th>
                                <th class="text-secondary text-uppercase fs-7 fw-bold py-3 text-start ps-4">Nombre</th>
                                <th class="text-secondary text-uppercase fs-7 fw-bold py-3">Municipio</th>
                                <th class="text-secondary text-uppercase fs-7 fw-bold py-3">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($barrios as $barrio)
                                <tr>
                                    <td class="fw-bold text-muted">#{{ $barrio->id }}</td>
                                    <td class="text-start ps-4 fw-bold text-dark">{{ $barrio->nombre }}</td>
                                    <td>
                                        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-normal">
                                            <i class="fas fa-city me-1 text-primary"></i>{{ $barrio->municipio->nombre }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            <a href="{{ route('barrios.edit', $barrio->id) }}"
                                                class="btn btn-sm btn-outline-warning rounded-circle action-btn"
                                                title="Editar">
                                                <i class="fas fa-pen"></i>
                                            </a>

                                            <form action="{{ route('barrios.destroy', $barrio->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle action-btn"
                                                    onclick="confirmarEliminacion(event)" title="Eliminar">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- PAGINACIÓN --}}
                <div class="mt-4 d-flex justify-content-center">
                    {{ $barrios->links('pagination::bootstrap-5') }}
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

        .filter-panel {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0 !important;
        }

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

        // Funcionalidad del buscador con sugerencias
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('buscador');
            const box = document.getElementById('sugerencias');

            input?.addEventListener('keyup', function() {
                const query = this.value.trim();

                if (query.length < 1) {
                    box.style.display = 'none';
                    box.innerHTML = '';
                    return;
                }

                const municipioSelect = document.querySelector('select[name=municipio]');
                const municipio = municipioSelect ? municipioSelect.value : '';

                fetch("{{ route('barrios.buscar') }}?q=" + query + "&municipio=" + municipio)
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
                                <small>${barrios.municipio?.nombre ?? "Sin municipio"}</small>
                            `;

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
                if (!input?.contains(e.target) && !box?.contains(e.target)) {
                    if (box) box.style.display = 'none';
                }
            });
        });
    </script>
@endsection