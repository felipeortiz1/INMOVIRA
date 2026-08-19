@extends('layout.app')

@section('title', 'Editar Inmueble')

@section('content')

<div class="container-fluid px-4 py-4 animate-fade">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">

                <!-- Card Header Principal -->
                <div class="card-header bg-gradient-dark text-white p-4 border-0">
                    <div class="d-flex align-items-center gap-3">
                        <div class="header-icon-box bg-warning text-dark rounded-3 p-3 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-shop fa-lg"></i>
                        </div>
                        <div>
                            <h4 class="mb-1 fw-bold text-white">Editar Inmueble</h4>
                            <p class="mb-0 text-white-50 fs-7">Actualiza las características, ubicación e imágenes del inmueble</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">

                    {{-- Mostrar errores del Request --}}
                    @if ($errors->any())
                        <div class="alert alert-danger rounded-3 border-0 shadow-sm mb-4">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <i class="fas fa-exclamation-triangle text-danger"></i>
                                <strong class="text-danger">Por favor corrige los siguientes errores:</strong>
                            </div>
                            <ul class="mb-0 ps-3 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('inmuebles.update', $inmueble->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Tipo de inmueble --}}
                        <div class="mb-4">
                            <label for="idTipoInmueble" class="form-label text-muted small fw-semibold">Tipo de Inmueble</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-building"></i></span>
                                <select name="idTipoInmueble" id="idTipoInmueble" class="form-select border-start-0 ps-3 @error('idTipoInmueble') is-invalid @enderror">
                                    <option value="">&nbsp;&nbsp;Seleccione...</option>
                                    @foreach ($tipos as $tipo)
                                        <option value="{{ $tipo->id }}" {{ $inmueble->idTipoInmueble == $tipo->id ? 'selected' : '' }}>
                                            &nbsp;&nbsp;{{ $tipo->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('idTipoInmueble')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Campos dinámicos --}}
                        <div id="campos-dinamicos" class="mb-4"></div>

                        {{-- Imágenes actuales --}}
                        @if ($inmueble->imagens && count($inmueble->imagens) > 0)
                            <div class="mb-4 p-3 bg-light rounded-3 border">
                                <label class="form-label text-muted small fw-semibold d-block">Imágenes actuales</label>
                                <div class="d-flex flex-wrap gap-3">
                                    @foreach ($inmueble->imagens as $imagen)
                                        <div class="d-flex flex-column align-items-center justify-content-between bg-white border rounded-3 p-2 shadow-sm" style="width:130px;">
                                            <img src="{{ asset('storage/' . $imagen->ruta) }}" class="rounded-2 object-fit-cover mb-2" style="width:110px; height:90px;">
                                            <div class="form-check m-0">
                                                <input type="checkbox" name="eliminar_imagenes[]" value="{{ $imagen->id }}" class="form-check-input" id="imagen_{{ $imagen->id }}">
                                                <label class="form-check-label text-danger small fw-semibold" for="imagen_{{ $imagen->id }}">Eliminar</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <small class="text-muted d-block mt-2 fs-7"><i class="fas fa-info-circle me-1"></i>Marca las imágenes que deseas eliminar permanentemente.</small>
                            </div>
                        @endif

                        {{-- Reemplazar / Agregar imágenes --}}
                        <div class="mb-4 p-3 bg-light rounded-3 border">
                            <label class="form-label text-muted small fw-semibold">Reemplazar o agregar imágenes</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-images"></i></span>
                                <input type="file" name="imagenes[]" multiple class="form-control border-start-0 ps-0 @error('imagenes') is-invalid @enderror" id="imagenes">
                            </div>
                            <div id="preview" class="mt-3 d-flex flex-wrap gap-2"></div>
                            <small class="text-muted fs-7 d-block mt-1">Si seleccionas nuevas imágenes, reemplazarán o agregarán a las existentes.</small>

                            @error('imagenes')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                            @error('imagenes.*')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Botones de Acción --}}
                        <div class="d-flex justify-content-end align-items-center gap-2 mt-5 pt-3 border-top">
                            <a href="{{ route('inmuebles.index') }}" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-medium shadow-sm">
                                <i class="fas fa-arrow-left me-1"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-warning rounded-pill px-4 py-2 fw-semibold shadow-sm text-dark">
                                <i class="fa-solid fa-pen-to-square me-1"></i> Actualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Estilos personalizados --}}
