@extends('layout.app')

@section('title', 'Perfil')

@section('titleContent', 'Perfil de Administrador')

@section('content')

    <div class="row">

        <div class="col-md-4">

            <div class="card card-primary card-outline">
                <div class="card-body box-profile text-center">

                    {{-- Mostrar avatar (subido) o avatar automático --}}
                    <img id="preview-avatar" 
                    class="avatar-circle"
                    src="@if (Auth::user()->avatar) {{ asset('storage/adminAvatar/' . Auth::user()->avatar) }}
                        @else https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=3c8dbc&color=fff&size=300&bold=true 
                        @endif"
                    alt="Avatar"
                    style="cursor: pointer;"
                    data-bs-toggle="modal"
                    data-bs-target="#modalAvatarView">

                    <h3 class="profile-username mt-3 fw-bold">
                        {{ Auth::user()->name }}
                    </h3>

                    <p class="text-muted">Administrador del sistema</p>

                    <hr>

                    <p class="text-muted mb-1"><strong>Miembro desde:</strong><br>
                        {{ Auth::user()->created_at->format('d/m/Y') }}
                    </p>

                    <p class="text-muted mb-1"><strong>Última actualización:</strong><br>
                        {{ Auth::user()->updated_at->format('d/m/Y H:i') }}
                    </p>

                </div>
            </div>

        </div>

        <div class="col-md-8">

            <div class="card card-primary shadow-sm">
                <div class="card-header">
                    <h3 class="card-title mb-0 fw-bold">
                        <i class="fas fa-id-card"></i> Información Personal
                    </h3>
                </div>

                <div class="card-body">

                    <p><strong>Nombre:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>

                    <p>
                        <strong>Email verificado:</strong>
                        @if (Auth::user()->email_verified_at)
                            <span class="badge badge-success">Sí</span>
                        @else
                            <span class="badge badge-danger">No</span>
                        @endif
                    </p>

                    <hr>

                    <a href="{{ route('perfil.edit') }}" class="btn btn-primary">
                        <i class="fas fa-user-edit"></i> Editar Perfil
                    </a>

                </div>
            </div>

        </div>
    </div>

@endsection


<style>
    .avatar-circle {
        width: 150px;          
        height: 150px;
        object-fit: cover;     
        border-radius: 50%;    
        border: 3px solid #ddd; 
    }
</style>


<div class="modal fade" id="modalAvatarView" tabindex="-1" aria-labelledby="modalAvatarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalAvatarLabel">Foto de Perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">
                <img id="modal-avatar-img"
                    src="@if (Auth::user()->avatar) {{ asset('storage/adminAvatar/' . Auth::user()->avatar) }}
                        @else https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=3c8dbc&color=fff&size=300&bold=true 
                        @endif"
                    class="img-fluid rounded shadow"
                    style="max-height: 400px; object-fit: contain;">
            </div>

        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const url = URL.createObjectURL(file);

        document.getElementById('preview-avatar').src = url;
        document.getElementById('modal-avatar-img').src = url;
    }
</script>


