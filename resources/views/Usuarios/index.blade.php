@extends('layout.app')

@section('title', 'Usuarios')

@section('content')
    <div class="container-fluid px-4 py-4 animate-fade">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">

            <!-- Card Header Principal -->
            <div class="card-header bg-gradient-dark text-white p-4 border-0">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="header-icon-box bg-primary text-white rounded-3 p-3 d-flex align-items-center justify-content-center">
                            <i class="fas fa-users fa-lg"></i>
                        </div>
                        <div>
                            <h4 class="mb-1 fw-bold text-white">Lista de Usuarios</h4>
                            <p class="mb-0 text-white-50 fs-7">Administra, filtra y gestiona los usuarios registrados en el sistema</p>
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

                    <form id="formFiltros" action="{{ route('usuario.index') }}" method="GET" class="row g-3">

                        {{-- BUSCAR --}}
                        <div class="col-md-4 position-relative">
                            <label class="form-label text-muted small fw-semibold">Buscar (Nombre o Empresa)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-search"></i></span>
                                <input type="text" id="buscador" name="buscar" class="form-control border-start-0 ps-0" autocomplete="off"
                                    placeholder="Escribe para buscar..." value="{{ request('buscar') }}">
                            </div>
                            <div id="sugerencias" class="list-group position-absolute w-100 mt-1 shadow-lg rounded-3"
                                style="z-index: 1000; display: none;"></div>
                        </div>

                        {{-- SELECT MUNICIPIO --}}
                        <div class="col-md-4">
                            <label class="form-label text-muted small fw-semibold">Municipio</label>
                            <select name="municipio" class="form-select">
                                <option value="">Seleccionar</option>
                                @foreach ($municipios as $m)
                                    <option value="{{ $m->id }}" {{ request('municipio') == $m->id ? 'selected' : '' }}>
                                        {{ $m->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- SELECT TIPO USUARIO --}}
                        <div class="col-md-4">
                            <label class="form-label text-muted small fw-semibold">Tipo de Usuario</label>
                            <select name="tipoUsuario" class="form-select">
                                <option value="">Seleccionar</option>
                                <option value="persona" {{ request('tipoUsuario') == 'persona' ? 'selected' : '' }}>
                                    Persona
                                </option>
                                <option value="inmobiliaria" {{ request('tipoUsuario') == 'inmobiliaria' ? 'selected' : '' }}>
                                    Inmobiliaria
                                </option>
                            </select>
                        </div>

                        {{-- BOTONES --}}
                        <div class="col-md-12 d-flex justify-content-end gap-2 mt-4 pt-2 border-top">
                            <a href="{{ route('usuario.index') }}" class="btn btn-light rounded-pill px-4 fw-semibold border">
                                <i class="fas fa-rotate-left me-1"></i> Limpiar filtros
                            </a>
                            <button type="submit" class="btn btn-primary rounded-pill px-4 fw-semibold shadow-sm">
                                <i class="fas fa-filter me-1"></i> Filtrar
                            </button>
                        </div>

                    </form>
                </div>

                <!-- BARRA DE ACCIONES SUPERIORES -->
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                    <a href="{{ route('usuario.create') }}" class="btn btn-success rounded-pill px-4 py-2 shadow-sm fw-semibold">
                        <i class="fas fa-plus-circle me-1"></i> Crear Usuario
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

                        <a href="{{ route('usuario.index', $toggleParams) }}" class="btn btn-outline-secondary rounded-pill px-3 py-2 text-dark border fw-medium bg-white shadow-sm">
                            <i class="fas fa-sort me-1 text-primary"></i> {{ $buttonText }}
                        </a>

                        <a href="{{ route('dashboard') }}" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-medium shadow-sm">
                            <i class="fas fa-arrow-left me-1"></i> Volver
                        </a>
                    </div>
                </div>

                <!-- TABLA DE USUARIOS -->
                <div class="table-responsive rounded-3 border">
                    <table class="table table-hover align-middle mb-0 text-center custom-table">
                        <thead class="bg-light border-bottom">
                            <tr>
                                <th class="text-secondary text-uppercase fs-7 fw-bold py-3">ID</th>
                                <th class="text-secondary text-uppercase fs-7 fw-bold py-3">Imagen</th>
                                <th class="text-secondary text-uppercase fs-7 fw-bold py-3 text-start ps-3">Nombre</th>
                                <th class="text-secondary text-uppercase fs-7 fw-bold py-3">Municipio</th>
                                <th class="text-secondary text-uppercase fs-7 fw-bold py-3 text-start">Dirección</th>
                                <th class="text-secondary text-uppercase fs-7 fw-bold py-3">Email</th>
                                <th class="text-secondary text-uppercase fs-7 fw-bold py-3">Teléfono</th>
                                <th class="text-secondary text-uppercase fs-7 fw-bold py-3">Tipo</th>
                                <th class="text-secondary text-uppercase fs-7 fw-bold py-3">Empresa</th>
                                <th class="text-secondary text-uppercase fs-7 fw-bold py-3">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($usuarios as $usuario)
                                <tr>
                                    <td class="fw-bold text-muted">#{{ $usuario->id }}</td>

                                    {{-- IMAGEN --}}
                                    <td>
                                        <div class="d-inline-block position-relative">
                                            @if ($usuario->imagen)
                                                <img src="{{ asset('storage/' . $usuario->imagen) }}" width="50" height="50"
                                                    class="rounded-circle border shadow-sm" style="object-fit:cover;">
                                            @elseif ($usuario->tipoUsuario == 'persona')
                                                <img src="{{ asset('img/usuarios/default.png') }}" width="50" height="50"
                                                    class="rounded-circle border shadow-sm" style="object-fit:cover;">
                                            @else
                                                <div class="avatar-placeholder rounded-circle bg-light border text-muted d-flex align-items-center justify-content-center mx-auto" style="width: 50px; height: 50px;">
                                                    <i class="fas fa-building"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="text-start ps-3 fw-bold text-dark">
                                        {{ $usuario->nombre }}
                                    </td>

                                    <td>
                                        <span class="badge bg-light text-dark border px-2 py-1 fw-normal">
                                            <i class="fas fa-map-marker-alt text-danger me-1"></i>{{ $usuario->municipio->nombre ?? 'Sin municipio' }}
                                        </span>
                                    </td>

                                    <td class="text-start text-secondary">
                                        <small>{{ $usuario->direccion }}</small>
                                    </td>

                                    <td class="text-muted small">
                                        <i class="far fa-envelope me-1"></i>{{ $usuario->email }}
                                    </td>

                                    <td class="text-muted small">
                                        <i class="fas fa-phone-alt me-1 text-success"></i>{{ $usuario->telefono }}
                                    </td>

                                    <td>
                                        @if ($usuario->tipoUsuario == 'inmobiliaria')
                                            <span class="badge bg-emerald-soft text-emerald px-3 py-2 rounded-pill fw-bold">
                                                <i class="fas fa-building me-1"></i> Inmobiliaria
                                            </span>
                                        @else
                                            <span class="badge bg-indigo-soft text-indigo px-3 py-2 rounded-pill fw-bold">
                                                <i class="fas fa-user me-1"></i> Persona
                                            </span>
                                        @endif
                                    </td>

                                    <td class="fw-semibold text-dark">
                                        {{ $usuario->nombreEmpresa ?? '—' }}
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            {{-- BOTÓN VER INMUEBLES --}}
                                            <a href="{{ route('usuarios.inmuebles', $usuario->id) }}"
                                                class="btn btn-sm btn-soft-info rounded-pill px-3 fw-medium">
                                                <i class="fas fa-home me-1"></i> Ver perfil
                                            </a>

                                            {{-- EDITAR --}}
                                            <a href="{{ route('usuario.edit', $usuario->id) }}"
                                                class="btn btn-sm btn-outline-warning rounded-circle action-btn"
                                                title="Editar">
                                                <i class="fas fa-pen"></i>
                                            </a>

                                            {{-- ELIMINAR --}}
                                            <form action="{{ route('usuario.destroy', $usuario->id) }}" method="POST"
                                                class="d-inline" onsubmit="confirmarEliminacion(event)">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle action-btn" title="Eliminar">
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
                    {{ $usuarios->links('pagination::bootstrap-5') }}
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

        /* Soft Badges */
        .bg-emerald-soft { background-color: #dcfce7; }
        .text-emerald { color: #15803d; }
        .bg-indigo-soft { background-color: #e0e7ff; }
        .text-indigo { color: #4338ca; }

        /* Soft Buttons */
        .btn-soft-info {
            background-color: #e0f2fe;
            color: #0369a1;
            border: none;
        }
        .btn-soft-info:hover {
            background-color: #bae6fd;
            color: #0284c7;
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

    {{-- ✅ SWEET ALERT MENSAJES --}}
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: "{{ session('success') }}",
                    confirmButtonText: 'Aceptar'
                });
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "{{ session('error') }}",
                    confirmButtonText: 'Aceptar'
                });
            });
        </script>
    @endif

    {{-- ✅ MODAL PARA VER SOLO LA IMAGEN --}}
    <script>
        function verImagen(ruta) {
            Swal.fire({
                imageUrl: ruta,
                imageWidth: 450,
                imageHeight: 'auto',
                imageAlt: 'Imagen Inmobiliaria',
                showConfirmButton: false,
                background: '#f8fafc',
                showCloseButton: true,
                backdrop: true,
                padding: '20px'
            });
        }
    </script>

    {{-- ✅ CONFIRMAR ELIMINACIÓN Y BUSCADOR --}}
    <script>
        function confirmarEliminacion(event) {
            event.preventDefault();
            const form = event.target.closest('form');

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esta acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
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

                fetch("{{ route('usuario.buscar') }}?q=" + query + "&municipio=" + municipio)
                    .then(response => response.json())
                    .then(data => {

                        box.innerHTML = "";

                        if (data.length === 0) {
                            box.style.display = "none";
                            return;
                        }

                        data.forEach(usuario => {

                            const item = document.createElement('button');
                            item.type = "button";
                            item.classList.add('list-group-item', 'list-group-item-action');

                            item.innerHTML = `
                        <strong>${usuario.nombre}</strong><br>
                        <small>${usuario.municipio?.nombre ?? "Sin municipio"} — 
                        ${usuario.nombreEmpresa ?? ""}</small>
                    `;

                            // Al hacer clic se llena el input
                            item.addEventListener('click', function() {
                                input.value = usuario.nombre;
                                box.innerHTML = "";
                                box.style.display = "none";
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