<style>
    .bg-gradient-dark {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
    }

    .fs-7 { font-size: 0.8rem; }

    .header-icon-box {
        width: 48px;
        height: 48px;
    }

    .input-group-text {
        border-color: #dee2e6;
    }

    .form-control:focus, .form-select:focus {
        border-color: #ffc107;
        box-shadow: none;
    }

    .input-group:focus-within .input-group-text {
        border-color: #ffc107;
        color: #d97706 !important;
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
        return `@error('${name}') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror`;
    }

    function renderCampos() {
        const tipoId = tipoSelect.value;
        if (!tipoId) { contenedor.innerHTML = ''; return; }

        const tipo = tipos.find(t => t.id == tipoId)?.nombre.toLowerCase() || '';
        let html = '';

        // CAMPOS COMUNES
        html += `
        <div class="row g-3">
            <div class="col-md-4 mb-2">
                <label class="form-label text-muted small fw-semibold">Título</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-heading"></i></span>
                    <input type="text" name="titulo" class="form-control border-start-0 ps-0 @error('titulo') is-invalid @enderror" value="${inmueble.titulo || ''}">
                </div>
                ${error('titulo')}
            </div>

            <div class="col-md-4 mb-2">
                <label class="form-label text-muted small fw-semibold">Dirección</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-location-dot"></i></span>
                    <input type="text" name="direccion" class="form-control border-start-0 ps-0 @error('direccion') is-invalid @enderror" value="${inmueble.direccion || ''}">
                </div>
                ${error('direccion')}
            </div>

            <div class="col-md-4 mb-2">
                <label class="form-label text-muted small fw-semibold">Usuario Creador</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-user"></i></span>
                    <select class="form-select border-start-0 ps-3 @error('idUsuario') is-invalid @enderror" name="idUsuario">
                        <option value="">&nbsp;&nbsp;Seleccione...</option>
                        ${usuarios.map(u => `<option value="${u.id}" ${inmueble.idUsuario == u.id ? 'selected' : ''}>&nbsp;&nbsp;${u.nombre}</option>`).join('')}
                    </select>
                </div>
                ${error('idUsuario')}
            </div>
        </div>

        <div class="row g-3 mt-1">
            <div class="col-md-3 mb-2">
                <label class="form-label text-muted small fw-semibold">Tipo de Oferta</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-tag"></i></span>
                    <select class="form-select border-start-0 ps-3 @error('tipoOferta') is-invalid @enderror" name="tipoOferta">
                        <option value="">&nbsp;&nbsp;Seleccione...</option>
                        <option value="venta" ${inmueble.tipoOferta == 'venta' ? 'selected' : ''}>&nbsp;&nbsp;Venta</option>
                        <option value="arriendo" ${inmueble.tipoOferta == 'arriendo' ? 'selected' : ''}>&nbsp;&nbsp;Arriendo</option>
                        <option value="venta y arriendo" ${inmueble.tipoOferta == 'venta y arriendo' ? 'selected' : ''}>&nbsp;&nbsp;Venta y Arriendo</option>
                    </select>
                </div>
                ${error('tipoOferta')}
            </div>

            <div class="col-md-3 mb-2">
                <label class="form-label text-muted small fw-semibold">Municipio</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-city"></i></span>
                    <select class="form-select border-start-0 ps-3 @error('idMunicipio') is-invalid @enderror" name="idMunicipio" id="idMunicipio">
                        <option value="">&nbsp;&nbsp;Seleccione...</option>
                        @foreach($municipios as $m)
                            <option value="{{ $m->id }}" 
                                {{ $inmueble->idMunicipio == $m->id ? 'selected' : '' }}>
                                &nbsp;&nbsp;{{ $m->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                ${error('idMunicipio')}
            </div>

            <div class="col-md-3 mb-2">
                <label class="form-label text-muted small fw-semibold">Barrio</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-map-pin"></i></span>
                    <select class="form-select border-start-0 ps-3 @error('idBarrio') is-invalid @enderror" name="idBarrio" id="idBarrio">
                        <option value="">&nbsp;&nbsp;Seleccione...</option>
                        @foreach($barrios as $b)
                            <option value="{{ $b->id }}" data-municipio="{{ $b->idMunicipio }}"
                                {{ $inmueble->idBarrio == $b->id ? 'selected' : '' }}>
                                &nbsp;&nbsp;{{ $b->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                ${error('idBarrio')}
            </div>

            <div class="col-md-3 mb-2">
                <label class="form-label text-muted small fw-semibold">Precio ($)</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                    <input type="number" step="0.01" name="precio" class="form-control border-start-0 ps-0 @error('precio') is-invalid @enderror" value="${inmueble.precio || ''}">
                </div>
                ${error('precio')}
            </div>
        </div>

        <div class="row g-3 mt-1">
            <div class="col-md-4 mb-2">
                <label class="form-label text-muted small fw-semibold">Área (m²)</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-ruler-combined"></i></span>
                    <input type="number" name="area" class="form-control border-start-0 ps-0 @error('area') is-invalid @enderror" value="${inmueble.area || ''}">
                </div>
                ${error('area')}
            </div>
        </div>
        `;

        // CAMPOS POR TIPO
        if (tipo === 'apartamento') {
            html += `
            <div class="row g-3 mt-1 p-3 bg-light rounded-3 border mb-3">
                <div class="col-md-3">
                    <label class="form-label text-muted small fw-semibold">Precio Administración</label>
                    <input type="number" name="precioAdministracion" step="0.01" class="form-control @error('precioAdministracion') is-invalid @enderror" value="${inmueble.precioAdministracion || ''}">
                    ${error('precioAdministracion')}
                </div>
                <div class="col-md-3">
                    <label class="form-label text-muted small fw-semibold">Piso</label>
                    <input type="number" name="pisoNumero" class="form-control @error('pisoNumero') is-invalid @enderror" value="${inmueble.pisoNumero || ''}">
                    ${error('pisoNumero')}
                </div>
                <div class="col-md-3">
                    <label class="form-label text-muted small fw-semibold">Habitaciones</label>
                    <input type="number" name="nHabitaciones" class="form-control @error('nHabitaciones') is-invalid @enderror" value="${inmueble.nHabitaciones || ''}">
                    ${error('nHabitaciones')}
                </div>
                <div class="col-md-3">
                    <label class="form-label text-muted small fw-semibold">Baños</label>
                    <input type="number" name="nBaños" class="form-control @error('nBaños') is-invalid @enderror" value="${inmueble.nBaños || ''}">
                    ${error('nBaños')}
                </div>
            </div>`;
        }

        if (tipo === 'casa') {
            html += `
            <div class="row g-3 mt-1 p-3 bg-light rounded-3 border mb-3">
                <div class="col-md-6">
                    <label class="form-label text-muted small fw-semibold">Habitaciones</label>
                    <input type="number" name="nHabitaciones" class="form-control @error('nHabitaciones') is-invalid @enderror" value="${inmueble.nHabitaciones || ''}">
                    ${error('nHabitaciones')}
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted small fw-semibold">Baños</label>
                    <input type="number" name="nBaños" class="form-control @error('nBaños') is-invalid @enderror" value="${inmueble.nBaños || ''}">
                    ${error('nBaños')}
                </div>
            </div>`;
        }

        if (tipo === 'local comercial') {
            html += `
            <div class="row g-3 mt-1 p-3 bg-light rounded-3 border mb-3">
                <div class="col-md-6">
                    <label class="form-label text-muted small fw-semibold">Baño disponible</label>
                    <select name="banos" class="form-select border-start-0 ps-3 @error('banos') is-invalid @enderror">
                        <option value="0" ${inmueble.banos == 0 ? 'selected' : ''}>&nbsp;&nbsp;No</option>
                        <option value="1" ${inmueble.banos == 1 ? 'selected' : ''}>&nbsp;&nbsp;Sí</option>
                    </select>
                    ${error('banos')}
                </div>
            </div>`;
        }

        // DESCRIPCIÓN + ESTADO
        html += `
        <div class="row g-3 mt-1">
            <div class="col-md-12 mb-2">
                <label class="form-label text-muted small fw-semibold">Descripción</label>
                <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" rows="3">${inmueble.descripcion || ''}</textarea>
                ${error('descripcion')}
            </div>
        </div>

        <div class="row g-3 mt-1">
            <div class="col-md-6 mb-2">
                <label class="form-label text-muted small fw-semibold">Estado de Publicación</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-toggle-on"></i></span>
                    <select class="form-select border-start-0 ps-3 @error('estadoPublicacion') is-invalid @enderror" name="estadoPublicacion">
                        <option value="">&nbsp;&nbsp;Seleccione...</option>
                        <option value="disponible" ${inmueble.estadoPublicacion == 'disponible' ? 'selected' : ''}>&nbsp;&nbsp;Disponible</option>
                        <option value="arrendado" ${inmueble.estadoPublicacion == 'arrendado' ? 'selected' : ''}>&nbsp;&nbsp;Arrendado</option>
                        <option value="vendido" ${inmueble.estadoPublicacion == 'vendido' ? 'selected' : ''}>&nbsp;&nbsp;Vendido</option>
                        <option value="reservado" ${inmueble.estadoPublicacion == 'reservado' ? 'selected' : ''}>&nbsp;&nbsp;Reservado</option>
                        <option value="inactivo" ${inmueble.estadoPublicacion == 'inactivo' ? 'selected' : ''}>&nbsp;&nbsp;Inactivo</option>
                    </select>
                </div>
                ${error('estadoPublicacion')}
            </div>

            <div class="col-md-6 mb-2">
                <label class="form-label text-muted small fw-semibold">Fecha de Publicación</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-calendar-alt"></i></span>
                    <input type="date" name="fechaPublicacion" class="form-control border-start-0 ps-0 @error('fechaPublicacion') is-invalid @enderror" value="${inmueble.fechaPublicacion || ''}">
                </div>
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

            barrioSelect.innerHTML = '<option value="">&nbsp;&nbsp;Seleccione...</option>';

            barrios.forEach(b => {
                if (b.idMunicipio == mid) {
                    const opt = document.createElement("option");
                    opt.value = b.id;
                    opt.innerHTML = '&nbsp;&nbsp;' + b.nombre;
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
                img.classList.add('rounded-3', 'shadow-sm', 'border', 'object-fit-cover');
                img.style.width = '100px';
                img.style.height = '100px';
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