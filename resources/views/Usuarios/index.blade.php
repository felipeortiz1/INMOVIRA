@extends('layout.app')

@section('title', 'Usuarios')

@section('content')

    <div class="container mt-4 animate-fade">
        <div class="card border-0 shadow-lg rounded-4">

            <div class="card-header bg-primary text-white rounded-top-4">
                <h5 class="mb-0 fw-bold">
                    <i class="fas fa-users"></i> Lista de usuarios
                </h5>
            </div>

            {{-- FILTROS --}}
            <div class="mt-4 mb-4 p-4 border rounded bg-light shadow-sm">

                <form id="formFiltros" action="{{ route('usuario.index') }}" method="GET" class="row g-3">

                    {{-- BUSCAR --}}
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Buscar (Nombre o Empresa)</label>
                        <input type="text" id="buscador" name="buscar" class="form-control" autocomplete="off"
                            placeholder="Escribe para buscar..." value="{{ request('buscar') }}">
                        <div id="sugerencias" class="list-group position-absolute w-100 mt-1"
                            style="z-index: 1000; display: none;"></div>
                    </div>

                    {{-- SELECT MUNICIPIO --}}
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Municipio</label>
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
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Tipo de Usuario</label>
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
                    <div class="col-md-12 d-flex justify-content-end">
                        <button class="btn btn-primary me-3 px-4">
                            <i class="fas fa-filter"></i> Filtrar
                        </button>

                        <a href="{{ route('usuario.index') }}" class="btn btn-secondary px-4">
                            Limpiar filtros
                        </a>
                    </div>

                </form>

            </div>


            <div class="card-body p-4">

                {{-- Botones superiores --}}
                <div class="d-flex justify-content-between align-items-center mb-3">

                    <a href="{{ route('usuario.create') }}" class="btn btn-primary mb-3 rounded-pill">
                        <i class="fas fa-plus-circle"></i> Crear Usuario
                    </a>

                    {{-- Botón filtro ID Asc - Desc --}}
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

                    <a href="{{ route('usuario.index', $toggleParams) }}" class="btn btn-secondary rounded-pill px-4 shadow-sm mb-3">
                        {{ $buttonText }}
                    </a>

                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover text-center align-middle">

                        <thead class="table-primary">
                            <tr>
                                <th>ID</th>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Municipio</th>
                                <th>Dirección</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Tipo</th>
                                <th>Empresa</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($usuarios as $usuario)
                                <tr>

                                    <td>{{ $usuario->id }}</td>

                                    {{-- IMAGEN --}}
                                    <td>
                                        @if ($usuario->tipoUsuario == 'inmobiliaria' && $usuario->imagen)
                                            <img src="{{ asset('storage/' . $usuario->imagen) }}" width="60"
                                                height="60"
                                                style="object-fit:cover;border-radius:50%;border:2px solid #0d6efd;">
                                        @else
                                            <img src="{{ asset('img/usuarios/default.png') }}" width="60"
                                                height="60" style="object-fit:cover;border-radius:50%;">
                                        @endif
                                    </td>

                                    <td>{{ $usuario->nombre }}</td>
                                    <td>{{ $usuario->municipio->nombre ?? 'Sin municipio' }}</td>
                                    <td>{{ $usuario->direccion }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>{{ $usuario->telefono }}</td>

                                    <td>
                                        @if ($usuario->tipoUsuario == 'inmobiliaria')
                                            <span class="badge bg-success">Inmobiliaria</span>
                                        @else
                                            <span class="badge bg-secondary">Persona</span>
                                        @endif
                                    </td>

                                    <td>{{ $usuario->nombreEmpresa ?? '—' }}</td>

                                    <td>
                                        {{-- BOTÓN VER SOLO IMAGEN --}}
                                        <a href="{{ route('usuarios.inmuebles', $usuario->id) }}"
                                            class="btn btn-info btn-sm">
                                            Ver inmuebles
                                        </a>




                                        {{-- EDITAR --}}
                                        <a href="{{ route('usuario.edit', $usuario->id) }}"
                                            class="btn btn-sm btn-warning rounded-pill">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- ELIMINAR --}}
                                        <form action="{{ route('usuario.destroy', $usuario->id) }}" method="POST"
                                            class="d-inline" onsubmit="confirmarEliminacion(event)">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-danger rounded-pill">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

                <div class="mt-3 d-flex justify-content-center">
                    {{ $usuarios->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>
    </div>

    {{-- ✅ ESTILOS --}}
    <style>
        .animate-fade {
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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

    {{-- ✅ CONFIRMAR ELIMINACIÓN --}}
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

            input.addEventListener('keyup', function() {

                const query = this.value.trim();

                if (query.length < 1) {
                    box.style.display = 'none';
                    box.innerHTML = '';
                    return;
                }

                const municipio = document.querySelector('select[name=municipio]').value;

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
                if (!input.contains(e.target) && !box.contains(e.target)) {
                    box.style.display = 'none';
                }
            });
        });
    </script>

@endsection
