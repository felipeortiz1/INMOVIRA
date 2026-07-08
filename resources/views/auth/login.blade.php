<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INMOVIRA - Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #0f172a;
            overflow-x: hidden;
        }

        /* Animaciones Keyframes */
        @keyframes slowZoom {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Clases de animación en cascada */
        .fade-in-up {
            opacity: 0;
            animation: fadeInUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }

        /* Layout de pantalla dividida */
        .login-container {
            min-height: 100vh;
            display: flex;
        }

        /* Lado Izquierdo: Imagen de la Inmobiliaria */
        .image-section {
            flex: 1.2;
            position: relative;
            display: none;
            overflow: hidden; /* Contiene el zoom de la imagen */
        }

        .image-bg {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: url('https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            animation: slowZoom 25s infinite alternate linear;
            z-index: 0;
        }

        @media (min-width: 992px) {
            .image-section {
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                padding: 4rem;
            }
        }

        .image-overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            /* Degradado de negro semitransparente a negro más oscuro */
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.8) 100%);
            z-index: 1;
        }

        .image-content, .image-header {
            position: relative;
            z-index: 2;
            color: white;
        }

        .image-content {
            margin-top: auto;
        }

        .image-content h2 {
            font-weight: 700;
            font-size: 2.8rem;
            letter-spacing: -1px;
            margin-bottom: 1rem;
            text-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .image-content p {
            font-size: 1.1rem;
            font-weight: 300;
            opacity: 0.95;
            max-width: 85%;
            line-height: 1.6;
        }

        /* Lado Derecho: Formulario con volumen y color sutil */
        .form-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            /* Degradado radial sutil para matar el blanco plano */
            background: radial-gradient(circle at top right, #ffffff 0%, #f1f5f9 100%);
            box-shadow: -10px 0 30px rgba(0,0,0,0.03);
            z-index: 5;
        }

        .form-wrapper {
            width: 100%;
            max-width: 420px;
        }

        /* Cabecera del formulario */
        .brand-header {
            margin-bottom: 2.5rem;
        }

        .brand-header h1 {
            font-weight: 700;
            font-size: 2rem;
            color: #0f172a;
            letter-spacing: -0.5px;
            background: linear-gradient(90deg, #0f172a, #1e3a8a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .brand-header p {
            color: #64748b;
            font-size: 1rem;
            margin-top: 0.5rem;
        }

        /* Inputs Premium - Estilo Soft Fill */
        .form-label {
            font-size: 0.85rem;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 0.6rem;
        }

        .form-control {
            border: 1.5px solid transparent;
            border-radius: 12px;
            padding: 0.85rem 1.2rem;
            font-size: 1rem;
            color: #0f172a;
            background-color: #e2e8f0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: none !important;
        }

        .form-control::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        .form-control:focus {
            background-color: #ffffff;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15) !important;
            transform: translateY(-2px);
        }

        .form-control:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 30px #ffffff inset !important;
            -webkit-text-fill-color: #0f172a !important;
            border: 1.5px solid #3b82f6;
        }

        /* Input Group para la contraseña */
        .input-group {
            position: relative;
        }
        
        .btn-eye {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            color: #94a3b8;
            padding: 0;
            z-index: 10;
            transition: color 0.3s ease;
        }

        .btn-eye:hover {
            color: #3b82f6;
        }

        /* Checkbox Animado */
        .form-check-input {
            border-color: #cbd5e1;
            background-color: #e2e8f0;
            width: 1.2rem;
            height: 1.2rem;
            margin-top: 0.15rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .form-check-input:checked {
            background-color: #3b82f6;
            border-color: #3b82f6;
            box-shadow: 0 0 10px rgba(59, 130, 246, 0.3);
        }

        .form-check-label {
            color: #475569;
            font-size: 0.95rem;
            cursor: pointer;
            user-select: none;
            transition: color 0.2s ease;
        }

        .form-check-label:hover {
            color: #0f172a;
        }

        /* Botón Principal - Degradado Vibrante */
        .btn-login {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 1rem;
            font-weight: 600;
            font-size: 1.05rem;
            letter-spacing: 0.5px;
            width: 100%;
            margin-top: 1.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        /* Efecto hover del botón */
        .btn-login::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, #3b82f6 0%, #1e3a8a 100%);
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .btn-login:hover::before {
            opacity: 1;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 25px -5px rgba(59, 130, 246, 0.4);
            color: #ffffff;
        }

        /* Enlaces */
        .text-link {
            color: #3b82f6;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .text-link:hover {
            color: #1e3a8a;
            text-decoration: underline;
        }

        /* Alertas */
        .alert {
            border-radius: 12px;
            border: none;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            animation: fadeInUp 0.5s ease-out forwards;
        }
    </style>
</head>

<body>

    <div class="login-container">
        
        <div class="image-section">
            <div class="image-bg"></div>
            <div class="image-overlay"></div>
            
            <div class="image-header fade-in-up">
                <a href="{{ route('pagina.principal') }}" class="d-flex align-items-center text-white text-decoration-none">
                    <i class="fas fa-building fs-3 me-3 text-white"></i>
                    <span class="fs-4 fw-bold tracking-tight">INMOVIRA</span>
                </a>
            </div>

            <div class="image-content fade-in-up delay-2">
                <h2>El futuro de la gestión inmobiliaria.</h2>
                <p>Plataforma integral diseñada para optimizar tus ventas, contratos y cartera de clientes con inteligencia y diseño.</p>
            </div>
        </div>

        <div class="form-section">
            <div class="form-wrapper">
                
                <div class="brand-header d-lg-none mb-4 fade-in-up">
                    <div class="d-flex align-items-center justify-content-center mb-2">
                        <i class="fas fa-building fs-2 me-2" style="color: #1e3a8a;"></i>
                        <span class="fs-2 fw-bold" style="color: #0f172a;">INMOBIROVIRA</span>
                    </div>
                </div>

                <div class="brand-header fade-in-up">
                    <h1>¡Hola de nuevo! 👋</h1>
                    <p>Ingresa tus credenciales para acceder a tu panel.</p>
                </div>

                <form method="POST" action="{{ route('login.submit') }}">
                    @csrf

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show bg-success bg-opacity-10 text-success" role="alert">
                        <i class="fas fa-check-circle me-3 fs-5"></i>
                        <div>{{ session('success') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show bg-danger bg-opacity-10 text-danger" role="alert">
                        <i class="fas fa-exclamation-circle me-3 fs-5"></i>
                        <div>{{ $errors->first() }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <div class="mb-4 fade-in-up delay-1">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            id="email"
                            name="email"
                            placeholder="ejemplo@inmobirovira.com"
                            value="{{ old('email') }}"
                            required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 fade-in-up delay-2">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <input type="password"
                                class="form-control pe-5 @error('password') is-invalid @enderror"
                                id="password"
                                name="password"
                                placeholder="••••••••"
                                required>
                            <button type="button" class="btn-eye" onclick="togglePassword()">
                                <i class="fas fa-eye" id="passwordIcon"></i>
                            </button>
                        </div>
                        @error('password')
                        <div class="invalid-feedback mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4 fade-in-up delay-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">
                                Mantener sesión iniciada
                            </label>
                        </div>
                    </div>

                    <div class="fade-in-up delay-4">
                        <button type="submit" class="btn-login">
                            Iniciar Sesión <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>

                    <div class="text-center mt-4 fade-in-up delay-4">
                        <p class="text-muted mb-0">
                            ¿Aún no eres parte del equipo?
                            <a href="{{ route('register') }}" class="text-link ms-1">
                                Regístrate aquí
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Lógica para mostrar/ocultar contraseña con animación del icono
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('passwordIcon');

            // Pequeña animación al hacer click
            passwordIcon.style.transform = "scale(0.8)";
            setTimeout(() => passwordIcon.style.transform = "scale(1)", 150);

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
                    if(alert) {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    }
                }, 5000);
            });
        });
    </script>

</body>

</html>