@extends('layout.app')

@section('title', 'Crear Inmueble')

@section('content')
    <div class="container-fluid px-4 py-4 animate-fade">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">

                    <!-- Card Header Principal -->
                    <div class="card-header bg-gradient-dark text-white p-4 border-0">
                        <div class="d-flex align-items-center gap-3">
                            <div class="header-icon-box bg-success text-white rounded-3 p-3 d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-shop fa-lg"></i>
                            </div>
                            <div>
                                <h4 class="mb-1 fw-bold text-white">Crear Nuevo Inmueble</h4>
                                <p class="mb-0 text-white-50 fs-7">Registra una nueva propiedad en el catálogo del sistema</p>
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

                        <form action="{{ route('inmuebles.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Tipo de inmueble --}}
                            <div class="mb-4">
                                <label for="idTipoInmueble" class="form-label text-muted small fw-semibold">Tipo de Inmueble</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-building"></i></span>
                                    <select name="idTipoInmueble" id="idTipoInmueble" class="form-select border-start-0 ps-3 @error('idTipoInmueble') is-invalid @enderror">
                                        <option value="">Seleccione un tipo...</option>
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('idTipoInmueble')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Sección dinámica --}}
                            <div id="campos-dinamicos" class="mb-4">
                                {{-- Aquí se mostrarán los campos según el tipo --}}
                            </div>

                            {{-- Imágenes --}}
                            <div class="mb-4 p-3 bg-light rounded-3 border">
                                <label class="form-label text-muted small fw-semibold">Imágenes del Inmueble</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-images"></i></span>
                                    <input type="file" name="imagenes[]" multiple accept="image/*" class="form-control border-start-0 ps-0" id="imagenes">
                                </div>
                                @error('imagenes.*')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                                <div id="preview" class="mt-3 d-flex flex-wrap gap-2"></div>
                            </div>

                            {{-- Botones de Acción --}}
                            <div class="d-flex justify-content-end align-items-center gap-2 mt-5 pt-3 border-top">
                                <a href="{{ route('inmuebles.index') }}" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-medium shadow-sm">
                                    <i class="fas fa-arrow-left me-1"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-success rounded-pill px-4 py-2 fw-semibold shadow-sm">
                                    <i class="fa-solid fa-floppy-disk me-1"></i> Guardar
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
            border-color: #198754;
            box-shadow: none;
        }

        .input-group:focus-within .input-group-text {
            border-color: #198754;
            color: #198754 !important;
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
                        <input type="text" name="titulo" class="form-control border-start-0 ps-0 @error('titulo') is-invalid @enderror" placeholder="Ej: Casa familiar con jardín">
                    </div>
                    ${error('titulo')}
                </div>

                <div class="col-md-4 mb-2">
                    <label class="form-label text-muted small fw-semibold">Dirección</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-location-dot"></i></span>
                        <input type="text" name="direccion" class="form-control border-start-0 ps-0 @error('direccion') is-invalid @enderror" placeholder="Ej: Carrera 5 # 10-20">
                    </div>
                    ${error('direccion')}
                </div>

                <div class="col-md-4 mb-2">
                    <label class="form-label text-muted small fw-semibold">Usuario Creador</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-user"></i></span>
                        <select class="form-select border-start-0 ps-3 @error('idUsuario') is-invalid @enderror" name="idUsuario">
                            <option value="">Seleccione un usuario...</option>
                            ${usuarios.map(u => `<option value="${u.id}">${u.nombre}</option>`).join('')}
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
                            <option value="">Seleccione...</option>
                            <option value="venta">Venta</option>
                            <option value="arriendo">Arriendo</option>
                            <option value="venta y arriendo">Venta y Arriendo</option>
                        </select>
                    </div>
                    ${error('tipoOferta')}
                </div>

                <div class="col-md-3 mb-2">
                    <label class="form-label text-muted small fw-semibold">Municipio</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-city"></i></span>
                        <select class="form-select border-start-0 ps-3 @error('idMunicipio') is-invalid @enderror" name="idMunicipio" id="idMunicipio">
                            <option value="">Seleccione...</option>
                            ${municipios.map(m => `<option value="${m.id}">${m.nombre}</option>`).join('')}
                        </select>
                    </div>
                    ${error('idMunicipio')}
                </div>

                <div class="col-md-3 mb-2">
                    <label class="form-label text-muted small fw-semibold">Barrio</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-map-pin"></i></span>
                        <select class="form-select border-start-0 ps-3 @error('idBarrio') is-invalid @enderror" name="idBarrio" id="idBarrio">
                            <option value="">Seleccione municipio...</option>
                        </select>
                    </div>
                    ${error('idBarrio')}
                </div>

                <div class="col-md-3 mb-2">
                    <label class="form-label text-muted small fw-semibold">Precio ($)</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-dollar-sign"></i></span>
                        <input type="number" step="0.01" name="precio" class="form-control border-start-0 ps-0 @error('precio') is-invalid @enderror" placeholder="0.00">
                    </div>
                    ${error('precio')}
                </div>
            </div>

            <div class="row g-3 mt-1">
                <div class="col-md-4 mb-2">
                    <label class="form-label text-muted small fw-semibold">Área (m²)</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-ruler-combined"></i></span>
                        <input type="number" name="area" class="form-control border-start-0 ps-0 @error('area') is-invalid @enderror" placeholder="Ej: 85">
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
                        <input type="number" name="precioAdministracion" step="0.01" class="form-control" placeholder="0.00">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-muted small fw-semibold">Piso</label>
                        <input type="number" name="pisoNumero" class="form-control" placeholder="Ej: 4">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-muted small fw-semibold">Habitaciones</label>
                        <input type="number" name="nHabitaciones" class="form-control" placeholder="Ej: 3">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-muted small fw-semibold">Baños</label>
                        <input type="number" name="nBaños" class="form-control" placeholder="Ej: 2">
                    </div>
                </div>`;
            }

            if (tipo === 'casa') {
                html += `
                <div class="row g-3 mt-1 p-3 bg-light rounded-3 border mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Habitaciones</label>
                        <input type="number" name="nHabitaciones" class="form-control" placeholder="Ej: 4">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Baños</label>
                        <input type="number" name="nBaños" class="form-control" placeholder="Ej: 3">
                    </div>
                </div>`;
            }

            if (tipo === 'local comercial') {
                html += `
                <div class="row g-3 mt-1 p-3 bg-light rounded-3 border mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-semibold">Baño disponible</label>
                        <select name="banos" class="form-select @error('banos') is-invalid @enderror">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                    </div>
                </div>`;
            }

            // DESCRIPCIÓN + ESTADO
            html += `
            <div class="row g-3 mt-1">
                <div class="col-md-12 mb-2">
                    <label class="form-label text-muted small fw-semibold">Descripción</label>
                    <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" rows="3" placeholder="Describe los detalles de la propiedad..."></textarea>
                    ${error('descripcion')}
                </div>
            </div>

            <div class="row g-3 mt-1">
                <div class="col-md-6 mb-2">
                    <label class="form-label text-muted small fw-semibold">Estado de Publicación</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-toggle-on"></i></span>
                        <select class="form-select border-start-0 ps-3 @error('estadoPublicacion') is-invalid @enderror" name="estadoPublicacion">
                            <option value="">Seleccione...</option>
                            <option value="disponible">Disponible</option>
                            <option value="arrendado">Arrendado</option>
                            <option value="vendido">Vendido</option>
                            <option value="reservado">Reservado</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>
                    ${error('estadoPublicacion')}
                </div>

                <div class="col-md-6 mb-2">
                    <label class="form-label text-muted small fw-semibold">Fecha de Publicación</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-calendar-alt"></i></span>
                        <input type="date" name="fechaPublicacion" class="form-control border-start-0 ps-0 @error('fechaPublicacion') is-invalid @enderror">
                    </div>
                    ${error('fechaPublicacion')}
                </div>
            </div>`;

            contenedor.innerHTML = html;

            // FILTRAR BARRIOS
            const municipioSelect = document.getElementById('idMunicipio');
            const barrioSelect = document.getElementById('idBarrio');

            if (municipioSelect) {
                municipioSelect.addEventListener('change', function() {
                    const mid = parseInt(this.value);
                    barrioSelect.innerHTML = '<option value="">Seleccione barrio...</option>';

                    barrios
                        .filter(b => b.idMunicipio === mid)
                        .forEach(b => {
                            const opt = document.createElement('option');
                            opt.value = b.id;
                            opt.textContent = b.nombre;
                            barrioSelect.appendChild(opt);
                        });
                });
            }
        }

        // Inicial
        tipoSelect.addEventListener('change', renderCampos);

        // Preview imágenes
        document.getElementById('imagenes').addEventListener('change', function(event) {
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
@endsection