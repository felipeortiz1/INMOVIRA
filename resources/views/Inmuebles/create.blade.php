@extends('layout.app')

@section('titulo', 'Crear Inmueble')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-success text-white">
        <i class="bi bi-plus-circle"></i> Crear nuevo inmueble
    </div>
    <div class="card-body">
        <form action="{{ route('inmuebles.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Título</label>
                    <input type="text" name="titulo" class="form-control" placeholder="Ej: Apartamento en el centro" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Dirección</label>
                    <input type="text" name="direccion" class="form-control" placeholder="Ej: Calle 45 #12-30" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Tipo de oferta</label>
                    <select class="form-select" name="tipoOferta" required>
                        <option value="">Seleccione...</option>
                        <option value="venta">Venta</option>
                        <option value="arriendo">Arriendo</option>
                        <option value="venta y arriendo">Venta y Arriendo</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Tipo de inmueble</label>
                    <select class="form-select" name="id_tipo" required>
                        <option value="">Seleccione...</option>
                        @foreach($tipos as $tipo)
                            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Barrio</label>
                    <select class="form-select" name="id_barrio" required>
                        <option value="">Seleccione...</option>
                        @foreach($barrios as $barrio)
                            <option value="{{ $barrio->id }}">{{ $barrio->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Precio</label>
                    <input type="number" name="precio" step="0.01" class="form-control" placeholder="Ej: 250000000">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Precio Administración</label>
                    <input type="number" name="precioAdministracion" step="0.01" class="form-control" placeholder="Ej: 150000">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Área (m²)</label>
                    <input type="number" name="area" step="0.01" class="form-control" placeholder="Ej: 90.5">
                </div>

                <div class="col-md-2 mb-3">
                    <label class="form-label">Habitaciones</label>
                    <input type="number" name="n_habitaciones" class="form-control" min="0">
                </div>

                <div class="col-md-2 mb-3">
                    <label class="form-label">Baños</label>
                    <input type="number" name="n_baños" class="form-control" min="0">
                </div>

                <div class="col-md-2 mb-3">
                    <label class="form-label">Parqueaderos</label>
                    <input type="number" name="n_parqueaderos" class="form-control" min="0">
                </div>

                <div class="col-md-2 mb-3">
                    <label class="form-label">Piso</label>
                    <input type="number" name="n_piso" class="form-control" min="0">
                </div>

                <div class="col-md-2 mb-3">
                    <label class="form-label">Número de piso</label>
                    <input type="number" name="pisoNumero" class="form-control" min="0">
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3" placeholder="Escribe una breve descripción..."></textarea>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Estado de publicación</label>
                    <select class="form-select" name="estadoPublicacion" required>
                        <option value="activa">Activa</option>
                        <option value="inactiva">Inactiva</option>
                        <option value="vendida">Vendida</option>
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('inmuebles.index') }}" class="btn btn-secondary me-2">
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
