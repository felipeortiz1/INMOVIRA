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

                {{-- Tabla de Inmuebles --}}
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center shadow-sm">
                        <thead class="table-primary">
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Dirección</th>
                                <th>Usuario</th>
                                <th>Tipo de Oferta</th>
                                <th>Imagenes</th>
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
                                            <button class="btn btn-info btn-sm rounded-pill shadow-sm me-1" data-bs-toggle="modal" data-bs-target="#modalImagenes">
                                                <i class="fa-solid fa-eye"></i> Ver ({{ $inmueble->imagens->count() }})
                                            </button>
                                        @else
                                            <span class="text-muted">Sin imágenes</span>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Botón para ver detalles -->
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

        /*Flechas del carrusel del modal imagenes*/
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            filter: invert(0) brightness(0);
            /* Vuelve las flechas negras */
        }
    </style>


    <!-- Modal de imágenes -->
    <div class="modal fade" id="modalImagenes" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <!-- Encabezado -->
                <div class="modal-header">
                    <h5 class="modal-title">Imágenes del Inmueble</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Cuerpo -->
                <div class="modal-body">

                    <!-- Carrusel -->
                    <div id="carouselInmueble" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">

                            @foreach ($inmueble->imagens as $key => $img)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $img->ruta) }}" class="d-block mx-auto rounded"
                                        style="width: 100%; max-height: 450px; object-fit: contain;">
                                </div>
                            @endforeach

                        </div>

                        <!-- Flechas -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselInmueble"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"
                                style="filter: invert(70%) sepia(90%) saturate(500%) hue-rotate(10deg) brightness(1.2);">
                            </span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#carouselInmueble"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon"
                                style="filter: invert(70%) sepia(90%) saturate(500%) hue-rotate(10deg) brightness(1.2);">
                            </span>
                        </button>
                    </div>

                    <!-- Contador dinámico -->
                    <div id="contadorImagenes" class="text-center mt-3 fs-5 fw-bold"></div>

                </div>

            </div>
        </div>
    </div>




    <!-- Modal para ver detalles del inmueble -->
    <div class="modal fade" id="modalVerDetalles" tabindex="-1" aria-labelledby="modalVerDetallesLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalVerDetallesLabel">Detalles del Inmueble</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div id="contenedorDetalles" class="px-3 py-2">
                        <p class="text-muted">Cargando detalles...</p>
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
            text: "¡Esta acción eliminará el inmueble de forma permanente!",
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


    // Actualizar el contador de imágenes en el carrusel
    document.addEventListener('DOMContentLoaded', function() {
        const carrusel = document.getElementById('carouselInmueble'); // ID del carrusel
        const contador = document.getElementById('contadorImagenes');

        if (carrusel && contador) {
            // Total de imágenes
            const total = carrusel.querySelectorAll('.carousel-item').length;

            // Función para actualizar contador
            function actualizarContador() {
                const activa = carrusel.querySelector('.carousel-item.active');
                const index = Array.from(activa.parentNode.children).indexOf(activa) + 1;
                contador.textContent = `${index} / ${total}`;
            }

            // Inicializar contador
            actualizarContador();

            // Escuchar cambio de slide
            carrusel.addEventListener('slid.bs.carousel', actualizarContador);
        }
    });



    // Mostrar detalles del inmueble en el modal
    function mostrarDetalles(inmuebleId) {
        const contenedor = document.getElementById('contenedorDetalles');
        contenedor.innerHTML = '<p class="text-muted">Cargando detalles...</p>';

        fetch(`/inmueble/${inmuebleId}/detalles`)
            .then(response => response.json())
            .then(data => {
                contenedor.innerHTML = `
                    <h5 class="fw-bold text-center mb-3">${data.titulo}</h5>
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
                        <li class="list-group-item"><strong>Descripción:</strong><br>${data.descripcion}</li>
                    </ul>
                `;

                const modal = new bootstrap.Modal(document.getElementById('modalVerDetalles'));
                modal.show();
            })
            .catch(error => {
                console.error('Error al cargar detalles:', error);
                contenedor.innerHTML = '<p class="text-danger">No se pudieron cargar los detalles.</p>';
            });
    }
</script>
