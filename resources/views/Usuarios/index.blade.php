@extends('layout.app')

@section('title','Usuarios')

@section('content')

<div class="container mt-4 animate-fade">
    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-header bg-primary text-white rounded-top-4">
            <h5 class="mb-0 fw-bold">
                <i class="fas fa-users"></i> Lista de usuarios
            </h5>
        </div>

        <div class="card-body p-4">

            <a href="{{ route('usuario.create') }}" class="btn btn-primary mb-3 rounded-pill">
                <i class="fas fa-plus-circle"></i> Crear Usuario
            </a>
            

            <div class="table-responsive">
                <table class="table table-hover text-center align-middle">

                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Tipo</th>
                            <th>Empresa</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($usuarios as $usuario)
                        <tr>

                            <td>{{ $usuario->id }}</td>

                            {{-- IMAGEN --}}
                            <td>
                                @if($usuario->tipoUsuario == 'inmobiliaria' && $usuario->imagen)
                                    <img src="{{ asset('storage/'.$usuario->imagen) }}"
                                        width="60" height="60"
                                        style="object-fit:cover;border-radius:50%;border:2px solid #0d6efd;">
                                @else
                                    <img src="{{ asset('img/usuarios/default.png') }}"
                                        width="60" height="60"
                                        style="object-fit:cover;border-radius:50%;">
                                @endif
                            </td>

                            <td>{{ $usuario->nombre }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->telefono }}</td>

                            <td>
                                @if($usuario->tipoUsuario == 'inmobiliaria')
                                    <span class="badge bg-success">Inmobiliaria</span>
                                @else
                                    <span class="badge bg-secondary">Persona</span>
                                @endif
                            </td>

                            <td>{{ $usuario->nombreEmpresa ?? '—' }}</td>

                            <td>
                                {{-- BOTÓN VER SOLO IMAGEN --}}
                                <a href="{{ route('usuarios.inmuebles', $usuario->id) }}" 
                                    class="btn btn-info btn-sm">
                                    Ver inmuebles
                                </a>




                                {{-- EDITAR --}}
                                <a href="{{ route('usuario.edit',$usuario->id) }}"
                                    class="btn btn-sm btn-warning rounded-pill">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- ELIMINAR --}}
                                <form action="{{ route('usuario.destroy',$usuario->id) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="confirmarEliminacion(event)">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-danger rounded-pill">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                            </td>

                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

            <div class="mt-3 d-flex justify-content-center">
                {{ $usuarios->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
</div>

{{-- ✅ ESTILOS --}}
<style>
.animate-fade{
    animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
    from { opacity:0; transform: translateY(10px); }
    to { opacity:1; transform: translateY(0); }
}

table thead tr {
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

table tbody tr:hover {
    background-color: #f9fafc;
}

th, td {
    padding: 1rem 1.2rem !important;
    vertical-align: middle !important;
}
</style>

{{-- ✅ SWEET ALERT MENSAJES --}}
@if (session('success'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: "{{ session('success') }}",
        confirmButtonText: 'Aceptar'
    });
});
</script>
@endif

@if (session('error'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: "{{ session('error') }}",
        confirmButtonText: 'Aceptar'
    });
});
</script>
@endif


{{-- ✅ MODAL PARA VER SOLO LA IMAGEN --}}
<script>
function verImagen(ruta)
{
    Swal.fire({
        imageUrl: ruta,
        imageWidth: 450,
        imageHeight: 'auto',
        imageAlt: 'Imagen Inmobiliaria',
        showConfirmButton: false,
        background: '#f8fafc',
        showCloseButton: true,
        backdrop: true,
        padding: '20px'
    });
}
</script>

{{-- ✅ CONFIRMAR ELIMINACIÓN --}}
<script>
function confirmarEliminacion(event)
{
    event.preventDefault();
    const form = event.target.closest('form');

    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esta acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>

@endsection
