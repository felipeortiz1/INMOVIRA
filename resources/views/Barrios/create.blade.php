@extends('layout.app')

@section('titulo', 'Crear Barrio')

@section('content')
<div class="container mt-4 animate-fade">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #198754, #157347);">
                <h5 class="mb-0 fw-bold">
                    <i class="fa-solid fa-map-pin"></i> Crear Nuevo Barrio
                </h5>
            </div>

        <div class="card-body p-4">
            <form action="{{ route('barrios.store')}}" method="POST" class="needs-validation" novalidate>
                @csrf

                <!-- Nombre -->
                <div class="mb-4">
                    <label for="nombre" class="form-label fw-semibold">Nombre del barrio</label>
                    <input type="text" class="form-control form-control-lg rounded-3 shadow-sm" id="nombre" name="nombre"
                        placeholder="Ej: Chapinero" required>
                    <div class="invalid-feedback">Por favor, ingrese el nombre del barrio.</div>
                </div>

                <!-- Municipio -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Municipio</label>
                    <select class="form-select form-select-lg rounded-3 shadow-sm" name="idMunicipio" id="idMunicipio" required>
                        <option value="">Seleccione un municipio...</option>
                        @foreach($municipios as $municipio)
                            <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Debe seleccionar un municipio válido.</div>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('barrios.index')}}" class="btn btn-outline-secondary px-4 py-2 rounded-pill me-2">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-success px-4 py-2 rounded-pill shadow-sm">
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
