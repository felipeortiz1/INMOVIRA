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

            <div class="card-body">
                <form action="{{ route('inmuebles.update', $inmueble->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Tipo de inmueble --}}
                    <div class="mb-3">
                        <label for="idTipoInmueble" class="form-label">Tipo de Inmueble</label>
                        <select name="idTipoInmueble" id="idTipoInmueble" class="form-select" required>
                            <option value="">Seleccione...</option>
                            @foreach ($tipos as $tipo)
                                <option value="{{ $tipo->id }}"
                                    {{ $inmueble->idTipoInmueble == $tipo->id ? 'selected' : '' }}>
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
                    @if ($inmueble->imagens && count($inmueble->imagens) > 0)
                        <div class="mb-3">
                            <label class="form-label">Imágenes actuales</label>
                            <div class="d-flex flex-wrap gap-3">
                                @foreach ($inmueble->imagens as $imagen)
                                    <div class="d-flex flex-column align-items-center justify-content-center border rounded p-2 position-relative"
                                        style="width:130px;">
                                        <img src="{{ asset('storage/' . $imagen->ruta) }}" class="rounded mb-1"
                                            width="120">

                                        <div class="form-check mt-1">
                                            <input type="checkbox" name="eliminar_imagenes[]" value="{{ $imagen->id }}"
                                                class="form-check-input" id="imagen_{{ $imagen->id }}">
                                            <label class="form-check-label small"
                                                for="imagen_{{ $imagen->id }}">Eliminar</label>
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

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('inmuebles.index') }}"
                            class="btn btn-outline-secondary rounded-pill px-4 me-2 shadow-sm">
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
            const tipoInmueble = document.getElementById('idTipoInmueble');
            const contenedor = document.getElementById('campos-dinamicos');

            function renderCampos(tipoTexto) {
                const tipo = tipoTexto.toLowerCase();
                contenedor.innerHTML = '';

                // 🏠 Casa o Apartamento
                if (tipo === 'casa' || tipo === 'apartamento') {
                    contenedor.innerHTML = `
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Título</label>
                            <input type="text" name="titulo" class="form-control"
                                value="{{ $inmueble->titulo }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Dirección</label>
                            <input type="text" name="direccion" class="form-control"
                                value="{{ $inmueble->direccion }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Usuario</label>
                            <select class="form-select" name="idUsuario">
                                <option value="">Seleccione...</option>
                                @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}"
                                    {{ $inmueble->idUsuario == $usuario->id ? 'selected' : '' }}>
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
                                @foreach ($municipios as $municipio)
                                <option value="{{ $municipio->id }}"
                                    {{ $inmueble->idMunicipio == $municipio->id ? 'selected' : '' }}>
                                    {{ $municipio->nombre }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div id="campo-barrio" class="col-md-3 mb-3">
                            <label class="form-label">Barrio</label>
                            <select class="form-select" name="idBarrio" id="idBarrio">
                                <option value="">Seleccione un barrio</option>
                                @foreach ($barrios as $barrio)
                                @if ($barrio->idMunicipio == $inmueble->idMunicipio)
                                <option value="{{ $barrio->id }}"
                                    {{ $inmueble->idBarrio == $barrio->id ? 'selected' : '' }}>
                                    {{ $barrio->nombre }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label">Precio</label>
                            <input type="number" name="precio" class="form-control" step="0.01"
                                value="{{ $inmueble->precio }}">
                        </div>
                    </div>
                    `;

                    // — SOLO PARA APARTAMENTO —
                    if (tipo === 'apartamento') {
                        contenedor.innerHTML += `
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Precio Administración</label>
                                <input type="number" name="precioAdministracion" class="form-control" step="0.01"
                                    value="{{ $inmueble->precioAdministracion }}">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">Piso</label>
                                <input type="number" name="pisoNumero" class="form-control"
                                    value="{{ $inmueble->pisoNumero }}">
                            </div>
                        </div>
                        `;
                    }

                    contenedor.innerHTML += `
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Área (m²)</label>
                            <input type="number" name="area" class="form-control"
                                value="{{ $inmueble->area }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Habitaciones</label>
                            <input type="number" name="nhabitaciones" class="form-control"
                                value="{{ $inmueble->nhabitaciones }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Baños</label>
                            <input type="number" name="nBaños" class="form-control"
                                value="{{ $inmueble->nBaños }}">
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="3">{{ $inmueble->descripcion }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Estado</label>
                            <select class="form-select" name="estadoPublicacion">
                                <option value="">Seleccione...</option>
                                <option value="disponible" {{ $inmueble->estadoPublicacion == 'disponible' ? 'selected' : '' }}>Disponible</option>
                                <option value="arrendado" {{ $inmueble->estadoPublicacion == 'arrendado' ? 'selected' : '' }}>Arrendado</option>
                                <option value="vendido" {{ $inmueble->estadoPublicacion == 'vendido' ? 'selected' : '' }}>Vendido</option>
                                <option value="reservado" {{ $inmueble->estadoPublicacion == 'reservado' ? 'selected' : '' }}>Reservado</option>
                                <option value="inactivo" {{ $inmueble->estadoPublicacion == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="fechaPublicacion" class="form-label">Fecha de publicación</label>
                            <input type="date" name="fechaPublicacion" id="fechaPublicacion" class="form-control"
                                value="{{ $inmueble->fechaPublicacion }}">
                        </div>
                    </div>
                    `;
                } else if (tipo === 'finca' || tipo === 'lote') {
                    contenedor.innerHTML = `
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Título</label>
                            <input type="text" name="titulo" class="form-control"
                                value="{{ $inmueble->titulo }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Dirección</label>
                            <input type="text" name="direccion" class="form-control"
                                value="{{ $inmueble->direccion }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Usuario</label>
                            <select class="form-select" name="idUsuario">
                                <option value="">Seleccione...</option>
                                @foreach ($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}"
                                        {{ $inmueble->idUsuario == $usuario->id ? 'selected' : '' }}>
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
                                <option value="venta" 
                                    {{ $inmueble->tipoOferta == 'venta' ? 'selected' : '' }}>Venta</option>
                                <option value="arriendo" 
                                    {{ $inmueble->tipoOferta == 'arriendo' ? 'selected' : '' }}>Arriendo</option>
                                <option value="venta y arriendo" 
                                    {{ $inmueble->tipoOferta == 'venta y arriendo' ? 'selected' : '' }}>
                                    Venta y Arriendo
                                </option>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label">Municipio</label>
                            <select class="form-select" name="idMunicipio" id="idMunicipio">
                                <option value="">Seleccione...</option>
                                @foreach ($municipios as $municipio)
                                    <option value="{{ $municipio->id }}"
                                        {{ $inmueble->idMunicipio == $municipio->id ? 'selected' : '' }}>
                                        {{ $municipio->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label">Precio</label>
                            <input type="number" name="precio" step="0.01" class="form-control"
                                value="{{ $inmueble->precio }}">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label">Área (m²)</label>
                            <input type="number" name="area" class="form-control"
                                value="{{ $inmueble->area }}">
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="3">{{ $inmueble->descripcion }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Estado</label>
                            <select class="form-select" name="estadoPublicacion">
                                <option value="">Seleccione...</option>
                                <option value="disponible" 
                                    {{ $inmueble->estadoPublicacion == 'disponible' ? 'selected' : '' }}>Disponible</option>
                                <option value="arrendado" 
                                    {{ $inmueble->estadoPublicacion == 'arrendado' ? 'selected' : '' }}>Arrendado</option>
                                <option value="vendido" 
                                    {{ $inmueble->estadoPublicacion == 'vendido' ? 'selected' : '' }}>Vendido</option>
                                <option value="reservado" 
                                    {{ $inmueble->estadoPublicacion == 'reservado' ? 'selected' : '' }}>Reservado</option>
                                <option value="inactivo" 
                                    {{ $inmueble->estadoPublicacion == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="fechaPublicacion" class="form-label">Fecha de publicación</label>
                            <input type="date" name="fechaPublicacion" id="fechaPublicacion" class="form-control"
                                value="{{ $inmueble->fechaPublicacion }}">
                        </div>
                    </div>
                `;
                } else if (tipo === 'local comercial') {
                    contenedor.innerHTML = `

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Título</label>
                        <input type="text" name="titulo" class="form-control"
                            value="{{ $inmueble->titulo }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Dirección</label>
                        <input type="text" name="direccion" class="form-control"
                            value="{{ $inmueble->direccion }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Usuario</label>
                        <select class="form-select" name="idUsuario">
                            <option value="">Seleccione...</option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}"
                                    {{ $inmueble->idUsuario == $usuario->id ? 'selected' : '' }}>
                                    {{ $usuario->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Tipo de oferta</label>
                        <select class="form-select" name="tipoOferta">
                            <option value="">Seleccione...</option>
                            <option value="venta" 
                                {{ $inmueble->tipoOferta == 'venta' ? 'selected' : '' }}>Venta</option>
                            <option value="arriendo" 
                                {{ $inmueble->tipoOferta == 'arriendo' ? 'selected' : '' }}>Arriendo</option>
                            <option value="venta y arriendo" 
                                {{ $inmueble->tipoOferta == 'venta y arriendo' ? 'selected' : '' }}>
                                Venta y Arriendo
                            </option>
                        </select>
                    </div>

                    <div class="col-md-2 mb-3">
                        <label class="form-label">Municipio</label>
                        <select class="form-select" name="idMunicipio" id="idMunicipio">
                            <option value="">Seleccione...</option>
                            @foreach ($municipios as $municipio)
                                <option value="{{ $municipio->id }}"
                                    {{ $inmueble->idMunicipio == $municipio->id ? 'selected' : '' }}>
                                    {{ $municipio->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div id="campo-barrio" class="col-md-2 mb-3">
                        <label class="form-label">Barrio</label>
                        <select class="form-select" name="idBarrio" id="idBarrio">
                            <option value="">Seleccione un barrio</option>
                            @foreach ($barrios as $barrio)
                                <option value="{{ $barrio->id }}"
                                    {{ $inmueble->idBarrio == $barrio->id ? 'selected' : '' }}>
                                    {{ $barrio->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 mb-3">
                        <label class="form-label">Precio</label>
                        <input type="number" name="precio" step="0.01" class="form-control"
                            value="{{ $inmueble->precio }}">
                    </div>

                    <div class="col-md-2 mb-3">
                        <label class="form-label">Área (m²)</label>
                        <input type="number" name="area" class="form-control"
                            value="{{ $inmueble->area }}">
                    </div>

                    <div class="col-md-2 mb-3">
                        <label class="form-label">Baño disponible</label>
                        <select name="banos" class="form-select">
                            <option value="0" {{ $inmueble->banos == 0 ? 'selected' : '' }}>No</option>
                            <option value="1" {{ $inmueble->banos == 1 ? 'selected' : '' }}>Sí</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3">{{ $inmueble->descripcion }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Estado</label>
                        <select class="form-select" name="estadoPublicacion">
                            <option value="">Seleccione...</option>
                            <option value="disponible" 
                                {{ $inmueble->estadoPublicacion == 'disponible' ? 'selected' : '' }}>Disponible</option>
                            <option value="arrendado" 
                                {{ $inmueble->estadoPublicacion == 'arrendado' ? 'selected' : '' }}>Arrendado</option>
                            <option value="vendido" 
                                {{ $inmueble->estadoPublicacion == 'vendido' ? 'selected' : '' }}>Vendido</option>
                            <option value="reservado" 
                                {{ $inmueble->estadoPublicacion == 'reservado' ? 'selected' : '' }}>Reservado</option>
                            <option value="inactivo" 
                                {{ $inmueble->estadoPublicacion == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="fechaPublicacion" class="form-label">Fecha de publicación</label>
                        <input type="date" name="fechaPublicacion" id="fechaPublicacion"
                            class="form-control" value="{{ $inmueble->fechaPublicacion }}">
                    </div>
                </div>

            `;
                }

                contenedor.innerHTML = baseCampos;
            }

            // Render inicial al cargar la página con el tipo seleccionado
            renderCampos(tipoInmueble.options[tipoInmueble.selectedIndex].text);


            // --- Filtro de barrios por municipio ---
            setTimeout(() => {
                const municipioSelect = document.getElementById('idMunicipio');
                const barrioSelect = document.getElementById('idBarrio');
                if (municipioSelect && barrioSelect) {
                    municipioSelect.addEventListener('change', function() {
                        const municipioId = this.value;
                        barrioSelect.innerHTML = '<option value="">Seleccione un barrio</option>';
                        @foreach ($barrios as $barrio)
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
