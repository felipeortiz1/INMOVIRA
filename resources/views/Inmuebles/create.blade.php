@extends('layout.app')

@section('title', 'Crear Inmueble')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-success text-white">
        <i class="bi bi-plus-circle"></i> Crear nuevo Inmueble
    </div>
    <div class="card-body">
        <form action="{{ route('inmuebles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Tipo de inmueble --}}
            <div class="mb-3">
                <label for="idTipoInmueble" class="form-label">Tipo de Inmueble</label>
                <select name="idTipoInmueble" id="idTipoInmueble" class="form-select" required>
                    <option value="">Seleccione...</option>
                    @foreach($tipos as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Sección dinámica --}}
            <div id="campos-dinamicos">
                {{-- Aquí se mostrarán los campos según el tipo --}}
            </div>

            {{-- Imágenes --}}
            <div class="mb-3">
                <label class="form-label">Imágenes</label>
                <input type="file" name="imagenes[]" multiple class="form-control" id="imagenes">
                <div id="preview" class="mt-2 d-flex flex-wrap gap-2"></div>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>

<script>
    // Script para mostrar campos según el tipo de inmueble
    document.addEventListener('DOMContentLoaded', function () {
    const tipoInmueble = document.getElementById('idTipoInmueble');
    const contenedor = document.getElementById('campos-dinamicos');

    tipoInmueble.addEventListener('change', function () {
        const tipo = this.options[this.selectedIndex].text.toLowerCase();
        contenedor.innerHTML = ''; // limpiar contenido anterior

        // 🏠 Casa o Apartamento
        if (tipo === 'casa' || tipo === 'apartamento') {
            contenedor.innerHTML = `
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Título</label>
                    <input type="text" name="titulo" class="form-control" >
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Dirección</label>
                    <input type="text" name="direccion" class="form-control" >
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Usuario</label>
                    <select class="form-select" name="idUsuario" >
                        <option value="">Seleccione...</option>
                        @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Tipo de oferta</label>
                    <select class="form-select" name="tipoOferta" >
                        <option value="">Seleccione...</option>
                        <option value="venta">Venta</option>
                        <option value="arriendo">Arriendo</option>
                        <option value="venta y arriendo">Venta y Arriendo</option>
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Municipio</label>
                    <select class="form-select" name="idMunicipio" id="idMunicipio" >
                        <option value="">Seleccione...</option>
                        @foreach($municipios as $municipio)
                        <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="campo-barrio" class="col-md-3 mb-3">
                    <label class="form-label">Barrio</label>
                    <select class="form-select" name="idBarrio" id="idBarrio" >
                        <option value="">Seleccione un barrio</option>
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Precio</label>
                    <input type="number" name="precio" step="0.01" class="form-control" placeholder="Ej: 250000000">
                </div>
            </div>
            `;

            if (tipo === 'apartamento') {
                contenedor.innerHTML += `
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Precio Administración</label>
                        <input type="number" name="precioAdministracion" step="0.01" class="form-control" placeholder="Ej: 150000">
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Piso</label>
                        <input type="number" name="pisoNumero" class="form-control" >
                    </div>
                </div>
                `;
            }

            contenedor.innerHTML += `
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Área (m²)</label>
                    <input type="number" name="area" class="form-control" >
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Habitaciones</label>
                    <input type="number" name="nhabitaciones" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Baños</label>
                    <input type="number" name="nBaños" class="form-control" >
                </div>
            </div>

            <div class="col-md-12 mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="3" placeholder="Escribe una breve descripción..."></textarea>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Estado</label>
                    <select class="form-select" name="estadoPublicacion" >
                        <option value="">Seleccione...</option>
                        <option value="disponible">Disponible</option>
                        <option value="arrendado">Arrendado</option>
                        <option value="vendido">Vendido</option>
                        <option value="reservado">Reservado</option>
                        <option value="inactivo">Inactivo</option>
                    </select>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="fechaPublicacion" class="form-label">Fecha de publicación</label>
                    <input type="date" name="fechaPublicacion" 
                            id="fechaPublicacion" class="form-control" 
                </div>
            </div>`;
        }

        // 🌾 Finca o Lote
        else if (tipo === 'finca' || tipo === 'lote') {
            contenedor.innerHTML = `
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Título</label>
                    <input type="text" name="titulo" class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Dirección</label>
                    <input type="text" name="direccion" class="form-control" >
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Usuario</label>
                    <select class="form-select" name="idUsuario" >
                        <option value="">Seleccione...</option>
                        @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Tipo de oferta</label>
                    <select class="form-select" name="tipoOferta" >
                        <option value="">Seleccione...</option>
                        <option value="venta">Venta</option>
                        <option value="arriendo">Arriendo</option>
                        <option value="venta y arriendo">Venta y Arriendo</option>
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Municipio</label>
                    <select class="form-select" name="idMunicipio" id="idMunicipio" >
                        <option value="">Seleccione...</option>
                        @foreach($municipios as $municipio)
                        <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Precio</label>
                    <input type="number" name="precio" step="0.01" class="form-control" placeholder="Ej: 250000000">
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Área (m²)</label>
                    <input type="number" name="area" class="form-control" >
                </div>
            </div>

            <div class="col-md-12 mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="3" placeholder="Escribe una breve descripción..."></textarea>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Estado</label>
                    <select class="form-select" name="estadoPublicacion" >
                        <option value="">Seleccione...</option>
                        <option value="disponible">Disponible</option>
                        <option value="arrendado">Arrendado</option>
                        <option value="vendido">Vendido</option>
                        <option value="reservado">Reservado</option>
                        <option value="inactivo">Inactivo</option>
                    </select>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="fechaPublicacion" class="form-label">Fecha de publicación</label>
                    <input type="date" name="fechaPublicacion" 
                            id="fechaPublicacion" class="form-control" 
                </div>
            </div>`;
        }

        // 🏢 Local comercial
        else if (tipo === 'local comercial') {
            contenedor.innerHTML = `

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Título</label>
                    <input type="text" name="titulo" class="form-control" >
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Dirección</label>
                    <input type="text" name="direccion" class="form-control" >
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Usuario</label>
                    <select class="form-select" name="idUsuario" >
                        <option value="">Seleccione...</option>
                        @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2 mb-3">
                    <label class="form-label">Tipo de oferta</label>
                    <select class="form-select" name="tipoOferta" >
                        <option value="">Seleccione...</option>
                        <option value="venta">Venta</option>
                        <option value="arriendo">Arriendo</option>
                        <option value="venta y arriendo">Venta y Arriendo</option>
                    </select>
                </div>

                <div class="col-md-2 mb-3">
                    <label class="form-label">Municipio</label>
                    <select class="form-select" name="idMunicipio" id="idMunicipio" >
                        <option value="">Seleccione...</option>
                        @foreach($municipios as $municipio)
                        <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="campo-barrio" class="col-md-2 mb-3">
                    <label class="form-label">Barrio</label>
                    <select class="form-select" name="idBarrio" id="idBarrio" >
                        <option value="">Seleccione un barrio</option>
                    </select>
                </div>

                <div class="col-md-2 mb-3">
                    <label class="form-label">Precio</label>
                    <input type="number" name="precio" step="0.01" class="form-control" placeholder="Ej: 250000000">
                </div>
            
                <div class="col-md-2 mb-3">
                    <label class="form-label">Área (m²)</label>
                    <input type="number" name="area" class="form-control" >
                </div>

                <div class="col-md-2 mb-3">
                    <label class="form-label">Baño disponible</label>
                    <select name="banos" class="form-select" >
                        <option value="0">No</option>
                        <option value="1">Sí</option>
                    </select>
                </div>
            </div>

            <div class="col-md-12 mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="3" placeholder="Escribe una breve descripción..."></textarea>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Estado</label>
                    <select class="form-select" name="estadoPublicacion" >
                        <option value="">Seleccione...</option>
                        <option value="disponible">Disponible</option>
                        <option value="arrendado">Arrendado</option>
                        <option value="vendido">Vendido</option>
                        <option value="reservado">Reservado</option>
                        <option value="inactivo">Inactivo</option>
                    </select>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="fechaPublicacion" class="form-label">Fecha de publicación</label>
                    <input type="date" name="fechaPublicacion" 
                            id="fechaPublicacion" class="form-control" 
                </div>
            </div>
            `;
        }

        // --- Lógica de filtrado de barrios por municipio ---
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
});

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
</script>
@endsection