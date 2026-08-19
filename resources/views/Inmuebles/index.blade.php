@extends('layout.app')

@section('title', 'Inmuebles')
@section('titleContent', 'Administrar Inmuebles')


@section('content')
    <div class="container-fluid px-4 py-4 animate-fade">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">

            <!-- Card Header Principal -->
            <div class="card-header bg-gradient-dark text-white p-4 border-0">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="header-icon-box bg-primary text-white rounded-3 p-3 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-shop fa-lg"></i>
                        </div>
                        <div>
                            <h4 class="mb-1 fw-bold text-white">Lista de Inmuebles</h4>
                            <p class="mb-0 text-white-50 fs-7">Gestiona, filtra y administra las propiedades del sistema</p>
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

                    <form method="GET" action="{{ route('inmuebles.index') }}" class="row g-3">

                        <!-- Buscador libre -->
                        <div class="col-md-4 position-relative">
                            <label class="form-label text-muted small fw-semibold">Buscar (título / dirección / usuario)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-search"></i></span>
                                <input type="text" name="buscar" id="buscador" class="form-control border-start-0 ps-0" autocomplete="off"
                                    placeholder="Escribe para buscar..." value="{{ request('buscar') }}">
                            </div>
                            <div id="sugerencias" class="list-group position-absolute w-100 mt-1 shadow-lg rounded-3"
                                style="z-index:1500; display:none;"></div>
                        </div>

                        <!-- Usuario (filtro por nombre) -->
                        <div class="col-md-3">
                            <label class="form-label text-muted small fw-semibold">Usuario (creador)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-user"></i></span>
                                <input type="text" name="usuario" id="f_usuario" class="form-control border-start-0 ps-0"
                                    placeholder="Nombre de usuario" value="{{ request('usuario') }}">
                            </div>
                        </div>

                        <!-- Municipio -->
                        <div class="col-md-2">
                            <label class="form-label text-muted small fw-semibold">Municipio</label>
                            <select name="municipio" id="selectMunicipio" class="form-select">
                                <option value=""> Seleccionar </option>
                                @foreach ($municipios as $m)
                                    <option value="{{ $m->id }}" {{ request('municipio') == $m->id ? 'selected' : '' }}>
                                        {{ $m->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Barrio -->
                        <div class="col-md-3">
                            <label class="form-label text-muted small fw-semibold">Barrio</label>
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
                            <label class="form-label text-muted small fw-semibold">Tipo de oferta</label>
                            <select name="tipoOferta" class="form-select">
                                <option value=""> Todos </option>
                                <option value="venta" {{ request('tipoOferta') == 'venta' ? 'selected' : '' }}>Venta</option>
                                <option value="arriendo" {{ request('tipoOferta') == 'arriendo' ? 'selected' : '' }}>Arriendo</option>
                            </select>
                        </div>

                        <!-- Rango de precio -->
                        <div class="col-md-2">
                            <label class="form-label text-muted small fw-semibold">Precio mínimo</label>
                            <input type="number" name="precio_min" class="form-control" placeholder="$ 0" value="{{ request('precio_min') }}">
                        </div>

                        <div class="col-md-2">
                            <label class="form-label text-muted small fw-semibold">Precio máximo</label>
                            <input type="number" name="precio_max" class="form-control" placeholder="$ Max" value="{{ request('precio_max') }}">
                        </div>

                        <!-- Fecha creación -->
                        <div class="col-md-2">
                            <label class="form-label text-muted small fw-semibold">Fecha desde</label>
                            <input type="date" name="fecha_desde" class="form-control" value="{{ request('fecha_desde') }}">
                        </div>

                        <div class="col-md-2">
                            <label class="form-label text-muted small fw-semibold">Fecha hasta</label>
                            <input type="date" name="fecha_hasta" class="form-control" value="{{ request('fecha_hasta') }}">
                        </div>

                        <!-- Estado -->
                        <div class="col-md-2">
                            <label class="form-label text-muted small fw-semibold">Estado publicación</label>
                            <select name="estadoPublicacion" class="form-select">
                                <option value=""> Todos </option>
                                <option value="disponible" {{ request('estadoPublicacion') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                                <option value="arrendado" {{ request('estadoPublicacion') == 'arrendado' ? 'selected' : '' }}>Arriendo</option>
                                <option value="vendido" {{ request('estadoPublicacion') == 'vendido' ? 'selected' : '' }}>Vendido</option>
                                <option value="reservado" {{ request('estadoPublicacion') == 'reservado' ? 'selected' : '' }}>Reservado</option>
                                <option value="inactivo" {{ request('estadoPublicacion') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>

                        <!-- Botones de Acción Filtros -->
                        <div class="col-md-12 d-flex justify-content-end gap-2 mt-4 pt-2 border-top">
                            <a href="{{ route('inmuebles.index') }}" class="btn btn-light rounded-pill px-4 fw-semibold border">
                                <i class="fas fa-rotate-left me-1"></i> Limpiar
                            </a>
                            <button class="btn btn-primary rounded-pill px-4 fw-semibold shadow-sm">
                                <i class="fas fa-filter me-1"></i> Aplicar Filtros
                            </button>
                        </div>
                    </form>
                </div>

                <!-- BARRA DE ACCIONES SUPERIORES -->
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                    <a href="{{ route('inmuebles.create') }}" class="btn btn-success rounded-pill px-4 py-2 shadow-sm fw-semibold">
                        <i class="fas fa-plus-circle me-1"></i> Crear Inmueble
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
                                ? 'Orden ID: Descendente'
                                : 'Orden ID: Ascendente';
                        @endphp

                        <a href="{{ route('inmuebles.index', $toggleParams) }}" class="btn btn-outline-secondary rounded-pill px-3 py-2 text-dark border fw-medium bg-white shadow-sm">
                            <i class="fas fa-sort me-1 text-primary"></i> {{ $buttonText }}
                        </a>

                        <a href="{{ route('dashboard') }}" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-medium shadow-sm">
                            <i class="fas fa-arrow-left me-1"></i> Volver
                        </a>
                    </div>
                </div>

                <!-- TABLA DE INMUEBLES -->
                <div class="table-responsive rounded-3 border">
                    <table class="table table-hover align-middle mb-0 text-center custom-table">
                        <thead class="bg-light border-bottom">
                            <tr>
                                <th class="text-secondary text-uppercase fs-7 fw-bold py-3">ID</th>
                                <th class="text-secondary text-uppercase fs-7 fw-bold py-3 text-start ps-3">Título</th>
                                <th class="text-secondary text-uppercase fs-7 fw-bold py-3 text-start">Dirección</th>
                                <th class="text-secondary text-uppercase fs-7 fw-bold py-3">Usuario</th>
                                <th class="text-secondary text-uppercase fs-7 fw-bold py-3">Tipo Oferta</th>
                                <th class="text-secondary text-uppercase fs-7 fw-bold py-3">Imágenes</th>
                                <th class="text-secondary text-uppercase fs-7 fw-bold py-3">Detalles</th>
                                <th class="text-secondary text-uppercase fs-7 fw-bold py-3">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($inmuebles as $inmueble)
                                <tr>
                                    <td class="fw-bold text-muted">#{{ $inmueble->id }}</td>
                                    <td class="text-start ps-3">
                                        <span class="fw-bold text-dark d-block">{{ $inmueble->titulo }}</span>
                                    </td>
                                    <td class="text-start text-secondary">
                                        <small><i class="fas fa-location-dot text-danger me-1"></i> {{ $inmueble->direccion }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border px-2 py-1 fw-normal">
                                            <i class="fas fa-user-circle me-1 text-secondary"></i>{{ $inmueble->usuario->nombre }}
                                        </span>
                                    </td>
                                    <td>
                                        @if(strtolower($inmueble->tipoOferta) === 'venta')
                                            <span class="badge bg-amber-soft text-amber px-3 py-2 rounded-pill fw-bold">
                                                <i class="fas fa-tag me-1"></i> Venta
                                            </span>
                                        @else
                                            <span class="badge bg-rose-soft text-rose px-3 py-2 rounded-pill fw-bold">
                                                <i class="fas fa-key me-1"></i> Arriendo
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($inmueble->imagens && $inmueble->imagens->count() > 0)
                                            <button class="btn btn-sm btn-soft-info rounded-pill px-3 fw-medium"
                                                data-bs-toggle="modal" data-bs-target="#modalImagenes"
                                                onclick="cargarImagenes({{ $inmueble->id }})">
                                                <i class="fa-solid fa-images me-1"></i> Ver ({{ $inmueble->imagens->count() }})
                                            </button>
                                        @else
                                            <span class="text-muted small italic"><i class="far fa-image me-1"></i> Sin imágenes</span>
                                        @endif
                                    </td>

                                    <td>
                                        <button class="btn btn-sm btn-soft-primary rounded-pill px-3 fw-medium"
                                            onclick="mostrarDetalles({{ $inmueble->id }})">
                                            <i class="fa-solid fa-eye me-1"></i> Ver detalles
                                        </button>
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            <a href="{{ route('inmuebles.edit', $inmueble->id) }}"
                                                class="btn btn-sm btn-outline-warning rounded-circle action-btn"
                                                title="Editar">
                                                <i class="fas fa-pen"></i>
                                            </a>

                                            <form action="{{ route('inmuebles.destroy', $inmueble->id) }}" method="POST" class="d-inline-flex m-0">
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

                <!-- PAGINACIÓN -->
                <div class="mt-4 d-flex justify-content-center">
                    {{ $inmuebles->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>
    </div>

    <!-- ESTILOS EXCLUSIVOS DE LA VISTA -->
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
        .bg-amber-soft { background-color: #fef3c7; }
        .text-amber { color: #b45309; }
        .bg-rose-soft { background-color: #ffe4e6; }
        .text-rose { color: #be123c; }

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

        .btn-soft-primary {
            background-color: #e0e7ff;
            color: #4338ca;
            border: none;
        }
        .btn-soft-primary:hover {
            background-color: #c7d2fe;
            color: #3730a3;
        }
    </style>

    <!-- Modal de imágenes -->
    <div class="modal fade" id="modalImagenes" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">

                <div class="modal-header bg-dark text-white rounded-top-4">
                    <h5 class="modal-title fw-bold"><i class="fas fa-images me-2 text-primary"></i>Galeria del Inmueble</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-4 bg-light">
                    <div id="carouselInmueble" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner rounded-3 shadow-sm bg-black" id="carouselInner">
                            <!-- JS INSERTA AQUÍ -->
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselInmueble" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#carouselInmueble" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>

                    <div id="contadorImagenes" class="text-center mt-3 fs-6 fw-bold text-secondary"></div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal: Ver detalles -->
    <div class="modal fade" id="modalVerDetalles" tabindex="-1" aria-labelledby="modalVerDetallesLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header bg-dark text-white rounded-top-4">
                    <h5 class="modal-title fw-bold" id="modalVerDetallesLabel"><i class="fas fa-info-circle me-2 text-primary"></i>Detalles Completos del Inmueble</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body p-4">
                    <div id="contenedorDetalles" class="px-2 py-1">
                        <p class="text-muted">Cargando detalles...</p>
                    </div>

                    <hr class="my-4">

                    <h5 class="fw-bold mb-3 text-center text-dark">
                        <i class="fas fa-camera me-2 text-secondary"></i>Galería Adjunta
                    </h5>

                    <div class="row g-3" id="galeriaDetalles">
                        <p class="text-muted text-center">Cargando imágenes...</p>
                    </div>
                </div>

                <div class="modal-footer border-top-0 bg-light rounded-bottom-4">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Cerrar</button>
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

    detalles.innerHTML = '<p class="text-muted text-center py-3"><i class="fas fa-spinner fa-spin me-2"></i>Cargando detalles...</p>';
    galeria.innerHTML = '<p class="text-muted text-center">Cargando imágenes...</p>';

    // Manejo correcto de la instancia del modal en Bootstrap
    const modalElement = document.getElementById('modalVerDetalles');
    let modal = bootstrap.Modal.getInstance(modalElement);
    if (!modal) {
        modal = new bootstrap.Modal(modalElement);
    }

    fetch(`/inmueble/${inmuebleId}/detalles`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error en el servidor (${response.status})`);
            }
            return response.json();
        })
        .then(data => {
            // Control de precio nulo o no definido
            const precioVal = parseFloat(data.precio);
            const precioFormatted = !isNaN(precioVal) ? `$${precioVal.toLocaleString()}` : 'No especificado';

            detalles.innerHTML = `
                <h4 class="fw-bold text-center mb-3 text-primary">${data.titulo || 'Sin título'}</h4>

                <div class="row g-2">
                    <div class="col-md-6"><div class="p-3 bg-light rounded border"><strong>Dirección:</strong> ${data.direccion || 'N/A'}</div></div>
                    <div class="col-md-6"><div class="p-3 bg-light rounded border"><strong>Tipo de oferta:</strong> ${data.tipoOferta || 'N/A'}</div></div>
                    <div class="col-md-6"><div class="p-3 bg-light rounded border"><strong>Tipo de inmueble:</strong> ${data.tipo_inmueble?.nombre || 'N/A'}</div></div>
                    <div class="col-md-6"><div class="p-3 bg-light rounded border"><strong>Municipio:</strong> ${data.municipio?.nombre || 'N/A'}</div></div>
                    <div class="col-md-6"><div class="p-3 bg-light rounded border"><strong>Barrio:</strong> ${data.barrio?.nombre || 'N/A'}</div></div>
                    <div class="col-md-6"><div class="p-3 bg-light rounded border"><strong>Usuario:</strong> ${data.usuario?.nombre || 'N/A'}</div></div>
                    <div class="col-md-4"><div class="p-3 bg-light rounded border"><strong>Precio:</strong> ${precioFormatted}</div></div>
                    <div class="col-md-4"><div class="p-3 bg-light rounded border"><strong>Área:</strong> ${data.area || '0'} m²</div></div>
                    <div class="col-md-4"><div class="p-3 bg-light rounded border"><strong>Baños:</strong> ${data.nBaños || '0'}</div></div>
                    <div class="col-md-6"><div class="p-3 bg-light rounded border"><strong>Estado publicación:</strong> ${data.estadoPublicacion || 'N/A'}</div></div>
                    <div class="col-md-6"><div class="p-3 bg-light rounded border"><strong>Fecha publicación:</strong> ${data.fechaPublicacion || 'N/A'}</div></div>
                    <div class="col-md-12"><div class="p-3 bg-light rounded border"><strong>Descripción:</strong><br>${data.descripcion || 'Sin descripción'}</div></div>
                </div>
            `;

            // Galería
            if (!data.imagenes || data.imagenes.length === 0) {
                galeria.innerHTML = `<p class="text-muted text-center">Sin imágenes disponibles.</p>`;
            } else {
                let html = "";
                data.imagenes.forEach(img => {
                    html += `
                    <div class="col-md-4 col-sm-6">
                        <div class="card shadow-sm border-0 overflow-hidden">
                            <img src="${img.url_imagen}" class="card-img-top rounded" alt="Imagen inmueble" style="height:180px; object-fit:cover;">
                        </div>
                    </div>`;
                });
                galeria.innerHTML = html;
            }

            modal.show();
        })
        .catch(error => {
            console.error('Error al cargar detalles:', error);
            detalles.innerHTML = `<p class="text-danger text-center font-bold">No se pudieron cargar los detalles de este inmueble. Revisa que el registro tenga datos válidos en la BD.</p>`;
            modal.show();
        });
}

    document.addEventListener('DOMContentLoaded', function() {

        // --- SELECT DEPENDIENTE: Municipio -> Barrios ---
        const selectMunicipio = document.getElementById('selectMunicipio');
        const selectBarrio = document.getElementById('selectBarrio');

        selectMunicipio?.addEventListener('change', function() {
            const id = this.value;

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

        // --- AUTOCOMPLETADO ---
        const input = document.getElementById('buscador');
        const box = document.getElementById('sugerencias');

        const tituloInput = document.querySelector('input[name="titulo"]');
        const direccionInput = document.querySelector('input[name="direccion"]');
        const usuarioInput = document.querySelector('input[name="usuario"]');

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
                            input.value = item.titulo;

                            if (tituloInput) tituloInput.value = item.titulo;
                            if (direccionInput) direccionInput.value = item.direccion;
                            if (usuarioInput) usuarioInput.value = item.usuario_nombre ?? '';

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

        document.addEventListener('click', function(e) {
            if (!input?.contains(e.target) && !box?.contains(e.target)) {
                if (box) box.style.display = 'none';
            }
        });

    });
</script>

