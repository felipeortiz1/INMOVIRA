@extends('layout.app')

@section('titulo', 'Editar usuario')

@section('content')
<div class="container mt-4 animate-fade">
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #ffc107, #e0a800);">
            <h5 class="mb-0 fw-bold">
                <i class="fas fa-fw fa-user"></i> Editar Usuario
            </h5>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger m-3">
                <strong>Corrige los siguientes errores:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card-body p-4">

            <form action="{{ route('usuario.update', $usuario->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text"
                           class="form-control"
                           name="nombre"
                           value="{{ $usuario->nombre }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo electrónico</label>
                    <input type="email"
                           class="form-control"
                           name="email"
                           value="{{ $usuario->email }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Teléfono</label>
                    <input type="text"
                           class="form-control"
                           name="telefono"
                           value="{{ $usuario->telefono }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipo de Usuario</label>
                    <select name="tipoUsuario" id="tipoUsuario"
                            class="form-select" required>
                        <option value="persona" {{ $usuario->tipoUsuario == 'persona' ? 'selected' : '' }}>Persona</option>
                        <option value="inmobiliaria" {{ $usuario->tipoUsuario == 'inmobiliaria' ? 'selected' : '' }}>Inmobiliaria</option>
                    </select>
                </div>

                {{-- SOLO INMOBILIARIA --}}
                <div id="empresaContainer" style="display:none;">

                    <div class="mb-3">
                        <label class="form-label">Nombre de la inmobiliaria</label>
                        <input type="text"
                               name="nombreEmpresa"
                               id="nombreEmpresa"
                               class="form-control"
                               value="{{ $usuario->nombreEmpresa }}">
                    </div>

                    {{-- IMAGEN ACTUAL --}}
                    @if($usuario->imagen)
                        <div class="mb-3">
                            <label class="form-label d-block">Imagen actual</label>
                            <img src="{{ asset('storage/'.$usuario->imagen) }}"
                                 style="max-height:120px;border-radius:10px;box-shadow:0 5px 10px rgba(0,0,0,0.15)">
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="eliminar_imagen"
                                   id="eliminar_imagen"
                                   value="1">
                            <label class="form-check-label text-danger" for="eliminar_imagen">
                                Eliminar imagen actual
                            </label>
                        </div>
                    @endif

                    {{-- NUEVA IMAGEN --}}
                    <div class="mb-3">
                        <label class="form-label">Cambiar imagen</label>
                        <input type="file"
                               class="form-control"
                               name="imagen"
                               id="imagen"
                               accept="image/*">

                        <img id="previewImagen"
                            style="margin-top:10px;max-height:140px;border-radius:10px;display:none;">
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">

                    <a href="{{ route('usuario.index') }}"
                       class="btn btn-outline-secondary rounded-pill px-4 me-2">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>

                    <button type="submit" class="btn btn-warning rounded-pill px-4">
                        <i class="fa-solid fa-pen-to-square"></i> Actualizar
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>
@endsection


<script>
document.addEventListener('DOMContentLoaded', function() {

    const tipoUsuario = document.getElementById('tipoUsuario');
    const empresa = document.getElementById('empresaContainer');
    const preview = document.getElementById('previewImagen');
    const imagen = document.getElementById('imagen');

    function toggleEmpresa(){
        if(tipoUsuario.value === 'inmobiliaria'){
            empresa.style.display = 'block';
        } else {
            empresa.style.display = 'none';
        }
    }

    toggleEmpresa();

    tipoUsuario.addEventListener('change', toggleEmpresa);

    if(imagen){
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
    }

});
</script>
