@extends('layout.app')

@section('titulo', 'Crear Municipio')

@section('content')
    <div class="container-fluid px-4 py-4 animate-fade">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">

                    <!-- Card Header Principal -->
                    <div class="card-header bg-gradient-dark text-white p-4 border-0">
                        <div class="d-flex align-items-center gap-3">
                            <div class="header-icon-box bg-success text-white rounded-3 p-3 d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-mountain-city fa-lg"></i>
                            </div>
                            <div>
                                <h4 class="mb-1 fw-bold text-white">Crear Nuevo Municipio</h4>
                                <p class="mb-0 text-white-50 fs-7">Registra una nueva localidad en el sistema</p>
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

                        <form action="{{ route('municipios.store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf

                            {{-- Campo Nombre del Municipio --}}
                            <div class="mb-4">
                                <label for="nombre" class="form-label text-muted small fw-semibold">Nombre del Municipio</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-city"></i></span>
                                    <input type="text"
                                        class="form-control border-start-0 ps-0 @error('nombre') is-invalid @enderror"
                                        id="nombre" name="nombre" placeholder="Ej: Málaga" value="{{ old('nombre') }}">
                                </div>
                                @error('nombre')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Campo Código Postal --}}
                            <div class="mb-4">
                                <label for="codigoPostal" class="form-label text-muted small fw-semibold">Código Postal</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-mail-bulk"></i></span>
                                    <input type="text"
                                        class="form-control border-start-0 ps-0 @error('codigoPostal') is-invalid @enderror"
                                        id="codigoPostal" name="codigoPostal" placeholder="Ej: 2536" value="{{ old('codigoPostal') }}">
                                </div>
                                @error('codigoPostal')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Botones de Acción --}}
                            <div class="d-flex justify-content-end align-items-center gap-2 mt-5 pt-3 border-top">
                                <a href="{{ route('municipios.index') }}"
                                    class="btn btn-outline-dark rounded-pill px-4 py-2 fw-medium shadow-sm">
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

        .form-control:focus {
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

    {{-- Validación visual con Bootstrap --}}
    <script>
        (() => {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
@endsection 