@extends('layout.app')

@section('title', 'Inmuebles')
@section('titleContent', 'Administrar Inmuebles')

@include('inmuebles.partials.show-modal')

@section('content')
    <div class="container mt-4 animate-fade">
        <div class="card border-0 shadow-lg rounded-4">

            <div class="card-header text-white rounded-top-4"
                style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
                <h5 class="mb-0 fw-bold"><i class="fa-solid fa-shop"></i> Lista de Inmuebles</h5>
            </div>

            <div class="card-body p-4">

                {{-- Botones superiores --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="{{ route('inmuebles.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                        <i class="fas fa-plus-circle"></i> Crear Inmueble
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
                                            <button
                                                class="btn btn-info btn-sm rounded-pill shadow-sm me-1"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalImagenes"
                                                onclick="cargarImagenes({{ $inmueble->id }})"
                                            >
                                                <i class="fa-solid fa-eye"></i> Ver ({{ $inmueble->imagens->count() }})
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

                                        <form action="{{ route('inmuebles.destroy', $inmueble->id) }}"
                                            method="POST" class="d-inline">
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
        th, td {
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

                        <button class="carousel-control-prev" type="button"
                            data-bs-target="#carouselInmueble" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>

                        <button class="carousel-control-next" type="button"
                            data-bs-target="#carouselInmueble" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>

                    </div>

                    <div id="contadorImagenes"
                        class="text-center mt-3 fs-5 fw-bold"></div>

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
    function mostrarDetalles(id) {
        const contenedor = document.getElementById('contenedorDetalles');
        contenedor.innerHTML = '<p class="text-muted">Cargando detalles...</p>';

        fetch(`/inmueble/${id}/detalles`)
            .then(r => r.json())
            .then(data => {
                contenedor.innerHTML = `
                    <h5 class="fw-bold text-center mb-3">${data.titulo}</h5>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Dirección:</strong> ${data.direccion}</li>
                        <li class="list-group-item"><strong>Tipo de oferta:</strong> ${data.tipoOferta}</li>
                        <li class="list-group-item"><strong>Tipo de inmueble:</strong> ${data.tipo_inmueble?.nombre ?? 'N/A'}</li>
                        <li class="list-group-item"><strong>Barrio:</strong> ${data.barrio?.nombre ?? 'N/A'}</li>
                        <li class="list-group-item"><strong>Usuario:</strong> ${data.usuario?.nombre ?? 'N/A'}</li>
                        <li class="list-group-item"><strong>Precio:</strong> $${Number(data.precio).toLocaleString()}</li>
                        <li class="list-group-item"><strong>Área:</strong> ${data.area} m²</li>
                        <li class="list-group-item"><strong>Baños:</strong> ${data.nBaños}</li>
                        <li class="list-group-item"><strong>Estado publicación:</strong> ${data.estadoPublicacion}</li>
                        <li class="list-group-item"><strong>Fecha publicación:</strong> ${data.fechaPublicacion}</li>
                        <li class="list-group-item"><strong>Descripción:</strong><br>${data.descripcion}</li>
                    </ul>
                `;

                new bootstrap.Modal(document.getElementById('modalVerDetalles')).show();
            });
    }
</script>
