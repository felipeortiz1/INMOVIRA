@extends('layout.app')

@section('titulo', 'Crear usuario')

@section('content')
    <div class="container-fluid px-4 py-4 animate-fade">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">

                    <!-- Card Header Principal -->
                    <div class="card-header bg-gradient-dark text-white p-4 border-0">
                        <div class="d-flex align-items-center gap-3">
                            <div class="header-icon-box bg-success text-white rounded-3 p-3 d-flex align-items-center justify-content-center">
                                <i class="fas fa-user-plus fa-lg"></i>
                            </div>
                            <div>
                                <h4 class="mb-1 fw-bold text-white">Crear Nuevo Usuario</h4>
                                <p class="mb-0 text-white-50 fs-7">Registra una nueva cuenta de persona o inmobiliaria en el sistema</p>
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

                        <form action="{{ route('usuario.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-3">
                                {{-- Nombre --}}
                                <div class="col-md-6">
                                    <label class="form-label text-muted small fw-semibold">Nombre Completo</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control border-start-0 ps-0" name="nombre" value="{{ old('nombre') }}" placeholder="Ej: Lucas" required>
                                    </div>
                                </div>

                                {{-- Correo Electrónico --}}
                                <div class="col-md-6">
                                    <label class="form-label text-muted small fw-semibold">Correo electrónico</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control border-start-0 ps-0" name="email" value="{{ old('email') }}" placeholder="Correo electrónico" required>
                                    </div>
                                </div>

                                {{-- Teléfono --}}
                                <div class="col-md-6">
                                    <label class="form-label text-muted small fw-semibold">Teléfono</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-phone-alt"></i></span>
                                        <input type="text" class="form-control border-start-0 ps-0" name="telefono" value="{{ old('telefono') }}" placeholder="Ej: 3001234567" required>
                                    </div>
                                </div>

                                {{-- Dirección --}}
                                <div class="col-md-6">
                                    <label class="form-label text-muted small fw-semibold">Dirección (opcional)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-location-dot"></i></span>
                                        <input type="text" class="form-control border-start-0 ps-0" name="direccion" value="{{ old('direccion') }}" placeholder="Ej: Calle 10 # 5-20">
                                    </div>
                                </div>

                                {{-- Municipio --}}
                                <div class="col-md-6">
                                    <label for="idMunicipio" class="form-label text-muted small fw-semibold">Municipio</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-city"></i></span>
                                        <select name="idMunicipio" id="idMunicipio" class="form-select border-start-0 ps-0" required>
                                            <option value="">Seleccione un municipio</option>
                                            @foreach ($municipios as $municipio)
                                                <option value="{{ $municipio->id }}" {{ old('idMunicipio') == $municipio->id ? 'selected' : '' }}>
                                                    {{ $municipio->nombre }}
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
                                            <option value="">Seleccione</option>
                                            <option value="persona" {{ old('tipoUsuario') == 'persona' ? 'selected' : '' }}>Persona</option>
                                            <option value="inmobiliaria" {{ old('tipoUsuario') == 'inmobiliaria' ? 'selected' : '' }}>Inmobiliaria</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Contenedor Inmobiliaria --}}
                                <div class="col-12" id="empresaContainer" style="display:none;">
                                    <div class="p-3 bg-light rounded-3 border">
                                        <label class="form-label text-muted small fw-semibold">Nombre de la Inmobiliaria</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-building"></i></span>
                                            <input type="text" name="nombreEmpresa" id="nombreEmpresa" class="form-control border-start-0 ps-0" value="{{ old('nombreEmpresa') }}" placeholder="Ej: Inmobiliaria Los Andes S.A.S">
                                        </div>
                                    </div>
                                </div>

                                {{-- Imagen de Perfil --}}
                                <div class="col-12">
                                    <label class="form-label text-muted small fw-semibold">Imagen de perfil</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-image"></i></span>
                                        <input type="file" name="imagen" id="imagen" class="form-control border-start-0 ps-0" accept="image/*">
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

            const tipoUsuario = document.getElementById('tipoUsuario');
            const empresaContainer = document.getElementById('empresaContainer');
            const nombreEmpresa = document.getElementById('nombreEmpresa');
            const imagen = document.getElementById('imagen');
            const preview = document.getElementById('previewImagen');

            // Mantener visibilidad si regresa por error de validación
            if (tipoUsuario.value === 'inmobiliaria') {
                empresaContainer.style.display = 'block';
                nombreEmpresa.required = true;
            }

            tipoUsuario.addEventListener('change', function() {
                if (this.value === 'inmobiliaria') {
                    empresaContainer.style.display = 'block';
                    nombreEmpresa.required = true;
                } else {
                    empresaContainer.style.display = 'none';
                    nombreEmpresa.required = false;
                    nombreEmpresa.value = '';
                    imagen.value = '';
                    preview.style.display = 'none';
                }
            });

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

        });
    </script>
@endsection