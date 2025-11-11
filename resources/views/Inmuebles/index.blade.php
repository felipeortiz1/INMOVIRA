@extends('layout.app')

@section('title', 'Inmuebles')

@section('titleContent', 'Administrar Inmuebles')

@include('inmuebles.partials.show-modal')

@section('content')
<div>
    <a href="{{ route('inmuebles.create') }}" class="btn btn-primary mb-3"> + Crear Inmueble </a>
    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle table-hover">
            <thead class="table-dark">
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
                @foreach($inmuebles as $inmueble)
                <tr>
                    <td>{{ $inmueble->id }}</td>
                    <td>{{ $inmueble->titulo }}</td>
                    <td>{{ $inmueble->direccion }}</td>
                    <td>{{ $inmueble->usuario -> nombre}}</td>
                    <td>{{ ucfirst($inmueble->tipoOferta) }}</td>
                    <td>
                        @if($inmueble->imagens && $inmueble->imagens->count() > 0)
                        <button class="btn btn-info btn-sm" onclick="mostrarImagenes({{ $inmueble->id }})">
                            Ver ({{ $inmueble->imagens->count() }})
                        </button>
                        @else
                        <span class="text-muted">Sin imágenes</span>
                        @endif
                    </td>
                    <td>
                        <!-- Botón para ver detalles -->
                        <button class="btn btn-primary btn-sm" onclick="mostrarDetalles({{ $inmueble->id }})">
                            Ver detalles
                        </button>
                    </td>

                    <td>
                        <a href="{{ route('inmuebles.edit', $inmueble->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('inmuebles.destroy', $inmueble->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" onclick="confirmarEliminacion(event)">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="col-12 text-center my-3">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Volver</a>
    </div>
</div>

<!-- Modal para ver imágenes -->
<div class="modal fade" id="modalVerImagenes" tabindex="-1" aria-labelledby="modalVerImagenesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalVerImagenesLabel">Imágenes del Inmueble</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body text-center">
                <div id="contenedorImagenes" class="d-flex flex-wrap justify-content-center gap-3"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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

@if(session('success'))
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

    // Mostrar imágenes en el modal
    function mostrarImagenes(inmuebleId) {
        fetch(`/inmuebles/${inmuebleId}/imagenes`)
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('imagenesContainer');
                container.innerHTML = '';
                if (data.length > 0) {
                    data.forEach(img => {
                        const imgElement = document.createElement('img');
                        imgElement.src = `/storage/${img.ruta}`;
                        imgElement.className = "img-thumbnail";
                        imgElement.style.width = "180px";
                        imgElement.style.height = "140px";
                        container.appendChild(imgElement);
                    });
                } else {
                    container.innerHTML = '<p class="text-muted">Este inmueble no tiene imágenes.</p>';
                }
                const modal = new bootstrap.Modal(document.getElementById('imagenesModal'));
                modal.show();
            });
    }



    function mostrarImagenes(inmuebleId) {
        // Limpiar contenido anterior
        const contenedor = document.getElementById('contenedorImagenes');
        contenedor.innerHTML = '<p class="text-muted">Cargando imágenes...</p>';

        // Hacer la petición AJAX para obtener las imágenes
        fetch(`/inmueble/${inmuebleId}/imagenes`)
            .then(response => response.json())
            .then(data => {
                contenedor.innerHTML = ''; // limpiar contenido previo

                if (data.length > 0) {
                    data.forEach(img => {
                        const imgElement = document.createElement('img');
                        imgElement.src = img.url_imagen;
                        imgElement.alt = 'Imagen del inmueble';
                        imgElement.classList.add('img-thumbnail');
                        imgElement.style.width = '200px';
                        imgElement.style.height = '150px';
                        imgElement.style.objectFit = 'cover';
                        contenedor.appendChild(imgElement);
                    });
                } else {
                    contenedor.innerHTML = '<p class="text-muted">No hay imágenes para este inmueble.</p>';
                }

                // Mostrar modal
                const modal = new bootstrap.Modal(document.getElementById('modalVerImagenes'));
                modal.show();
            })
            .catch(error => {
                console.error('Error al cargar imágenes:', error);
                contenedor.innerHTML = '<p class="text-danger">Error al cargar las imágenes.</p>';
            });
    }

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