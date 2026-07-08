<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INMOVIRA - Registro</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts: Plus Jakarta Sans -->
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
        .delay-5 { animation-delay: 0.5s; }

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
            overflow: hidden;
        }

        .image-bg {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            /* IMAGEN NUEVA: Interior de lujo moderno */
            background: url('https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
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
            /* Degradado neutro (sin azul) para contraste perfecto */
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.8) 100%);
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
            text-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }

        .image-content p {
            font-size: 1.1rem;
            font-weight: 300;
            opacity: 0.95;
            max-width: 85%;
            line-height: 1.6;
        }

        /* Lado Derecho: Formulario */
        .form-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
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
            margin-bottom: 2rem;
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

        /* Inputs Premium */
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

        /* Input Group (Contraseñas) */
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

        /* Botón Principal */
        .btn-primary {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 1rem;
            font-weight: 600;
            font-size: 1.05rem;
            letter-spacing: 0.5px;
            width: 100%;
            margin-top: 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, #3b82f6 0%, #1e3a8a 100%);
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .btn-primary:hover::before {
            opacity: 1;
        }

        .btn-primary:hover {
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
        
        <!-- Mitad Izquierda: Imagen (Oculta en móviles) -->
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
                <h2>Únete a la evolución inmobiliaria.</h2>
                <p>Crea tu cuenta hoy y descubre la forma más inteligente de gestionar clientes, propiedades y contratos en un solo lugar.</p>
            </div>
        </div>

        <!-- Mitad Derecha: Formulario -->
        <div class="form-section">
            <div class="form-wrapper">
                
                <div class="brand-header d-lg-none mb-4 fade-in-up">
                    <div class="d-flex align-items-center justify-content-center mb-2">
                        <i class="fas fa-building fs-2 me-2" style="color: #1e3a8a;"></i>
                        <span class="fs-2 fw-bold" style="color: #0f172a;">INMOBIROVIRA</span>
                    </div>
                </div>

                <div class="brand-header fade-in-up">
                    <h1>Crear Cuenta ✨</h1>
                    <p>Completa tus datos para empezar a gestionar.</p>
                </div>

                <form method="POST" action="{{ route('register.submit') }}">
                    @csrf

                    <!-- Alertas -->
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show bg-danger bg-opacity-10 text-danger" role="alert">
                            <i class="fas fa-exclamation-circle me-3 fs-5"></i>
                            <div>{{ $errors->first() }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Nombre -->
                    <div class="mb-3 fade-in-up delay-1">
                        <label for="name" class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Tu nombre completo" value="{{ old('name') }}" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3 fade-in-up delay-2">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="tu@email.com" value="{{ old('email') }}" required>
                    </div>

                    <!-- Contraseña -->
                    <div class="mb-3 fade-in-up delay-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control pe-5" id="password" name="password" placeholder="••••••••" required>
                            <button type="button" class="btn-eye" onclick="togglePassword('password', 'icon1')">
                                <i class="fas fa-eye" id="icon1"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Confirmar contraseña -->
                    <div class="mb-4 fade-in-up delay-4">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control pe-5" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>
                            <button type="button" class="btn-eye" onclick="togglePassword('password_confirmation', 'icon2')">
                                <i class="fas fa-eye" id="icon2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Botón -->
                    <div class="fade-in-up delay-5">
                        <button type="submit" class="btn btn-primary">
                            Registrarse <i class="fas fa-user-plus ms-2"></i>
                        </button>
                    </div>

                    <!-- Enlace de inicio de sesión -->
                    <div class="text-center mt-4 fade-in-up delay-5">
                        <p class="text-muted mb-0">
                            ¿Ya tienes una cuenta?
                            <a href="{{ route('login') }}" class="text-link ms-1">
                                Inicia sesión
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Función original mantenida pero con animaciones ligeras agregadas
        function togglePassword(id, iconId) {
            const input = document.getElementById(id);
            const icon = document.getElementById(iconId);

            // Animación al hacer click
            icon.style.transform = "scale(0.8)";
            setTimeout(() => icon.style.transform = "scale(1)", 150);

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
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