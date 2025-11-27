@extends('layout.app')

@section('title', 'Perfil')

@section('titleContent', 'Editar Perfil de Administrador')

@section('content')

    <div class="row">
        <div class="col-md-4">

            <div class="card card-primary card-outline">
                <div class="card-body box-profile text-center">

                    {{-- Avatar actual o generado --}}
                    <img id="preview-avatar" class="profile-user-img img-fluid img-circle"
                        src="@if (Auth::user()->avatar) {{ asset('storage/adminAvatar/' . Auth::user()->avatar) }}
                          @else
                            https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=3c8dbc&color=fff&size=300&bold=true @endif"
                        alt="Avatar">

                    <h3 class="mt-2">{{ Auth::user()->name }}</h3>
                    <p class="text-muted">Administrador del sistema</p>

                    {{-- Botón para eliminar avatar --}}
                    @if (Auth::user()->avatar)
                        <form action="{{ route('perfil.avatar.delete') }}" method="POST" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Estás seguro de eliminar tu avatar? Se reemplazará por la inicial de tu nombre.')">
                                <i class="fas fa-trash"></i> Eliminar Avatar
                            </button>
                        </form>
                    @endif


                </div>
            </div>

        </div>

        <div class="col-md-8">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Actualizar Información</h3>
                </div>

                <form action="{{ route('perfil.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">

                        {{-- Nombre --}}
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name', Auth::user()->name) }}" required>
                        </div>

                        {{-- Email --}}
                        <div class="form-group mt-3">
                            <label for="email">Correo electrónico</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ old('email', Auth::user()->email) }}" required>
                        </div>

                        {{-- Avatar --}}
                        <div class="form-group mt-3">
                            <label for="avatar">Foto de perfil (opcional)</label>

                            <input type="file" name="avatar" id="avatar" class="form-control" accept="image/*"
                                onchange="previewImage(event)">

                            <small class="text-muted">Se actualizará la vista previa automáticamente.</small>
                        </div>

                        {{-- Contraseña --}}
                        <div class="form-group mt-3">
                            <label for="password">Nueva contraseña (opcional)</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control">
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="togglePassword('password', 'iconPassword')">
                                    <i id="iconPassword" class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Confirmar contraseña --}}
                        <div class="form-group mt-3">
                            <label for="password_confirmation">Confirmar contraseña</label>
                            <div class="input-group">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control">
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="togglePassword('password_confirmation', 'iconConfirm')">
                                    <i id="iconConfirm" class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Botones --}}
                    <div class="card-footer text-right">
                        <a href="{{ route('perfil') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Guardar Cambios
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>

@endsection


{{-- ========================= --}}
{{-- SCRIPT: PREVISUALIZAR AVATAR --}}
{{-- ========================= --}}
@section('js')
    <script>
        function previewImage(event) {
            const imgTag = document.getElementById('preview-avatar');
            const file = event.target.files[0];

            imgTag.src = URL.createObjectURL(file);
        }
    </script>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            } else {
                input.type = "password";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            }
        }
    </script>

@endsection
