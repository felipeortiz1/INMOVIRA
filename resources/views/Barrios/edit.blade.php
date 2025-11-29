@extends('layout.app')

@section('titulo', 'Editar Barrio')

@section('content')
    <div class="container mt-4 animate-fade">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #ffc107, #e0a800);">
                <h5 class="mb-0 fw-bold">
                    <i class="fa-solid fa-map-pin"></i> Editar Barrio
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
                <form action="{{ route('barrios.update', $barrio->id) }}" method="POST">
                    @csrf

                    <!-- Nombre -->
                    <div class="mb-4">
                        <label for="nombre" class="form-label fw-semibold">Nombre del barrio</label>
                        <input type="text" class="form-control form-control-lg rounded-3 shadow-sm @error('nombre') is-invalid @enderror" id="nombre"
                            name="nombre" value="{{ $barrio->nombre }}">
                        @error('nombre')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Municipio -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Municipio</label>
                        <select name="idMunicipio" id="idMunicipio" class="form-select form-select-lg rounded-3 shadow-sm @error('idMunicipio') is-invalid @enderror">
                            <option value="">Seleccione un municipio...</option>
                            @foreach ($municipios as $municipio)
                                <option value="{{ $municipio->id }}"
                                    {{ $barrio->idMunicipio == $municipio->id ? 'selected' : '' }}>
                                    {{ $municipio->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('idMunicipio')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Botones -->
                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('barrios.index') }}"
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
        // Validación visual con Bootstrap
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
