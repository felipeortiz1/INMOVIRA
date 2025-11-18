@extends('layout.app')

@section('titulo', 'Editar Municipio')

@section('content')
<div class="container mt-4">
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-header bg-gradient bg-primary text-white py-3 rounded-top-4">
            <h4 class="mb-0">
                <i class="bi bi-pencil-square me-2"></i> Editar Municipio
            </h4>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('municipios.update', $municipio->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="nombre" class="form-label fw-semibold">Nombre del Municipio</label>
                    <input 
                        type="text" 
                        class="form-control form-control-lg border-primary-subtle shadow-sm" 
                        id="nombre" 
                        name="nombre"
                        value="{{ $municipio->nombre }}" 
                        placeholder="Ingrese el nombre del municipio" 
                        required
                    >
                </div>

                <div class="mb-4">
                    <label for="codigoPostal" class="form-label fw-semibold">Código Postal</label>
                    <input 
                        type="text" 
                        class="form-control form-control-lg border-primary-subtle shadow-sm" 
                        id="codigoPostal" 
                        name="codigoPostal"
                        value="{{ $municipio->codigoPostal }}" 
                        placeholder="Ej: 050001"
                    >
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('municipios.index') }}" class="btn btn-outline-secondary btn-lg me-2">
                        <i class="bi bi-arrow-left"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="bi bi-check-circle"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Opcional: Validación visual con Bootstrap --}}
<script>
    (function () {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
@endsection
