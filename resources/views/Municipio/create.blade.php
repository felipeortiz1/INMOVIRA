@extends('layout.app')

@section('titulo', 'Crear Municipio')

@section('content')
<div class="container mt-4">
    <div class="card border-0 shadow-lg rounded-4 animate__animated animate__fadeIn">
        <div class="card-header bg-gradient bg-success text-white py-3 rounded-top-4 d-flex align-items-center">
            <i class="bi bi-plus-circle me-2 fs-5"></i>
            <h4 class="mb-0">Crear Nuevo Municipio</h4>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('municipios.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf

                <div class="mb-4">
                    <label for="nombre" class="form-label fw-semibold">Nombre del Municipio</label>
                    <input 
                        type="text" 
                        class="form-control form-control-lg border-success-subtle shadow-sm" 
                        id="nombre" 
                        name="nombre"
                        placeholder="Ej: Málaga" 
                        required
                    >
                    <div class="invalid-feedback">
                        Por favor, ingrese el nombre del municipio.
                    </div>
                </div>

                <div class="mb-4">
                    <label for="codigoPostal" class="form-label fw-semibold">Código Postal</label>
                    <input 
                        type="text" 
                        class="form-control form-control-lg border-success-subtle shadow-sm" 
                        id="codigoPostal" 
                        name="codigoPostal"
                        placeholder="Ej: 2536" 
                        required
                    >
                    <div class="invalid-feedback">
                        El código postal es obligatorio.
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('municipios.index') }}" class="btn btn-outline-secondary btn-lg me-2 shadow-sm">
                        <i class="bi bi-arrow-left"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-success btn-lg shadow-sm">
                        <i class="bi bi-check-circle"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Estilos personalizados --}}
<style>
    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
        border-color: #198754;
    }

    .btn-success {
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

    /* Animación alternativa si no usas animate.css */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate__fadeIn {
        animation: fadeIn 0.4s ease-in-out;
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
