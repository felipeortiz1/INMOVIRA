@extends('layout.app')

@section('titulo', 'Editar usuario')

@section('content')
    <div class="container-fluid px-4 py-4 animate-fade">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">

                    <!-- Card Header Principal -->
                    <div class="card-header bg-gradient-dark text-white p-4 border-0">
                        <div class="d-flex align-items-center gap-3">
                            <div class="header-icon-box bg-warning text-dark rounded-3 p-3 d-flex align-items-center justify-content-center">
                                <i class="fas fa-user-edit fa-lg"></i>
                            </div>
                            <div>
                                <h4 class="mb-1 fw-bold text-white">Editar Usuario</h4>
                                <p class="mb-0 text-white-50 fs-7">Actualiza la información del perfil del usuario</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4 p-md-5">

                        {{-- Mostrar errores del Request --}}
                        @if ($errors->any())
                            <div class="alert alert-danger rounded-3 border-0 shadow-sm mb-4">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="fas fa-exclamation-triangle text-danger"></i>
                                    <strong class="text-danger">Corrige los siguientes errores:</strong>
                                </div>
                                <ul class="mb-0 ps-3 small">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('usuario.update', $usuario->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-3">
                                {{-- Nombre --}}
                                <div class="col-md-6">
                                    <label class="form-label text-muted small fw-semibold">Nombre Completo</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control border-start-0 ps-0" name="nombre" value="{{ old('nombre', $usuario->nombre) }}">
                                    </div>
                                </div>

                                {{-- Correo Electrónico --}}
                                <div class="col-md-6">
                                    <label class="form-label text-muted small fw-semibold">Correo electrónico</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control border-start-0 ps-0" name="email" value="{{ old('email', $usuario->email) }}">
                                    </div>
                                </div>

                                {{-- Teléfono --}}
                                <div class="col-md-6">
                                    <label class="form-label text-muted small fw-semibold">Teléfono</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-phone-alt"></i></span>
                                        <input type="text" class="form-control border-start-0 ps-0" name="telefono" value="{{ old('telefono', $usuario->telefono) }}">
                                    </div>
                                </div>

                                {{-- Dirección --}}
                                <div class="col-md-6">
                                    <label class="form-label text-muted small fw-semibold">Dirección (opcional)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-location-dot"></i></span>
                                        <input type="text" class="form-control border-start-0 ps-0" name="direccion" value="{{ old('direccion', $usuario->direccion) }}">
                                    </div>
                                </div>

                                {{-- Municipio --}}
                                <div class="col-md-6">
                                    <label for="idMunicipio" class="form-label text-muted small fw-semibold">Municipio</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-city"></i></span>
                                        <select name="idMunicipio" id="idMunicipio" class="form-select border-start-0 ps-0">
                                            <option value="">Seleccione un municipio</option>
                                            @foreach ($municipios as $m)
                                                <option value="{{ $m->id }}" {{ old('idMunicipio', $usuario->idMunicipio) == $m->id ? 'selected' : '' }}>
                                                    {{ $m->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- Tipo de Usuario --}}
                                <div class="col-md-6">
                                    <label class="form-label text-muted small fw-semibold">Tipo de Usuario</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-user-tag"></i></span>
                                        <select name="tipoUsuario" id="tipoUsuario" class="form-select border-start-0 ps-3" required>
                                            <option value="persona" {{ old('tipoUsuario', $usuario->tipoUsuario) == 'persona' ? 'selected' : '' }}>Persona</option>
                                            <option value="inmobiliaria" {{ old('tipoUsuario', $usuario->tipoUsuario) == 'inmobiliaria' ? 'selected' : '' }}>Inmobiliaria</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Contenedor Inmobiliaria --}}
                                <div class="col-12" id="empresaContainer" style="display:none;">
                                    <div class="p-3 bg-light rounded-3 border">
                                        <label class="form-label text-muted small fw-semibold">Nombre de la inmobiliaria</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-building"></i></span>
                                            <input type="text" name="nombreEmpresa" id="nombreEmpresa" class="form-control border-start-0 ps-0" value="{{ old('nombreEmpresa', $usuario->nombreEmpresa) }}">
                                        </div>
                                    </div>
                                </div>

                                {{-- Imagen Actual --}}
                                @if ($usuario->imagen)
                                    <div class="col-12">
                                        <div class="p-3 bg-light rounded-3 border d-flex align-items-center justify-content-between flex-wrap gap-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="{{ asset('storage/' . $usuario->imagen) }}"
                                                    class="img-thumbnail rounded-circle shadow-sm"
                                                    style="width: 80px; height: 80px; object-fit: cover;">
                                                <div>
                                                    <span class="d-block fw-semibold text-dark">Imagen de perfil actual</span>
                                                    <small class="text-muted">Marca la casilla si deseas remover esta imagen</small>
                                                </div>
                                            </div>

                                            <div class="form-check me-2">
                                                <input class="form-check-input" type="checkbox" name="eliminar_imagen" id="eliminar_imagen" value="1">
                                                <label class="form-check-label text-danger fw-semibold" for="eliminar_imagen">
                                                    Eliminar imagen actual
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Cambiar Imagen --}}
                                <div class="col-12">
                                    <label class="form-label text-muted small fw-semibold">Cambiar imagen</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-image"></i></span>
                                        <input type="file" class="form-control border-start-0 ps-0" name="imagen" id="imagen" accept="image/*">
                                    </div>

                                    <div class="mt-3 text-center">
                                        <img id="previewImagen" src="" alt="Vista previa" class="img-thumbnail rounded-circle shadow-sm"
                                            style="display:none; max-height:120px; width:120px; object-fit:cover;">
                                    </div>
                                </div>
                            </div>

                            {{-- Botones de Acción --}}
                            <div class="d-flex justify-content-end align-items-center gap-2 mt-5 pt-3 border-top">
                                <a href="{{ route('usuario.index') }}" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-medium shadow-sm">
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

            const tipoUsuario = document.getElementById('tipoUsuario');
            const empresa = document.getElementById('empresaContainer');
            const preview = document.getElementById('previewImagen');
            const imagen = document.getElementById('imagen');

            function toggleEmpresa() {
                if (tipoUsuario.value === 'inmobiliaria') {
                    empresa.style.display = 'block';
                } else {
                    empresa.style.display = 'none';
                }
            }

            toggleEmpresa();

            tipoUsuario.addEventListener('change', toggleEmpresa);

            if (imagen) {
                imagen.addEventListener('change', function(e) {
                    const file = e.target.files[0];

                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'inline-block';
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }

        });
    </script>
@endsection