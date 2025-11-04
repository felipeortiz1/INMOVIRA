<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supertiendas - Iniciar Sesión</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .brand-logo {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
            font-size: 2.5rem;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px 20px;
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #22c55e;
            box-shadow: 0 0 0 0.2rem rgba(34, 197, 94, 0.25);
        }
        .btn-login {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(34, 197, 94, 0.4);
        }
        .social-btn {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px;
            transition: all 0.3s ease;
        }
        .social-btn:hover {
            border-color: #22c55e;
            transform: translateY(-1px);
        }
        .feature-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #22c55e, #16a34a);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="login-card p-4 p-md-5">
                    <div class="row">
                        <!-- Left Column - Login Form -->
                        <div class="col-lg-6">
                            <div class="text-center mb-4">
                                <h1 class="brand-logo mb-2">
                                    <i class="fas fa-store me-2"></i>SUPERTIENDAS
                                </h1>
                                <p class="text-muted">Sistema de Gestión Comercial</p>
                            </div>

                            <!-- CORREGIDO: Se agregó la comilla simple que faltaba -->
                            <form method="POST" action="{{ route('login.submit') }}">
                                @csrf

                                <!-- Alert Messages -->
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

                                <!-- Email Input -->
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
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Password Input -->
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
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Remember Me & Forgot Password -->
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                        <label class="form-check-label text-muted" for="remember">
                                            Recordar sesión
                                        </label>
                                    </div>
                                    <!--
                                    <a href="#" class="text-decoration-none text-primary">
                                        ¿Olvidaste tu contraseña?
                                    </a>
                                    -->
                                </div>

                                <!-- Login Button -->
                                <button type="submit" class="btn btn-login text-white w-100 mb-4">
                                    <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                                </button>

                                <!-- Register Link -->
                                <div class="text-center">
                                    <p class="text-muted mb-0">
                                        ¿No tienes una cuenta?
                                        <a href="" class="text-decoration-none fw-semibold text-success">
                                            Regístrate aquí
                                        </a>
                                    </p>
                                </div>
                            </form>
                        </div>

                        <!-- Right Column - Features -->
                        <div class="col-lg-6 d-none d-lg-block">
                            <div class="ps-4">
                                <h3 class="fw-bold text-dark mb-4">Bienvenido de vuelta</h3>
                                <p class="text-muted mb-5">
...                                </p>

                                <div class="feature-list">
                                    <div class="d-flex align-items-start mb-4">
                                        <div class="feature-icon">
                                            <i class="fas fa-boxes text-white"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="fw-bold mb-1">Gestión de Inventario</h6>
                                            <p class="text-muted small mb-0">Controla tu stock y productos fácilmente</p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-start mb-4">
                                        <div class="feature-icon">
                                            <i class="fas fa-chart-line text-white"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="fw-bold mb-1">Reportes en Tiempo Real</h6>
                                            <p class="text-muted small mb-0">Métricas actualizadas de tu negocio</p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-start mb-4">
                                        <div class="feature-icon">
                                            <i class="fas fa-users text-white"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="fw-bold mb-1">Gestión de Clientes</h6>
                                            <p class="text-muted small mb-0">Administra tu base de clientes</p>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-start">
                                        <div class="feature-icon">
                                            <i class="fas fa-shield-alt text-white"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="fw-bold mb-1">Seguridad Garantizada</h6>
                                            <p class="text-muted small mb-0">Tus datos protegidos y seguros</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-5 pt-4 border-top">
                                    <div class="row text-center">
                                        <div class="col-4">
                                            <h4 class="fw-bold text-success mb-1">500+</h4>
                                            <small class="text-muted">Clientes</small>
                                        </div>
                                        <div class="col-4">
                                            <h4 class="fw-bold text-success mb-1">1K+</h4>
                                            <small class="text-muted">Productos</small>
                                        </div>
                                        <div class="col-4">
                                            <h4 class="fw-bold text-success mb-1">99%</h4>
                                            <small class="text-muted">Satisfacción</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
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

        // Auto-hide alerts after 5 seconds
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