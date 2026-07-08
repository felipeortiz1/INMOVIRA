<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $inmobiliaria->nombreEmpresa }} | Perfil Premium</title>

    <style>
        /* ==========================================================================
           VARIABLES GLOBALES Y TEMAS
           ========================================================================== */
        :root {
            --bg-main: #F8FAFC;
            --bg-card: #ffffff;
            --bg-nav: #98FB98;
            --text-main: #0F172A;
            --text-muted: #64748B;
            --accent: #6366F1;
            --accent-hover: #4F46E5;
            --btn-login: #0F172A; 
            --btn-login-hover: #020617;
            --border-color: rgba(226, 232, 240, 0.8);
            
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            
            --radius-md: 16px;
            --radius-lg: 24px;
            --transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        [data-theme="dark"] {
            --bg-main: #0B1120;
            --bg-card: #1E293B;
            --bg-nav: #064E3B; 
            --text-main: #F8FAFC;
            --text-muted: #94A3B8;
            --accent: #818CF8;
            --accent-hover: #6366F1;
            --btn-login: #38BDF8;
            --btn-login-hover: #0EA5E9;
            --border-color: rgba(51, 65, 85, 0.8);
            
            --shadow-md: 0 10px 25px -5px rgba(0, 0, 0, 0.4);
            --shadow-lg: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background-color: var(--bg-main);
            color: var(--text-main);
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            transition: var(--transition);
            overflow-x: hidden;
        }

        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: var(--bg-main); }
        ::-webkit-scrollbar-thumb { background: var(--text-muted); border-radius: 10px; border: 2px solid var(--bg-main); }
        ::-webkit-scrollbar-thumb:hover { background: var(--accent); }

        /* ==========================================================================
           NAVBAR GLOBAL
           ========================================================================== */
        .nav {
            display: flex; align-items: center; justify-content: space-between;
            padding: 16px 40px; background: var(--bg-nav);
            backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.05); position: sticky; top: 0; z-index: 1000;
            transition: var(--transition);
        }
        .nav .left { display: flex; align-items: center; gap: 32px; }
        .nav .left a {
            color: #064E3B; font-family: 'Nunito', sans-serif; font-weight: 800;
            font-size: 1.1rem; text-decoration: none; position: relative; padding: 8px 4px;
        }
        [data-theme="dark"] .nav .left a { color: #ECFDF5; }
        .nav .left a::after {
            content: ""; position: absolute; bottom: 0; left: 50%;
            width: 0%; height: 3px; background: currentColor; border-radius: 4px;
            transition: var(--transition); transform: translateX(-50%);
        }
        .nav .left a:hover::after, .nav .left a.active::after { width: 100%; }
        .nav .right { display: flex; align-items: center; gap: 16px; }

        .btn-nav-login {
            background: var(--btn-login); color: white; padding: 10px 24px;
            border-radius: 12px; font-weight: 700; text-decoration: none;
            transition: var(--transition);
        }
        .btn-nav-login:hover { background: var(--btn-login-hover); transform: translateY(-2px); }
        #toggleTheme {
            background: transparent; border: 1px solid var(--border-color); color: var(--text-main);
            width: 42px; height: 42px; border-radius: 50%; cursor: pointer; font-size: 1.2rem; transition: var(--transition);
        }
        #toggleTheme:hover { background: var(--bg-card); color: var(--accent); }

        /* ==========================================================================
           LAYOUT DEL PERFIL
           ========================================================================== */
        .profile-container {
            max-width: 1100px;
            margin: 0 auto 60px;
            padding: 0 20px;
            animation: slideUp 0.8s ease backwards;
        }

        /* BANNER */
        .cover-banner {
            width: 100%;
            height: 300px;
            background: linear-gradient(135deg, var(--accent), #38BDF8, #818CF8);
            background-size: 200% 200%;
            border-radius: 0 0 var(--radius-lg) var(--radius-lg);
            position: relative;
            overflow: hidden;
            animation: gradientMove 10s ease infinite;
        }
        .cover-banner::after {
            content: ''; position: absolute; inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='rgba(255,255,255,0.1)' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        /* MAIN CARD OVERLAP */
        .main-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
            margin-top: -120px;
            position: relative;
            z-index: 10;
            padding: 40px;
            display: flex;
            flex-direction: column;
            gap: 40px;
        }

        /* HEADER INFO */
        .profile-header {
            display: flex;
            align-items: flex-end;
            gap: 30px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 30px;
        }

        .profile-logo {
            width: 180px;
            height: 180px;
            border-radius: 24px;
            border: 6px solid var(--bg-card);
            background: #fff;
            box-shadow: var(--shadow-md);
            object-fit: cover;
            transform: translateY(-40px);
            margin-bottom: -40px;
            transition: var(--transition);
            transform-style: preserve-3d;
        }

        .profile-title {
            flex: 1;
        }

        .badge-pro {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(99, 102, 241, 0.1); color: var(--accent);
            padding: 6px 16px; border-radius: 50px; font-weight: 800;
            font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;
            margin-bottom: 12px; border: 1px solid rgba(99, 102, 241, 0.2);
        }

        .profile-title h1 {
            font-family: 'Nunito', sans-serif;
            font-size: 2.8rem;
            font-weight: 900;
            color: var(--text-main);
            margin: 0;
            line-height: 1.1;
        }

        .profile-actions {
            display: flex;
            gap: 12px;
        }

        .btn {
            display: inline-flex; align-items: center; justify-content: center; gap: 10px;
            padding: 14px 28px; border-radius: 12px; font-weight: 700; font-family: inherit;
            font-size: 1rem; border: none; cursor: pointer; text-decoration: none;
            transition: var(--transition);
        }
        
        .btn-whatsapp {
            background: #10B981; color: white;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }
        .btn-whatsapp:hover {
            background: #059669; transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4); color: white;
        }

        .btn-outline {
            background: transparent; color: var(--text-main);
            border: 2px solid var(--border-color);
        }
        .btn-outline:hover {
            background: var(--bg-main); border-color: var(--text-muted);
            transform: translateY(-3px);
        }

        /* GRID DE INFORMACIÓN */
        .profile-body {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .info-section h3 {
            font-family: 'Nunito', sans-serif;
            font-size: 1.5rem;
            color: var(--text-main);
            margin-bottom: 20px;
            display: flex; align-items: center; gap: 10px;
        }
        .info-section h3 i { color: var(--accent); }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .contact-card {
            background: var(--bg-main);
            padding: 20px;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            gap: 8px;
            position: relative;
            overflow: hidden;
        }
        .contact-card:hover {
            border-color: var(--accent);
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }
        
        .contact-card i.main-icon {
            font-size: 1.5rem;
            color: var(--accent);
            margin-bottom: 5px;
        }

        .contact-card .label {
            font-size: 0.85rem;
            color: var(--text-muted);
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .contact-card .value {
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--text-main);
            word-break: break-word;
        }

        /* Botón de copiar */
        .copy-btn {
            position: absolute;
            top: 15px; right: 15px;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            color: var(--text-muted);
            width: 32px; height: 32px;
            border-radius: 8px;
            display: flex; justify-content: center; align-items: center;
            cursor: pointer; transition: var(--transition);
            opacity: 0; transform: scale(0.8);
        }
        .contact-card:hover .copy-btn { opacity: 1; transform: scale(1); }
        .copy-btn:hover { background: var(--accent); color: white; border-color: var(--accent); }

        .about-box {
            background: var(--bg-main);
            padding: 30px;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
            line-height: 1.8;
            color: var(--text-main);
            font-size: 1.05rem;
        }

        /* TOAST NOTIFICATION */
        .toast {
            position: fixed;
            bottom: 30px; left: 50%;
            transform: translateX(-50%) translateY(100px);
            background: var(--text-main);
            color: var(--bg-card);
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 600;
            box-shadow: var(--shadow-lg);
            display: flex; align-items: center; gap: 10px;
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            z-index: 9999;
        }
        .toast.show { transform: translateX(-50%) translateY(0); }
        .toast i { color: var(--accent); }

        /* ==========================================================================
           ANIMACIONES & RESPONSIVE
           ========================================================================== */
        @keyframes slideUp { from { opacity: 0; transform: translateY(50px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes gradientMove { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }

        @media(max-width: 992px) {
            .profile-header { flex-direction: column; align-items: center; text-align: center; }
            .profile-logo { transform: translateY(-70px); margin-bottom: -50px; width: 150px; height: 150px; }
            .profile-actions { justify-content: center; width: 100%; flex-wrap: wrap; }
            .profile-body { grid-template-columns: 1fr; gap: 30px; }
        }

        @media(max-width: 768px) {
            .nav { padding: 12px 20px; flex-direction: column; gap: 16px; }
            .nav .left { flex-wrap: wrap; justify-content: center; gap: 16px; }
            .contact-grid { grid-template-columns: 1fr; }
            .main-card { padding: 24px; }
            .profile-title h1 { font-size: 2.2rem; }
            .cover-banner { height: 200px; border-radius: 0; }
            .profile-container { margin-top: 0; }
        }
    </style>
</head>
<body data-theme="{{ request()->cookie('theme','light') }}">

    <!-- NAVBAR GLOBAL -->
    <nav class="nav">
        <div class="left">
            <a href="{{ route('pagina.principal') }}"><i class="fa-solid fa-house"></i> Inicio</a>
            <a href="{{ route('vista.arriendo') }}"><i class="fa-solid fa-key"></i> Arriendo</a>
            <a href="{{ route('vista.venta') }}"><i class="fa-solid fa-tag"></i> Venta</a>
            <a href="{{ route('vista.inmobiliarias') }}" class="active"><i class="fa-solid fa-building-user"></i> Inmobiliarias</a>
        </div>
        <div class="right">
            <button id="toggleTheme" title="Cambiar tema">
                <i class="fa-solid fa-circle-half-stroke"></i>
            </button>
            <a href="{{ route('login') }}" class="btn-nav-login"><i class="fa-solid fa-user-lock"></i> Iniciar sesión</a>
        </div>
    </nav>

    <!-- BANNER COVER -->
    <div class="cover-banner"></div>

    <!-- CONTENEDOR PRINCIPAL -->
    <div class="profile-container">
        
        <div class="main-card">
            
            <!-- CABECERA DEL PERFIL -->
            <div class="profile-header">
                <img class="profile-logo" id="profileLogo"
                     src="{{ $inmobiliaria->imagen ? asset('storage/' . $inmobiliaria->imagen) : asset('img/default.png') }}" 
                     alt="Logo {{ $inmobiliaria->nombreEmpresa }}">
                
                <div class="profile-title">
                    <span class="badge-pro"><i class="fa-solid fa-shield-halved"></i> Agencia Verificada</span>
                    <h1>{{ $inmobiliaria->nombreEmpresa }}</h1>
                </div>

                <div class="profile-actions">
                    <a href="{{ route('vista.inmobiliarias') }}" class="btn btn-outline">
                        <i class="fa-solid fa-arrow-left"></i> Volver al listado
                    </a>
                    <a href="https://wa.me/57{{ $inmobiliaria->telefono }}" target="_blank" class="btn btn-whatsapp">
                        <i class="fa-brands fa-whatsapp" style="font-size: 1.3rem;"></i> WhatsApp
                    </a>
                </div>
            </div>

            <!-- CUERPO DEL PERFIL -->
            <div class="profile-body">
                
                <!-- SECCIÓN DE CONTACTO -->
                <div class="info-section">
                    <h3><i class="fa-regular fa-address-card"></i> Información de Contacto</h3>
                    
                    <div class="contact-grid">
                        
                        <div class="contact-card">
                            <i class="fa-solid fa-user-tie main-icon"></i>
                            <span class="label">Representante Legal</span>
                            <span class="value">{{ $inmobiliaria->nombre }}</span>
                        </div>

                        <div class="contact-card">
                            <button class="copy-btn" onclick="copyToClipboard('{{ $inmobiliaria->email }}')" title="Copiar Correo">
                                <i class="fa-regular fa-copy"></i>
                            </button>
                            <i class="fa-solid fa-envelope main-icon"></i>
                            <span class="label">Correo Electrónico</span>
                            <span class="value">{{ $inmobiliaria->email }}</span>
                        </div>

                        <div class="contact-card">
                            <button class="copy-btn" onclick="copyToClipboard('{{ $inmobiliaria->telefono }}')" title="Copiar Teléfono">
                                <i class="fa-regular fa-copy"></i>
                            </button>
                            <i class="fa-solid fa-phone main-icon"></i>
                            <span class="label">Teléfono Directo</span>
                            <span class="value">{{ $inmobiliaria->telefono }}</span>
                        </div>
                        

                        <div class="contact-card">
                            <i class="fa-solid fa-map-location-dot main-icon"></i>
                            <span class="label">Dirección Principal</span>
                            <span class="value">{{ $inmobiliaria->direccion ?? 'No registrada en sistema' }}</span>
                        </div>

                        <div class="contact-card">
                            <i class="fa-solid fa-tree-city main-icon"></i>
                            <span class="label">Municipio / Ciudad</span>
                            <span class="value">{{ $inmobiliaria->municipio->nombre ?? 'No registrado' }}</span>
                        </div>

                    </div>
                </div>

                <!-- SECCIÓN ACERCA DE -->
                <div class="info-section">
                    <h3><i class="fa-solid fa-circle-info"></i> Acerca de la Inmobiliaria</h3>
                    
                    <div class="about-box">
                        {{ $inmobiliaria->descripcion ?? 'Esta inmobiliaria aún no ha registrado una descripción detallada de sus servicios comerciales y trayectoria en la plataforma.' }}
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- TOAST NOTIFICATION -->
    <div class="toast" id="toastBox">
        <i class="fa-solid fa-circle-check"></i> <span>Copiado al portapapeles</span>
    </div>

    <script>
        /* ==========================================================================
           TEMA LIGHT / DARK (Lógica consistente con otras vistas)
           ========================================================================== */
        const body = document.body;
        const themeBtn = document.getElementById('toggleTheme');
        const themeIcon = themeBtn.querySelector('i');

        function updateThemeIcon(theme) {
            if(theme === 'dark') {
                themeIcon.classList.remove('fa-circle-half-stroke');
                themeIcon.classList.add('fa-sun');
            } else {
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
            }
        }

        (function initTheme(){
            const match = document.cookie.split('; ').find(r => r.startsWith('theme='));
            const theme = match ? match.split('=')[1] : (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            body.setAttribute('data-theme', theme);
            updateThemeIcon(theme);
        })();

        themeBtn.onclick = () => {
            const isDark = body.getAttribute('data-theme') === 'dark';
            const newTheme = isDark ? 'light' : 'dark';
            body.setAttribute('data-theme', newTheme);
            updateThemeIcon(newTheme);
            document.cookie = "theme="+newTheme+"; path=/; max-age=" + 60*60*24*365;
        };

        /* ==========================================================================
           FUNCIONALIDAD DE COPIAR AL PORTAPAPELES
           ========================================================================== */
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                showToast("Copiado: " + text);
            }).catch(err => {
                console.error('Error al copiar: ', err);
            });
        }

        function showToast(msg) {
            const toast = document.getElementById('toastBox');
            toast.querySelector('span').innerText = msg;
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }

        /* ==========================================================================
           EFECTO TILT 3D EN EL LOGO (Vanilla JS)
           ========================================================================== */
        const logo = document.getElementById('profileLogo');
        
        logo.addEventListener('mousemove', (e) => {
            const rect = logo.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            // Calculamos la rotación (máximo 15 grados)
            const rotateX = ((y - centerY) / centerY) * -15; 
            const rotateY = ((x - centerX) / centerX) * 15;
            
            logo.style.transform = `translateY(-40px) perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.05, 1.05, 1.05)`;
        });

        logo.addEventListener('mouseleave', () => {
            // Volver al estado original suavemente
            logo.style.transform = `translateY(-40px) perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)`;
        });
    </script>
</body>
</html>