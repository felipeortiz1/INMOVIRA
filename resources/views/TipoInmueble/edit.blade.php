@extends('layout.app')

@section('titulo', 'Editar tipo de inmueble')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-success text-white">
        <i class="bi bi-plus-circle"></i> Editar inmueble
    </div>
    <div class="card-body">
        <form action="{{ route('tipoInmueble.update', $tipoInmueble->id) }}" method="POST">

            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Tipo de inmueble</label>
                <input type="text" class="form-control" id="nombre" name="nombre"
                value="{{ $tipoInmueble->nombre }}" required>

            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('tipoInmueble.index') }}" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Guardar
                </button>
            </div>
        </form>
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
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(25,135,84,0.25);
        border-color: #198754;
    }

    .btn-success, .btn-outline-secondary {
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
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-fade {
        animation: fadeIn 0.5s ease-in-out;
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