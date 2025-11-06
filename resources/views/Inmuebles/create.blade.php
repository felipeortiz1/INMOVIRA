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
                <label for="tipoInmueble" class="form-label">Tipo de Inmueble</label>
                <select name="tipoInmueble" id="tipoInmueble" class="form-select" required>
                    <option value="">Seleccione...</option>
                    @foreach($tipos as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Campos comunes --}}
            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" name="titulo" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Dirección</label>
                <input type="text" name="direccion" class="form-control" required>
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
    document.getElementById('tipoInmueble').addEventListener('change', function() {
        const tipo = this.options[this.selectedIndex].text.toLowerCase();
        const contenedor = document.getElementById('campos-dinamicos');
        contenedor.innerHTML = ''; // Limpiamos lo anterior


        // 🏠 Casa o Apartamento
        if (tipo === 'casa' || tipo === 'apartamento') {
            contenedor.innerHTML = `
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Usuario</label>
                    <select class="form-select" name="idUsuario" required>
                        <option value="">Seleccione...</option>
                        @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Tipo de oferta</label>
                    <select class="form-select" name="tipoOferta" required>
                        <option value="">Seleccione...</option>
                        <option value="venta">Venta</option>
                        <option value="arriendo">Arriendo</option>
                        <option value="venta y arriendo">Venta y Arriendo</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Área (m²)</label>
                    <input type="number" name="area" class="form-control" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Baños</label>
                    <input type="number" name="banos" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Habitaciones</label>
                    <input type="number" name="habitaciones" class="form-control" required>
                </div>
            </div>

            <div class="col-md-12 mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3" placeholder="Escribe una breve descripción..."></textarea>
            </div>
        `;

            if (tipo === 'apartamento') {
                contenedor.innerHTML += `
                <div class="mb-3">
                    <label class="form-label">Piso</label>
                    <input type="number" name="piso" class="form-control" required>
                </div>
            `;
            }
        }

        // 🌾 Finca o Lote
        else if (tipo === 'finca' || tipo === 'lote') {
            contenedor.innerHTML = `
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Usuario</label>
                    <select class="form-select" name="idUsuario" required>
                        <option value="">Seleccione...</option>
                        @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Tipo de oferta</label>
                    <select class="form-select" name="tipoOferta" required>
                        <option value="">Seleccione...</option>
                        <option value="venta">Venta</option>
                        <option value="arriendo">Arriendo</option>
                        <option value="venta y arriendo">Venta y Arriendo</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Área (m²)</label>
                <input type="number" name="area" class="form-control" required>
            </div>

            <div class="col-md-12 mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3" placeholder="Escribe una breve descripción..."></textarea>
            </div>
        `;
        }

        // 🏢 Local
        else if (tipo === 'local comercial') {
            contenedor.innerHTML = `
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Usuario</label>
                    <select class="form-select" name="idUsuario" required>
                        <option value="">Seleccione...</option>
                        @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Tipo de oferta</label>
                    <select class="form-select" name="tipoOferta" required>
                        <option value="">Seleccione...</option>
                        <option value="venta">Venta</option>
                        <option value="arriendo">Arriendo</option>
                        <option value="venta y arriendo">Venta y Arriendo</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Área (m²)</label>
                    <input type="number" name="area" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Baño disponible</label>
                    <select name="banos" class="form-select" required>
                        <option value="0">No</option>
                        <option value="1">Sí</option>
                    </select>
                </div>
            </div>

            <div class="col-md-12 mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3" placeholder="Escribe una breve descripción..."></textarea>
            </div>
        `;
        }
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