@extends('layout.app')

@section('title', 'Crear Inmueble')

@section('content')

    <div class="container mt-4 animate-fade">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #198754, #157347);">
                <h5 class="mb-0 fw-bold">
                    <i class="fa-solid fa-shop"></i> Crear Nuevo Inmueble
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

            <div class="card-body p-4">
                <form action="{{ route('inmuebles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Tipo de inmueble --}}
                    <div class="mb-3">
                        <label for="idTipoInmueble" class="form-label">Tipo de Inmueble</label>
                        <select name="idTipoInmueble" id="idTipoInmueble" class="form-select @error('idTipoInmueble') is-invalid @enderror" >
                            <option value="">Seleccione...</option>
                            @foreach ($tipos as $tipo)
                                <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                            @endforeach
                        </select>
                        @error('idTipoInmueble')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Sección dinámica --}}
                    <div id="campos-dinamicos">
                        {{-- Aquí se mostrarán los campos según el tipo --}}
                    </div>

                    {{-- Imágenes --}}
                    <div class="mb-3">
                        <label class="form-label">Imágenes</label>
                        <input type="file" name="imagenes[]" multiple accept="image/*" class="form-control"
                            id="imagenes">
                            @error('imagenes.*')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        <div id="preview" class="mt-2 d-flex flex-wrap gap-2"></div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('inmuebles.index') }}"
                            class="btn btn-outline-secondary rounded-pill px-4 me-2 shadow-sm">
                            <i class="fas fa-arrow-left"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-success rounded-pill px-4 shadow-sm">
                            <i class="fa-solid fa-floppy-disk"></i> Guardar
                        </button>
                    </div>
                </form>
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

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
            border-color: #198754;
        }

        .btn-success,
        .btn-outline-secondary {
            font-weight: 500;
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background-color: #157347;
            transform: translateY(-2px);
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d;
            color: #fff;
            transform: translateY(-2px);
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

        .animate-fade {
            animation: fadeIn 0.5s ease-in-out;
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
                <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror">
                ${error('titulo')}
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Dirección</label>
                <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror">
                ${error('direccion')}
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Usuario</label>
                <select class="form-select @error('idUsuario') is-invalid @enderror" name="idUsuario">
                    <option value="">Seleccione...</option>
                    ${usuarios.map(u => `<option value="${u.id}">${u.nombre}</option>`).join('')}
                </select>
                ${error('idUsuario')}
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 mb-3">
                <label class="form-label">Tipo de oferta</label>
                <select class="form-select @error('tipoOferta') is-invalid @enderror" name="tipoOferta">
                    <option value="">Seleccione...</option>
                    <option value="venta">Venta</option>
                    <option value="arriendo">Arriendo</option>
                    <option value="venta y arriendo">Venta y Arriendo</option>
                </select>
                ${error('tipoOferta')}
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Municipio</label>
                <select class="form-select @error('idMunicipio') is-invalid @enderror" name="idMunicipio" id="idMunicipio">
                    <option value="">Seleccione...</option>
                    ${municipios.map(m => `<option value="${m.id}">${m.nombre}</option>`).join('')}
                </select>
                ${error('idMunicipio')}
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Barrio</label>
                <select class="form-select @error('idBarrio') is-invalid @enderror" name="idBarrio" id="idBarrio">
                    <option value="">Seleccione...</option>
                </select>
                ${error('idBarrio')}
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Precio</label>
                <input type="number" step="0.01" name="precio" class="form-control @error('precio') is-invalid @enderror">
                ${error('precio')}
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Área (m²)</label>
                <input type="number" name="area" class="form-control @error('area') is-invalid @enderror">
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
                    <input type="number" name="precioAdministracion" step="0.01" class="form-control">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Piso</label>
                    <input type="number" name="pisoNumero" class="form-control">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Habitaciones</label>
                    <input type="number" name="nHabitaciones" class="form-control">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Baños</label>
                    <input type="number" name="nBaños" class="form-control">
                </div>
            </div>`;
        }

        if (tipo === 'casa') {
            html += `
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Habitaciones</label>
                    <input type="number" name="nHabitaciones" class="form-control">
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Baños</label>
                    <input type="number" name="nBaños" class="form-control">
                </div>
            </div>`;
        }

        if (tipo === 'local comercial') {
            html += `
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label class="form-select @error('banos') is-invalid @enderror">Baño disponible</label>
                    <select name="banos" class="form-select">
                        <option value="0">No</option>
                        <option value="1">Sí</option>
                    </select>
                </div>
            </div>`;
        }

        // DESCRIPCIÓN + ESTADO
        html += `
        <div class="col-md-12 mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3"></textarea>
            ${error('descripcion')}
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Estado</label>
                <select class="form-select @error('estadoPublicacion') is-invalid @enderror" name="estadoPublicacion">
                    <option value="">Seleccione...</option>
                    <option value="disponible">Disponible</option>
                    <option value="arrendado">Arrendado</option>
                    <option value="vendido">Vendido</option>
                    <option value="reservado">Reservado</option>
                    <option value="inactivo">Inactivo</option>
                </select>
                ${error('estadoPublicacion')}
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Fecha de publicación</label>
                <input type="date" name="fechaPublicacion" class="form-control @error('fechaPublicacion') is-invalid @enderror">
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
                barrioSelect.innerHTML = '<option value="">Seleccione...</option>';

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
                img.classList.add('rounded', 'shadow', 'p-1');
                img.style.width = '120px';
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });

});
</script>

@endsection
