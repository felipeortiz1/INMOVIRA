@extends('layout.app')

@section('titulo', 'Editar usuario')

@section('content')
    <div class="container mt-4 animate-fade">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg, #ffc107, #e0a800);">
                <h5 class="mb-0 fw-bold">
                    <i class="fas fa-fw fa-user"></i> Editar Inmueble
                </h5>
            </div>

            <div class="card-body">
                <form action="{{ route('usuario.update', $usuario->id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            value="{{ $usuario->nombre }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ $usuario->email }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono"
                            value="{{ $usuario->telefono }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="tipoUsuario" class="form-label">Tipo de Usuario</label>
                        <select class="form-select" name="tipoUsuario" id="tipoUsuario" required>
                            <option value="persona" @if ($usuario->tipoUsuario == 'persona') selected @endif>Persona</option>

                            <option value="inmobiliaria" @if ($usuario->tipoUsuario == 'inmobiliaria') selected @endif>Inmobiliaria
                            </option>
                        </select>
                    </div>

                    <div class="mb-3" id="empresaContainer" style="display:none;">
                        <label for="nombreEmpresa" class="form-label">Nombre de la Empresa</label>
                        <input type="text" name="nombreEmpresa" id="nombreEmpresa" class="form-control"
                            value="{{ $usuario->nombreEmpresa }}">
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('usuario.index') }}"
                            class="btn btn-outline-secondary rounded-pill px-4 me-2 shadow-sm">
                            <i class="fas fa-arrow-left"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-warning rounded-pill px-4 shadow-sm">
                            <i class="fa-solid fa-pen-to-square"></i> Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

    <style>
        .card {
            background-color: #fff;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
            border-color: #198754;
        }

        .btn-success,
        .btn-outline-secondary {
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
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade {
            animation: fadeIn 0.5s ease-in-out;
        }
    </style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tipoUsuario = document.getElementById('tipoUsuario');
        const empresaContainer = document.getElementById('empresaContainer');
        const inputEmpresa = document.getElementById('nombreEmpresa');

        tipoUsuario.addEventListener('change', function() {
            if (this.value === 'inmobiliaria') {
                empresaContainer.style.display = 'block';
                inputEmpresa.setAttribute('required', 'required');
            } else {
                empresaContainer.style.display = 'none';
                inputEmpresa.removeAttribute('required');
                inputEmpresa.value = '';
            }
        });
    });
</script>
