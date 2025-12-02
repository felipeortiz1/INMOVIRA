@extends('layout.app')

@section('titulo', 'Crear usuario')

@section('content')

<div class="container mt-4 animate-fade">
    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #198754, #157347);">
            <h5 class="mb-0 fw-bold">
                <i class="fas fa-fw fa-user"></i> Crear Nuevo Usuario
            </h5>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger m-3">
                <strong>Por favor corrige los siguientes errores:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card-body p-4">

            <form action="{{ route('usuario.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" name="email" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Teléfono</label>
                    <input type="text" class="form-control" name="telefono" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipo de Usuario</label>
                    <select name="tipoUsuario" id="tipoUsuario" class="form-select" required>
                        <option value="">Seleccione...</option>
                        <option value="persona">Persona</option>
                        <option value="inmobiliaria">Inmobiliaria</option>
                    </select>
                </div>

                <div id="empresaContainer" style="display:none;">

                    <div class="mb-3">
                        <label class="form-label">Nombre de la Inmobiliaria</label>
                        <input type="text" name="nombreEmpresa" id="nombreEmpresa" class="form-control">
                    </div>

                </div>

                {{-- IMAGEN PARA TODOS --}}
                <div class="mb-3">
                    <label class="form-label">Imagen de perfil</label>
                    <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">

                    <img id="previewImagen"
                        src=""
                        style="display:none;margin-top:10px;max-height:120px;border-radius:10px;">
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('usuario.index') }}" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-floppy-disk"></i> Guardar
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

    const tipoUsuario = document.getElementById('tipoUsuario');
    const empresaContainer = document.getElementById('empresaContainer');
    const nombreEmpresa = document.getElementById('nombreEmpresa');
    const imagen = document.getElementById('imagen');
    const preview = document.getElementById('previewImagen');

    tipoUsuario.addEventListener('change', function() {
        if (this.value === 'inmobiliaria') {
            empresaContainer.style.display = 'block';
            nombreEmpresa.required = true;
        } else {
            empresaContainer.style.display = 'none';
            nombreEmpresa.required = false;
            nombreEmpresa.value = '';
            imagen.value = '';
            preview.style.display = 'none';
        }
    });

    imagen.addEventListener('change', function(e){
        const file = e.target.files[0];

        if(file){
            const reader = new FileReader();

            reader.onload = function(e){
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(file);
        }
    });

});
</script>

@endsection
