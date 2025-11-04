@extends('layout.app')

@section('titulo', 'Editar Inmueble')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-warning text-dark">
        <i class="bi bi-pencil-square"></i> Editar inmueble
    </div>
    <div class="card-body">
        <form action="{{ route('inmuebles.update', $inmueble->id) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Título</label>
                    <input type="text" name="titulo" class="form-control" value="{{ $inmueble->titulo }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Dirección</label>
                    <input type="text" name="direccion" class="form-control" value="{{ $inmueble->direccion }}" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Tipo de oferta</label>
                    <select class="form-select" name="tipoOferta" required>
                        <option value="venta" {{ $inmueble->tipoOferta == 'venta' ? 'selected' : '' }}>Venta</option>
                        <option value="arriendo" {{ $inmueble->tipoOferta == 'arriendo' ? 'selected' : '' }}>Arriendo</option>
                        <option value="venta y arriendo" {{ $inmueble->tipoOferta == 'venta y arriendo' ? 'selected' : '' }}>Venta y Arriendo</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Tipo de inmueble</label>
                    <select class="form-select" name="id_tipo" required>
                        @foreach($tipos as $tipo)
                            <option value="{{ $tipo->id }}" {{ $tipo->id == $inmueble->id_tipo ? 'selected' : '' }}>{{ $tipo->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Barrio</label>
                    <select class="form-select" name="id_barrio" required>
                        @foreach($barrios as $barrio)
                            <option value="{{ $barrio->id }}" {{ $barrio->id == $inmueble->id_barrio ? 'selected' : '' }}>{{ $barrio->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Precio</label>
                    <input type="number" name="precio" step="0.01" class="form-control" value="{{ $inmueble->precio }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Precio Administración</label>
                    <input type="number" name="precioAdministracion" step="0.01" class="form-control" value="{{ $inmueble->precioAdministracion }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Área (m²)</label>
                    <input type="number" name="area" step="0.01" class="form-control" value="{{ $inmueble->area }}">
                </div>

                <div class="col-md-2 mb-3">
                    <label class="form-label">Habitaciones</label>
                    <input type="number" name="n_habitaciones" class="form-control" value="{{ $inmueble->n_habitaciones }}">
                </div>

                <div class="col-md-2 mb-3">
                    <label class="form-label">Baños</label>
                    <input type="number" name="n_baños" class="form-control" value="{{ $inmueble->n_baños }}">
                </div>

                <div class="col-md-2 mb-3">
                    <label class="form-label">Parqueaderos</label>
                    <input type="number" name="n_parqueaderos" class="form-control" value="{{ $inmueble->n_parqueaderos }}">
                </div>

                <div class="col-md-2 mb-3">
                    <label class="form-label">Piso</label>
                    <input type="number" name="n_piso" class="form-control" value="{{ $inmueble->n_piso }}">
                </div>

                <div class="col-md-2 mb-3">
                    <label class="form-label">Número de piso</label>
                    <input type="number" name="pisoNumero" class="form-control" value="{{ $inmueble->pisoNumero }}">
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3">{{ $inmueble->descripcion }}</textarea>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Estado de publicación</label>
                    <select class="form-select" name="estadoPublicacion">
                        <option value="activa" {{ $inmueble->estadoPublicacion == 'activa' ? 'selected' : '' }}>Activa</option>
                        <option value="inactiva" {{ $inmueble->estadoPublicacion == 'inactiva' ? 'selected' : '' }}>Inactiva</option>
                        <option value="vendida" {{ $inmueble->estadoPublicacion == 'vendida' ? 'selected' : '' }}>Vendida</option>
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('inmuebles.index') }}" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-warning text-dark">
                    <i class="bi bi-check-circle"></i> Actualizar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
