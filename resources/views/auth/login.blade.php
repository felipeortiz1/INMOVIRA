<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INMOBIROVIRA - Iniciar Sesión</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Fondo con destello blanco */
        body {
            background-color: #000;
            background-image: radial-gradient(circle at center, rgba(255, 255, 255, 0.15), transparent 70%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #dbeafe;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-card {
            background: rgba(15, 23, 42, 0.9);
            border: 1px solid rgba(59, 130, 246, 0.3);
            border-radius: 15px;
            box-shadow: 0 0 25px rgba(59, 130, 246, 0.3);
            padding: 30px;
            width: 100%;
            max-width: 400px;
        }

        .login-card h3 {
            color: #3b82f6;
            text-align: center;
            margin-bottom: 25px;
        }

        /* Inputs: texto y fondo */
        .form-control {
            background-color: rgba(30, 41, 59, 0.9) !important;
            border: 1px solid rgba(59, 130, 246, 0.4);
            color: #e2e8f0 !important;
            caret-color: #93c5fd;
            /* color del cursor */
        }

        .form-control::placeholder {
            color: #9ca3af !important;
        }

        .form-control:focus {
            border-color: #60a5fa;
            box-shadow: 0 0 8px rgba(59, 130, 246, 0.5);
            background-color: rgba(30, 41, 59, 1);
            color: #ffffff !important;
        }

        .form-control:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 30px rgba(30, 41, 59, 0.95) inset !important;
            -webkit-text-fill-color: #f1f5f9 !important;
        }

        /* Ícono del ojo */
        .position-relative .btn-eye {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            cursor: pointer;
        }

        .btn-eye i {
            color: #60a5fa;
        }

        .btn-eye:hover i {
            color: #93c5fd;
        }

        /* Botón principal */
        .btn-primary {
            background-color: #2563eb;
            border: none;
            box-shadow: 0 0 10px rgba(59, 130, 246, 0.6);
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.8);
        }

        /* Enlaces */
        a {
            color: #60a5fa;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
            color: #93c5fd;
        }

        label,
        .form-check-label {
            color: #cbd5e1;
        }
    </style>
</head>

<body>

    <div class="login-card p-4 p-md-5">
        <div class="text-center mb-4">
            <h1 class="brand-logo mb-2">
                <i class="fas fa-store me-2"></i>INMOBIROVIRA
            </h1>
            <p class="text-white" >Sistema de Gestión Inmobiliarias</p>
        </div>

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <!-- Alertas -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">
                    <i class="fas fa-envelope me-2 text-primary"></i>Correo Electrónico
                </label>
                <input type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    id="email"
                    name="email"
                    placeholder="tu@email.com"
                    value="{{ old('email') }}"
                    required>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Contraseña -->
            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">
                    <i class="fas fa-lock me-2 text-primary"></i>Contraseña
                </label>
                <div class="input-group">
                    <input type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        id="password"
                        name="password"
                        placeholder="••••••••"
                        required>
                    <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
                        <i class="fas fa-eye" id="passwordIcon"></i>
                    </button>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Recordarme -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label text-white" for="remember">
                        Recordar sesión
                    </label>
                </div>
            </div>

            <!-- Botón -->
            <button type="submit" class="btn btn-login text-white w-100 mb-4">
                <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
            </button>

            <!-- Enlace de registro -->
            <div class="text-center">
                <p class="text-white mb-0">
                    ¿No tienes una cuenta?
                    <a href="" class="text-decoration-none fw-semibold text-success">
                        Regístrate aquí
                    </a>
                </p>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('passwordIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }

        // Cerrar alertas automáticamente
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
    </script>

</body>

</html>