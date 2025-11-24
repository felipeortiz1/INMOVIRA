@extends('layout.app')

@section('title', 'Inmuebles')
@section('titleContent', 'Administrar Inmuebles')

@include('inmuebles.partials.show-modal')

@section('content')
    <div class="container mt-4 animate-fade">
        <div class="card border-0 shadow-lg rounded-4">

            <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
                <h5 class="mb-0 fw-bold"><i class="fa-solid fa-shop"></i> Lista de Inmuebles</h5>
            </div>

            {{-- FILTROS --}}
            <div class="mt-4 mb-4 p-4 border rounded bg-light shadow-sm">
                <form method="GET" action="{{ route('inmuebles.index') }}" class="row g-3">


                    <!-- Buscador libre (autocompletado) -->
                    <div class="col-md-4 position-relative">
                        <label class="form-label fw-bold">Buscar (título / dirección / usuario)</label>
                        <input type="text" name="buscar" id="buscador" class="form-control" autocomplete="off"
                            placeholder="Escribe para buscar..." value="{{ request('buscar') }}">
                        <div id="sugerencias" class="list-group position-absolute w-100 mt-1"
                            style="z-index:1500; display:none;"></div>
                    </div>

                    <!-- Usuario (filtro por nombre) -->
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Usuario (creador)</label>
                        <input type="text" name="usuario" id="f_usuario" class="form-control"
                            value="{{ request('usuario') }}">
                    </div>

                    <!-- Municipio -->
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Municipio</label>
                        <select name="municipio" id="selectMunicipio" class="form-select">
                            <option value=""> Seleccionar </option>
                            @foreach ($municipios as $m)
                                <option value="{{ $m->id }}" {{ request('municipio') == $m->id ? 'selected' : '' }}>
                                    {{ $m->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Barrio (se actualiza según municipio) -->
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Barrio</label>
                        <select name="barrio" id="selectBarrio" class="form-select">
                            <option value=""> Seleccionar </option>
                            @foreach ($barrios as $b)
                                <option value="{{ $b->id }}" {{ request('barrio') == $b->id ? 'selected' : '' }}>
                                    {{ $b->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tipo de oferta -->
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Tipo de oferta</label>
                        <select name="tipoOferta" class="form-select">
                            <option value=""> Todos </option>
                            <option value="venta" {{ request('tipoOferta') == 'venta' ? 'selected' : '' }}>Venta</option>
                            <option value="arriendo" {{ request('tipoOferta') == 'arriendo' ? 'selected' : '' }}>Arriendo
                            </option>
                            
                        </select>
                    </div>

                    <!-- Rango de precio -->
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Precio mínimo</label>
                        <input type="number" name="precio_min" class="form-control" value="{{ request('precio_min') }}">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label fw-bold">Precio máximo</label>
                        <input type="number" name="precio_max" class="form-control" value="{{ request('precio_max') }}">
                    </div>

                    <!-- Fecha creación (desde / hasta) -->
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Fecha creación desde</label>
                        <input type="date" name="fecha_desde" class="form-control" value="{{ request('fecha_desde') }}">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label fw-bold">Fecha creación hasta</label>
                        <input type="date" name="fecha_hasta" class="form-control" value="{{ request('fecha_hasta') }}">
                    </div>

                    <!-- Estado -->
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Estado publicación</label>
                        <select name="estadoPublicacion" class="form-select">
                            <option value=""> Todos </option>
                            <option value="disponible"
                                {{ request('estadoPublicacion') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                            <option value="arrendado" {{ request('estadoPublicacion') == 'arrendado' ? 'selected' : '' }}>
                                Arrendado</option>
                            <option value="vendido" {{ request('estadoPublicacion') == 'vendido' ? 'selected' : '' }}>
                                Vendido</option>
                            <option value="reservado" {{ request('estadoPublicacion') == 'reservado' ? 'selected' : '' }}>
                                Reservado</option>
                            <option value="inactivo" {{ request('estadoPublicacion') == 'inactivo' ? 'selected' : '' }}>
                                Inactivo</option>
                        </select>
                    </div>

                    {{-- BOTONES --}}
                    <div class="col-md-12 d-flex justify-content-end mt-3">
                        <button class="btn btn-primary me-3 px-4">
                            <i class="fas fa-filter"></i> Filtrar
                        </button>

                        <a href="{{ route('inmuebles.index') }}" class="btn btn-secondary px-4">
                            Limpiar filtros
                        </a>
                    </div>
                </form>
            </div>

            <div class="card-body p-4">

                {{-- Botones superiores --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="{{ route('inmuebles.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                        <i class="fas fa-plus-circle"></i> Crear Inmueble
                    </a>

                    {{-- Botón filtro ID Asc - Desc --}}
                    {{-- Botón filtro ID Asc - Desc --}}
                    @php
                        $query = request()->except('sort', 'direction');
                    @endphp

                    <a href="{{ route(
                        'inmuebles.index',
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

                {{-- Tabla --}}
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center shadow-sm">
                        <thead class="table-primary">
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Dirección</th>
                                <th>Usuario</th>
                                <th>Tipo de Oferta</th>
                                <th>Imágenes</th>
                                <th>Detalles</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($inmuebles as $inmueble)
                                <tr>
                                    <td>{{ $inmueble->id }}</td>
                                    <td>{{ $inmueble->titulo }}</td>
                                    <td>{{ $inmueble->direccion }}</td>
                                    <td>{{ $inmueble->usuario->nombre }}</td>
                                    <td>{{ ucfirst($inmueble->tipoOferta) }}</td>

                                    <td>
                                        @if ($inmueble->imagens && $inmueble->imagens->count() > 0)
                                            <button class="btn btn-info btn-sm rounded-pill shadow-sm me-1"
                                                data-bs-toggle="modal" data-bs-target="#modalImagenes"
                                                onclick="cargarImagenes({{ $inmueble->id }})">
                                                <i class="fa-solid fa-eye"></i> Ver
                                                ({{ $inmueble->imagens->count() }})
                                            </button>
                                        @else
                                            <span class="text-muted">Sin imágenes</span>
                                        @endif
                                    </td>

                                    <td>
                                        <button class="btn btn-primary btn-sm rounded-pill shadow-sm me-1"
                                            onclick="mostrarDetalles({{ $inmueble->id }})">
                                            <i class="fa-solid fa-eye"></i> Ver detalles
                                        </button>
                                    </td>

                                    <td>
                                        <a href="{{ route('inmuebles.edit', $inmueble->id) }}"
                                            class="btn btn-sm btn-warning rounded-pill shadow-sm me-1">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>

                                        <form action="{{ route('inmuebles.destroy', $inmueble->id) }}" method="POST"
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

                {{-- PAGINACIÓN --}}
                <div class="mt-3 d-flex justify-content-center">
                    {{ $inmuebles->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>
    </div>

    {{-- Estilos --}}
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

        table tbody tr:hover {
            background-color: #f9fafc;
        }

        th,
        td {
            padding: 1rem !important;
        }
    </style>

    <!-- Modal de imágenes (Dinámico por JS) -->
    <div class="modal fade" id="modalImagenes" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Imágenes del Inmueble</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div id="carouselInmueble" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner" id="carouselInner">
                            <!-- JS INSERTA AQUÍ -->
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselInmueble"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#carouselInmueble"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>

                    </div>

                    <div id="contadorImagenes" class="text-center mt-3 fs-5 fw-bold"></div>

                </div>

            </div>
        </div>
    </div>

    <!-- Modal: Ver detalles -->
    <div class="modal fade" id="modalVerDetalles" tabindex="-1" aria-labelledby="modalVerDetallesLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalVerDetallesLabel">Detalles del Inmueble</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body">

                    <!-- Contenedor donde se carga dynamic -->
                    <div id="contenedorDetalles" class="px-3 py-2">
                        <p class="text-muted">Cargando detalles...</p>
                    </div>

                    <hr>

                    <h5 class="fw-bold mt-4 mb-3 text-center text-secondary">
                        Galería de Imágenes
                    </h5>

                    <div class="row g-3" id="galeriaDetalles">
                        <p class="text-muted text-center">Cargando imágenes...</p>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>



@endsection

@if (session('success'))
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
            text: "Esta acción eliminará el inmueble de forma permanente.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then(res => {
            if (res.isConfirmed) form.submit();
        });
    }

    /* ======================================================
    CARGAR IMÁGENES DINÁMICAMENTE
    ====================================================== */
    async function cargarImagenes(inmuebleId) {
        const carouselInner = document.getElementById('carouselInner');
        const contador = document.getElementById('contadorImagenes');

        carouselInner.innerHTML = '';
        contador.textContent = '';

        try {
            const res = await fetch(`/inmueble/${inmuebleId}/imagenes`);
            const imagenes = await res.json();

            if (!imagenes.length) {
                carouselInner.innerHTML =
                    '<p class="text-center text-muted py-4">No hay imágenes disponibles.</p>';
                return;
            }

            imagenes.forEach((img, i) => {
                const item = document.createElement('div');
                item.className = 'carousel-item' + (i === 0 ? ' active' : '');
                item.innerHTML = `
                    <img src="/storage/${img.ruta}" class="d-block mx-auto rounded"
                        style="width:100%; max-height:450px; object-fit:contain;">
                `;
                carouselInner.appendChild(item);
            });

            const total = imagenes.length;

            function actualizar() {
                const activa = document.querySelector('#carouselInmueble .carousel-item.active');
                const index = Array.from(activa.parentNode.children).indexOf(activa) + 1;
                contador.textContent = `${index} / ${total}`;
            }

            setTimeout(() => {
                actualizar();
                document.getElementById('carouselInmueble')
                    .addEventListener('slid.bs.carousel', actualizar);
            }, 200);

        } catch (err) {
            carouselInner.innerHTML =
                '<p class="text-danger text-center py-4">Error al cargar imágenes.</p>';
        }
    }

    /* ======================================================
    DETALLES DEL INMUEBLE
    ====================================================== */

    function mostrarDetalles(inmuebleId) {
        const detalles = document.getElementById('contenedorDetalles');
        const galeria = document.getElementById('galeriaDetalles');

        detalles.innerHTML = '<p class="text-muted">Cargando detalles...</p>';
        galeria.innerHTML = '<p class="text-muted text-center">Cargando imágenes...</p>';

        fetch(`/inmueble/${inmuebleId}/detalles`)
            .then(response => response.json())
            .then(data => {

                // ====== DETALLES ======
                detalles.innerHTML = `
                <h4 class="fw-bold text-center mb-3">${data.titulo}</h4>

                <ul class="list-group">
                    <li class="list-group-item"><strong>Dirección:</strong> ${data.direccion}</li>
                    <li class="list-group-item"><strong>Tipo de oferta:</strong> ${data.tipoOferta}</li>
                    <li class="list-group-item"><strong>Tipo de inmueble:</strong> ${data.tipo_inmueble?.nombre || 'N/A'}</li>
                    <li class="list-group-item"><strong>Barrio:</strong> ${data.barrio?.nombre || 'N/A'}</li>
                    <li class="list-group-item"><strong>Usuario:</strong> ${data.usuario?.nombre || 'N/A'}</li>
                    <li class="list-group-item"><strong>Precio:</strong> $${parseFloat(data.precio).toLocaleString()}</li>
                    <li class="list-group-item"><strong>Área:</strong> ${data.area} m²</li>
                    <li class="list-group-item"><strong>Baños:</strong> ${data.nBaños}</li>
                    <li class="list-group-item"><strong>Estado de publicación:</strong> ${data.estadoPublicacion}</li>
                    <li class="list-group-item"><strong>Fecha de publicación:</strong> ${data.fechaPublicacion}</li>
                    <li class="list-group-item">
                        <strong>Descripción:</strong><br>${data.descripcion}
                    </li>
                </ul>
            `;

                // ====== GALERÍA ======
                if (!data.imagenes || data.imagenes.length === 0) {
                    galeria.innerHTML = `<p class="text-muted text-center">Sin imágenes disponibles.</p>`;
                } else {
                    let html = "";

                    data.imagenes.forEach(img => {
                        html += `
                        <div class="col-md-4 col-sm-6">
                            <div class="card shadow-sm">
                                <img src="${img.url_imagen}" class="card-img-top rounded" alt="Imagen inmueble">
                            </div>
                        </div>
                    `;
                    });

                    galeria.innerHTML = html;
                }

                // Abrir modal
                const modal = new bootstrap.Modal(document.getElementById('modalVerDetalles'));
                modal.show();
            })
            .catch(error => {
                console.error('Error al cargar detalles:', error);
                detalles.innerHTML = '<p class="text-danger">Ocurrió un error cargando los detalles.</p>';
            });
    }


    document.addEventListener('DOMContentLoaded', function() {

        // --- SELECT DEPENDIENTE: Municipio -> Barrios ---
        const selectMunicipio = document.getElementById('selectMunicipio');
        const selectBarrio = document.getElementById('selectBarrio');

        selectMunicipio?.addEventListener('change', function() {
            const id = this.value;

            // limpiar el select de barrios si no hay municipio
            if (!id) {
                selectBarrio.innerHTML = '<option value="">-- Seleccionar --</option>';
                return;
            }

            fetch(`{{ url('') }}/barrios-por-municipio/${id}`)
                .then(res => res.json())
                .then(data => {
                    selectBarrio.innerHTML = '<option value="">-- Seleccionar --</option>';
                    if (data.length === 0) {
                        selectBarrio.innerHTML += '<option value="">Sin barrios</option>';
                        return;
                    }
                    data.forEach(b => {
                        selectBarrio.innerHTML +=
                            `<option value="${b.id}">${b.nombre}</option>`;
                    });
                })
                .catch(err => console.error(err));
        });

        // --- AUTOCOMPLETADO para TÍTULO/DIRECCIÓN/USUARIO (autollenado) ---
        const input = document.getElementById('buscador');
        const box = document.getElementById('sugerencias');

        // campos que vamos a autollenar al seleccionar
        const tituloInput = document.querySelector('input[name="titulo"]'); // si existiera en create/edit
        const direccionInput = document.querySelector('input[name="direccion"]'); // si existiera
        const usuarioInput = document.querySelector(
            'input[name="usuario"]'); // campo visible/hidden donde guardes usuario

        input?.addEventListener('keyup', function() {
            const query = this.value.trim();

            if (query.length < 1) {
                box.style.display = 'none';
                box.innerHTML = '';
                return;
            }

            fetch("" + encodeURIComponent(query))
                .then(res => res.json())
                .then(data => {
                    box.innerHTML = '';

                    if (!data || data.length === 0) {
                        box.style.display = 'none';
                        return;
                    }

                    data.forEach(item => {
                        const btn = document.createElement('button');
                        btn.type = 'button';
                        btn.classList.add('list-group-item', 'list-group-item-action');
                        btn.innerHTML = `
                        <strong>${item.titulo}</strong><br>
                        <small>${item.direccion}</small><br>
                        <small>Usuario: ${item.usuario_nombre ?? 'N/A'}</small>
                    `;

                        btn.addEventListener('click', function() {
                            // Rellenar el input visible del buscador con el título
                            input.value = item.titulo;

                            // Si existen inputs específicos en el formulario de create/edit, los llenamos
                            if (tituloInput) tituloInput.value = item.titulo;
                            if (direccionInput) direccionInput.value = item
                                .direccion;
                            if (usuarioInput) usuarioInput.value = item
                                .usuario_nombre ?? '';

                            box.style.display = 'none';
                        });

                        box.appendChild(btn);
                    });

                    box.style.display = 'block';
                })
                .catch(err => {
                    console.error(err);
                    box.style.display = 'none';
                });
        });

        // cerrar al hacer click fuera
        document.addEventListener('click', function(e) {
            if (!input?.contains(e.target) && !box?.contains(e.target)) {
                if (box) box.style.display = 'none';
            }
        });

    });
</script>
