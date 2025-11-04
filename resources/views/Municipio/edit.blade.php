@extends('layout.app')

@section('titulo', 'Editar Municipio')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <i class="bi bi-pencil-square"></i> Editar Municipio
    </div>
    <div class="card-body">
        <form action="{{ route('municipios.update', $municipio->id) }}" method="POST">
            
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Municipio</label>
                <input type="text" class="form-control" id="nombre" name="nombre"
                    value="{{ $municipio->nombre }}" required>
            </div>

            <div class="mb-3">
                <label for="codigoPostal" class="form-label">Codigo postaal</label>
                <input type="text" class="form-control" id="codigoPostal" name="codigoPostal"
                    value="{{ $municipio->codigoPostal }}">
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('municipios.index') }}" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection