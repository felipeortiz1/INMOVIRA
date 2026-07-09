@extends('layout.app')

@section('title', 'Editar Inmueble')

@section('content')

<div class="container mt-4 animate-fade">
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #ffc107, #e0a800);">
            <h5 class="mb-0 fw-bold">
                <i class="fa-solid fa-shop"></i> Editar Inmueble
            </h5>
        </div>

        {{-- Mostrar errores del Request --}}
        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <strong>Por favor corrige los siguientes errores:</strong>
                <ul class="mt-2 mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="card-body">
            <form action="{{ route('inmuebles.update', $inmueble->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Tipo de inmueble --}}
                <div class="mb-3">
                    <label for="idTipoInmueble" class="form-label">Tipo de Inmueble</label>
                    <select name="idTipoInmueble" id="idTipoInmueble" class="form-select @error('idTipoInmueble') is-invalid @enderror">
                        <option value="">Seleccione...</option>
                        @foreach ($tipos as $tipo)
                            <option value="{{ $tipo->id }}" {{ $inmueble->idTipoInmueble == $tipo->id ? 'selected' : '' }}>
                                {{ $tipo->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('idTipoInmueble')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Campos dinámicos --}}
                <div id="campos-dinamicos"></div>

                {{-- Imágenes actuales --}}
                @if ($inmueble->imagens && count($inmueble->imagens) > 0)
                    <div class="mb-3">
                        <label class="form-label">Imágenes actuales</label>
                        <div class="d-flex flex-wrap gap-3">
                            @foreach ($inmueble->imagens as $imagen)
                                <div class="d-flex flex-column align-items-center justify-content-center border rounded p-2 position-relative" style="width:130px;">
                                    <img src="{{ asset('storage/' . $imagen->ruta) }}" class="rounded mb-1" width="120">
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="eliminar_imagenes[]" value="{{ $imagen->id }}" class="form-check-input" id="imagen_{{ $imagen->id }}">
                                        <label class="form-check-label small" for="imagen_{{ $imagen->id }}">Eliminar</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <small class="text-muted d-block mt-2">Marca las imágenes que deseas eliminar.</small>
                    </div>
                @endif

                {{-- Reemplazar imágenes --}}
                <div class="mb-3">
                    <label class="form-label">Reemplazar o agregar imágenes</label>
                    <input type="file" name="imagenes[]" multiple class="form-control @error('imagenes') is-invalid @enderror" id="imagenes">
                    <div id="preview" class="mt-2 d-flex flex-wrap gap-2"></div>
                    <small class="text-muted">Si seleccionas nuevas imágenes, reemplazarán las existentes.</small>

                    @error('imagenes')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                    @enderror
                    @error('imagenes.*')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('inmuebles.index') }}" class="btn btn-outline-secondary rounded-pill px-4 me-2 shadow-sm">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-warning rounded-pill px-4 shadow-sm">
                        <i class="fa-solid fa-pen-to-square"></i> Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tipoSelect = document.getElementById('idTipoInmueble');
    const contenedor = document.getElementById('campos-dinamicos');

    const inmueble = @json($inmueble);
    const tipos = @json($tipos);
    const usuarios = @json($usuarios);
    const municipios = @json($municipios);
    const barrios = @json($barrios);

    function error(name) {
        return `@error('${name}') <span class="text-danger small d-block">{{ $message }}</span> @enderror`;
    }

    function renderCampos() {
        const tipoId = tipoSelect.value;
        if (!tipoId) { contenedor.innerHTML = ''; return; }

        const tipo = tipos.find(t => t.id == tipoId)?.nombre.toLowerCase() || '';
        let html = '';

        // CAMPOS COMUNES
        html += `
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Título</label>
                <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror" value="${inmueble.titulo || ''}">
                ${error('titulo')}
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Dirección</label>
                <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror" value="${inmueble.direccion || ''}">
                ${error('direccion')}
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Usuario</label>
                <select class="form-select @error('idUsuario') is-invalid @enderror" name="idUsuario">
                    <option value="">Seleccione...</option>
                    ${usuarios.map(u => `<option value="${u.id}" ${inmueble.idUsuario == u.id ? 'selected' : ''}>${u.nombre}</option>`).join('')}
                </select>
                ${error('idUsuario')}
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 mb-3">
                <label class="form-label">Tipo de oferta</label>
                <select class="form-select @error('tipoOferta') is-invalid @enderror" name="tipoOferta">
                    <option value="">Seleccione...</option>
                    <option value="venta" ${inmueble.tipoOferta == 'venta' ? 'selected' : ''}>Venta</option>
                    <option value="arriendo" ${inmueble.tipoOferta == 'arriendo' ? 'selected' : ''}>Arriendo</option>
                    <option value="venta y arriendo" ${inmueble.tipoOferta == 'venta y arriendo' ? 'selected' : ''}>Venta y Arriendo</option>
                </select>
                ${error('tipoOferta')}
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Municipio</label>
                <select class="form-select @error('idMunicipio') is-invalid @enderror" name="idMunicipio" id="idMunicipio">
                    <option value="">Seleccione...</option>
                    @foreach($municipios as $m)
                        <option value="{{ $m->id }}" 
                            {{ $inmueble->idMunicipio == $m->id ? 'selected' : '' }}>
                            {{ $m->nombre }}
                        </option>
                    @endforeach
                </select>
                ${error('idMunicipio')}
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Barrio</label>
                <select class="form-select @error('idBarrio') is-invalid @enderror" name="idBarrio" id="idBarrio">
                    <option value="">Seleccione...</option>
                    @foreach($barrios as $b)
                        <option value="{{ $b->id }}" data-municipio="{{ $b->idMunicipio }}"
                            {{ $inmueble->idBarrio == $b->id ? 'selected' : '' }}>
                            {{ $b->nombre }}
                        </option>
                    @endforeach
                </select>
                ${error('idBarrio')}
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Precio</label>
                <input type="number" step="0.01" name="precio" class="form-control @error('precio') is-invalid @enderror" value="${inmueble.precio || ''}">
                ${error('precio')}
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Área (m²)</label>
                <input type="number" name="area" class="form-control @error('area') is-invalid @enderror" value="${inmueble.area || ''}">
                ${error('area')}
            </div>
        </div>
        `;

        // CAMPOS POR TIPO
        if (tipo === 'apartamento') {
            html += `
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Precio Administración</label>
                    <input type="number" name="precioAdministracion" step="0.01" class="form-control @error('precioAdministracion') is-invalid @enderror" value="${inmueble.precioAdministracion || ''}">
                    ${error('precioAdministracion')}
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Piso</label>
                    <input type="number" name="pisoNumero" class="form-control @error('pisoNumero') is-invalid @enderror" value="${inmueble.pisoNumero || ''}">
                    ${error('pisoNumero')}
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Habitaciones</label>
                    <input type="number" name="nHabitaciones" class="form-control @error('nHabitaciones') is-invalid @enderror" value="${inmueble.nHabitaciones || ''}">
                    ${error('nHabitaciones')}
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Baños</label>
                    <input type="number" name="nBaños" class="form-control @error('nBaños') is-invalid @enderror" value="${inmueble.nBaños || ''}">
                    ${error('nBaños')}
                </div>
            </div>`;
        }

        if (tipo === 'casa') {
            html += `
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Habitaciones</label>
                    <input type="number" name="nHabitaciones" class="form-control @error('nHabitaciones') is-invalid @enderror" value="${inmueble.nHabitaciones || ''}">
                    ${error('nHabitaciones')}
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Baños</label>
                    <input type="number" name="nBaños" class="form-control @error('nBaños') is-invalid @enderror" value="${inmueble.nBaños || ''}">
                    ${error('nBaños')}
                </div>
            </div>`;
        }

        if (tipo === 'local comercial') {
            html += `
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Baño disponible</label>
                    <select name="banos" class="form-select @error('banos') is-invalid @enderror">
                        <option value="0" ${inmueble.banos == 0 ? 'selected' : ''}>No</option>
                        <option value="1" ${inmueble.banos == 1 ? 'selected' : ''}>Sí</option>
                    </select>
                    ${error('banos')}
                </div>
            </div>`;
        }

        // DESCRIPCIÓN + ESTADO
        html += `
        <div class="col-md-12 mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" rows="3">${inmueble.descripcion || ''}</textarea>
            ${error('descripcion')}
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Estado</label>
                <select class="form-select @error('estadoPublicacion') is-invalid @enderror" name="estadoPublicacion">
                    <option value="">Seleccione...</option>
                    <option value="disponible" ${inmueble.estadoPublicacion == 'disponible' ? 'selected' : ''}>Disponible</option>
                    <option value="arrendado" ${inmueble.estadoPublicacion == 'arrendado' ? 'selected' : ''}>Arrendado</option>
                    <option value="vendido" ${inmueble.estadoPublicacion == 'vendido' ? 'selected' : ''}>Vendido</option>
                    <option value="reservado" ${inmueble.estadoPublicacion == 'reservado' ? 'selected' : ''}>Reservado</option>
                    <option value="inactivo" ${inmueble.estadoPublicacion == 'inactivo' ? 'selected' : ''}>Inactivo</option>
                </select>
                ${error('estadoPublicacion')}
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Fecha de publicación</label>
                <input type="date" name="fechaPublicacion" class="form-control @error('fechaPublicacion') is-invalid @enderror" value="${inmueble.fechaPublicacion || ''}">
                ${error('fechaPublicacion')}
            </div>
        </div>`;

        contenedor.innerHTML = html;

        activarFiltro();
    }

    // Filtro dinámico de municipio → barrio
        function activarFiltro() {
            const municipioSelect = document.getElementById("idMunicipio");
            const barrioSelect = document.getElementById("idBarrio");

            if (!municipioSelect || !barrioSelect) return;

            // FILTRADO AL CAMBIAR MUNICIPIO
            municipioSelect.addEventListener("change", function () {
                const mid = parseInt(this.value);

                barrioSelect.innerHTML = '<option value="">Seleccione...</option>';

                barrios.forEach(b => {
                    if (b.idMunicipio == mid) {
                        const opt = document.createElement("option");
                        opt.value = b.id;
                        opt.textContent = b.nombre;
                        barrioSelect.appendChild(opt);
                    }
                });
            });

            // PRECARGA EN MODO EDICIÓN
            if (typeof inmuebleMunicipio !== "undefined") {
                municipioSelect.value = inmuebleMunicipio;

                // dispara el cambio para cargar barrios correctos
                municipioSelect.dispatchEvent(new Event("change"));

                // selecciona el barrio actual
                barrioSelect.value = inmueble.idBarrio;
            }

        }


    // Render inicial
    renderCampos();

    // Cambio de tipo
    tipoSelect.addEventListener('change', renderCampos);

    // Preview Imágenes
    document.getElementById('imagenes').addEventListener('change', function(event){
        const preview = document.getElementById('preview');
        preview.innerHTML = '';
        [...event.target.files].forEach(file => {
            const reader = new FileReader();
            reader.onload = e => {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('rounded','shadow','p-2');
                img.style.width='120px';
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });

});
</script>
<script>
    const inmuebleMunicipio = {{ $inmueble->barrio->municipio->id }};
</script>

@endsection
