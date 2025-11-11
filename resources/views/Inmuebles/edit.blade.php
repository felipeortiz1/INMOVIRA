@extends('layout.app')

@section('title', 'Editar Inmueble')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-warning text-white">
        <i class="bi bi-pencil-square"></i> Editar Inmueble
    </div>
    <div class="card-body">
        <form action="{{ route('inmuebles.update', $inmueble->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Tipo de inmueble --}}
            <div class="mb-3">
                <label for="idTipoInmueble" class="form-label">Tipo de Inmueble</label>
                <select name="idTipoInmueble" id="idTipoInmueble" class="form-select" required>
                    <option value="">Seleccione...</option>
                    @foreach($tipos as $tipo)
                        <option value="{{ $tipo->id }}" {{ $inmueble->idTipoInmueble == $tipo->id ? 'selected' : '' }}>
                            {{ $tipo->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Campos dinámicos --}}
            <div id="campos-dinamicos">
                {{-- Aquí se cargan los campos según el tipo --}}
            </div>

            {{-- Imágenes actuales --}}
            @if($inmueble->imagens && count($inmueble->imagens) > 0)
                <div class="mb-3">
                    <label class="form-label">Imágenes actuales</label>
                    <div class="d-flex flex-wrap gap-3">
                        @foreach($inmueble->imagens as $imagen)
                            <div class="text-center border rounded p-2 position-relative" style="width:130px;">
                                <img src="{{ asset('storage/' . $imagen->ruta) }}" class="rounded mb-1" width="120">
                                <p class="text-muted small m-0">{{ basename($imagen->ruta) }}</p>

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
                <input type="file" name="imagenes[]" multiple class="form-control" id="imagenes">
                <div id="preview" class="mt-2 d-flex flex-wrap gap-2"></div>
                <small class="text-muted">Si seleccionas nuevas imágenes, reemplazarán las existentes.</small>
            </div>

            <button type="submit" class="btn btn-warning">Actualizar</button>
            <a href="{{ route('inmuebles.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tipoInmueble = document.getElementById('idTipoInmueble');
    const contenedor = document.getElementById('campos-dinamicos');

    function renderCampos(tipoTexto) {
        const tipo = tipoTexto.toLowerCase();
        contenedor.innerHTML = '';

        // Plantilla base reutilizada
        const baseCampos = `
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Título</label>
                    <input type="text" name="titulo" class="form-control" value="{{ $inmueble->titulo }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Dirección</label>
                    <input type="text" name="direccion" class="form-control" value="{{ $inmueble->direccion }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Usuario</label>
                    <select class="form-select" name="idUsuario">
                        <option value="">Seleccione...</option>
                        @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ $inmueble->idUsuario == $usuario->id ? 'selected' : '' }}>
                            {{ $usuario->nombre }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Tipo de oferta</label>
                    <select class="form-select" name="tipoOferta">
                        <option value="">Seleccione...</option>
                        <option value="venta" {{ $inmueble->tipoOferta == 'venta' ? 'selected' : '' }}>Venta</option>
                        <option value="arriendo" {{ $inmueble->tipoOferta == 'arriendo' ? 'selected' : '' }}>Arriendo</option>
                        <option value="venta y arriendo" {{ $inmueble->tipoOferta == 'venta y arriendo' ? 'selected' : '' }}>Venta y Arriendo</option>
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Municipio</label>
                    <select class="form-select" name="idMunicipio" id="idMunicipio">
                        <option value="">Seleccione...</option>
                        @foreach($municipios as $municipio)
                        <option value="{{ $municipio->id }}" 
                            {{ $inmueble->barrio && $inmueble->barrio->idMunicipio == $municipio->id ? 'selected' : '' }}>
                            {{ $municipio->nombre }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div id="campo-barrio" class="col-md-3 mb-3">
                    <label class="form-label">Barrio</label>
                    <select class="form-select" name="idBarrio" id="idBarrio">
                        <option value="">Seleccione un barrio</option>
                        @foreach($barrios as $barrio)
                            @if($inmueble->barrio && $barrio->idMunicipio == $inmueble->barrio->idMunicipio)
                                <option value="{{ $barrio->id }}" {{ $inmueble->idBarrio == $barrio->id ? 'selected' : '' }}>
                                    {{ $barrio->nombre }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Precio</label>
                    <input type="number" name="precio" step="0.01" class="form-control" value="{{ $inmueble->precio }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Área (m²)</label>
                    <input type="number" name="area" class="form-control" value="{{ $inmueble->area }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Habitaciones</label>
                    <input type="number" name="nHabitaciones" class="form-control" value="{{ $inmueble->nHabitaciones }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Baños</label>
                    <input type="number" name="nBaños" class="form-control" value="{{ $inmueble->nBaños }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Estado</label>
                    <select class="form-select" name="estadoPublicacion">
                        <option value="disponible" {{ $inmueble->estadoPublicacion == 'disponible' ? 'selected' : '' }}>Disponible</option>
                        <option value="arrendado" {{ $inmueble->estadoPublicacion == 'arrendado' ? 'selected' : '' }}>Arrendado</option>
                        <option value="vendido" {{ $inmueble->estadoPublicacion == 'vendido' ? 'selected' : '' }}>Vendido</option>
                        <option value="reservado" {{ $inmueble->estadoPublicacion == 'reservado' ? 'selected' : '' }}>Reservado</option>
                        <option value="inactivo" {{ $inmueble->estadoPublicacion == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="3">{{ $inmueble->descripcion }}</textarea>
            </div>

            <div class="mb-3">
                <label for="fechaPublicacion" class="form-label">Fecha de publicación</label>
                <input type="date" name="fechaPublicacion" id="fechaPublicacion" class="form-control"
                    value="{{ $inmueble->fechaPublicacion ? date('Y-m-d', strtotime($inmueble->fechaPublicacion)) : '' }}">
            </div>
        `;

        contenedor.innerHTML = baseCampos;
    }

    // Render inicial según el tipo actual
    renderCampos(tipoInmueble.options[tipoInmueble.selectedIndex].text);

    tipoInmueble.addEventListener('change', function () {
        renderCampos(this.options[this.selectedIndex].text);
    });

    // --- Filtro de barrios por municipio ---
    setTimeout(() => {
        const municipioSelect = document.getElementById('idMunicipio');
        const barrioSelect = document.getElementById('idBarrio');
        if (municipioSelect && barrioSelect) {
            municipioSelect.addEventListener('change', function () {
                const municipioId = this.value;
                barrioSelect.innerHTML = '<option value="">Seleccione un barrio</option>';
                @foreach($barrios as $barrio)
                    if ({{ $barrio->idMunicipio }} == municipioId) {
                        const opt = document.createElement('option');
                        opt.value = '{{ $barrio->id }}';
                        opt.textContent = '{{ $barrio->nombre }}';
                        barrioSelect.appendChild(opt);
                    }
                @endforeach
            });
        }
    }, 100);
});

// Vista previa de imágenes nuevas
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
</script>
@endsection
