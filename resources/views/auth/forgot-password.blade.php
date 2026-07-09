<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña - INMOVIRA</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* =========================================
           Diseño Minimalista y Corporativo
           ========================================= */
        :root {
            --bg-color: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --primary-color: #0f172a; /* Azul muy oscuro/Casi negro */
            --primary-hover: #334155;
            --input-focus: #3b82f6;
            --error-color: #dc2626;
        }

        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            display: flex;
            align-items: center;
            justify-content: center;
            -webkit-font-smoothing: antialiased;
        }

        /* Contenedor y Tarjeta */
        .auth-container {
            width: 100%;
            max-width: 420px;
            padding: 2rem;
        }

        .auth-card {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 2.5rem 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            border: 1px solid var(--border-color);
        }

        /* Cabecera */
        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .auth-logo {
            width: 48px;
            height: 48px;
            background-color: var(--text-main);
            color: white;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 1.2rem;
            letter-spacing: -1px;
        }

        .auth-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 0.5rem;
            letter-spacing: -0.5px;
        }

        .auth-subtitle {
            font-size: 0.9rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        /* Formularios */
        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 0.5rem;
        }

        .form-control {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            color: var(--text-main);
            background-color: #ffffff;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-control:focus {
            border-color: var(--input-focus);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            outline: none;
        }

        .form-control.is-invalid {
            border-color: var(--error-color);
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }

        .form-control::placeholder {
            color: #94a3b8;
        }

        /* Botón de Envío */
        .btn-submit {
            width: 100%;
            background-color: var(--primary-color);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            padding: 0.85rem;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease;
            margin-top: 1rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .btn-submit:hover {
            background-color: var(--primary-hover);
        }

        /* Alertas Minimalistas */
        .alert-minimal {
            font-size: 0.85rem;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border: 1px solid transparent;
        }

        .alert-success-minimal {
            background-color: #f0fdf4;
            border-color: #bbf7d0;
            color: #166534;
        }

        .alert-danger-minimal {
            background-color: #fef2f2;
            border-color: #fecaca;
            color: #991b1b;
        }

        /* Enlace de Retorno */
        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .back-link:hover {
            color: var(--text-main);
        }

        /* Animación de entrada suave */
        .fade-in {
            animation: fadeIn 0.4s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="auth-container fade-in">
        <div class="auth-card">
            
            <div class="auth-header">
                <div class="auth-logo">IN</div>
                <h1 class="auth-title">Recuperar contraseña</h1>
                <p class="auth-subtitle">Ingresa tu correo y te enviaremos las instrucciones.</p>
            </div>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                @if(session('status') || session('success'))
                    <div class="alert-minimal alert-success-minimal">
                        {{ session('status') ?? session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert-minimal alert-danger-minimal">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        id="email" 
                        name="email" 
                        placeholder="ejemplo@inmobirovira.com" 
                        required 
                        autofocus
                    >
                </div>

                <button type="submit" class="btn-submit">
                    Enviar enlace de recuperación
                </button>
                
                <a href="{{ route('login') }}" class="back-link">
                    &larr; Volver al inicio de sesión
                </a>
            </form>

        </div>
    </div>

</body>
</html>