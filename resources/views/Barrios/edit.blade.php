@extends('layout.app')

@section('titulo', 'Editar Barrio')

@section('content')
<div class="container mt-4">
    <div class="card border-0 shadow-lg rounded-4 animate-card">
        <div class="card-header text-white d-flex align-items-center"
             style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
            <i class="fas fa-edit me-2"></i>
            <h5 class="mb-0 fw-bold">Editar información del barrio</h5>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('barrios.update', $barrio->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf

                <!-- Nombre -->
                <div class="mb-4">
                    <label for="nombre" class="form-label fw-semibold">Nombre del barrio</label>
                    <input type="text" class="form-control form-control-lg rounded-3 shadow-sm" 
                           id="nombre" name="nombre" value="{{ $barrio->nombre }}" required>
                    <div class="invalid-feedback">Por favor, ingrese un nombre válido.</div>
                </div>

                <!-- Municipio -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Municipio</label>
                    <select name="idMunicipio" id="idMunicipio" class="form-select form-select-lg rounded-3 shadow-sm" required>
                        <option value="">Seleccione un municipio...</option>
                        @foreach($municipios as $municipio) 
                            <option value="{{ $municipio->id }}" 
                                {{ $barrio->idMunicipio == $municipio->id ? 'selected' : '' }}>
                                {{ $municipio->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Debe seleccionar un municipio válido.</div>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('barrios.index')}}" class="btn btn-outline-secondary px-4 py-2 rounded-pill me-2">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">
                        <i class="fas fa-save"></i> Editar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .animate-card {
        animation: fadeInUp 0.4s ease-in-out;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    input:focus, select:focus {
        box-shadow: 0 0 0 0.2rem rgba(13,110,253,0.25);
        border-color: #0d6efd;
    }

    .btn-primary {
        background: linear-gradient(135deg, #0d6efd, #0a58ca);
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #084298, #052c65);
        transform: translateY(-2px);
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: #fff;
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
