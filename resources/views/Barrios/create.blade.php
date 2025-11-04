@extends('layout.app')

@section('titulo', 'Crear Barrio')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-success text-white">
        <i class="bi bi-plus-circle"></i> Crear nuevo barrio
    </div>
    <div class="card-body">
        <form action="{{ route('barrios.store')}}" method="POST">

            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del barrio</label>
                <input type="text" class="form-control" id="nombre" name="nombre"
                    placeholder="Ej: Chapinero" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Municipio</label>
                <select class="form-select" name="idMunicipio" id="idMunicipio">
                    <option value="">Seleccione...</option>
                    @foreach($municipios as $municipio)
                        <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('barrios.index')}}" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Guardar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection