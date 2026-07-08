<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Inmobiliarias | Directorio Premium</title>

    <style>
        /* ==========================================================================
           VARIABLES GLOBALES Y TEMAS
           ========================================================================== */
        :root {
            /* Paleta Light */
            --bg-main: #F8FAFC;
            --bg-card: #ffffff;
            --bg-nav: #98FB98; /* ✅ VERDE CLARO SOLICITADO */
            --text-main: #0F172A;
            --text-muted: #64748B;
            --accent: #6366F1; /* Índigo corporativo premium para agencias */
            --accent-hover: #4F46E5;
            --btn-login: #0F172A; /* ✅ AZUL OSCURO/NEGRO SOLICITADO */
            --btn-login-hover: #020617;
            --border-color: rgba(226, 232, 240, 0.8);
            
            /* UI Elements */
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-card: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
            --shadow-card-hover: 0 20px 40px -10px rgba(99, 102, 241, 0.15), 0 15px 15px -10px rgba(0,0,0,0.05);
            --glass-bg: rgba(255, 255, 255, 0.7);
            --glass-border: rgba(255, 255, 255, 0.5);
            
            /* Extras */
            --radius-sm: 8px;
            --radius-md: 14px;
            --radius-lg: 20px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        [data-theme="dark"] {
            /* Paleta Dark */
            --bg-main: #0B1120;
            --bg-card: #1E293B;
            --bg-nav: #064E3B; /* Verde adaptado a dark mode */
            --text-main: #F8FAFC;
            --text-muted: #94A3B8;
            --accent: #818CF8;
            --accent-hover: #6366F1;
            --btn-login: #38BDF8;
            --btn-login-hover: #0EA5E9;
            --border-color: rgba(51, 65, 85, 0.8);
            
            /* UI Elements Dark */
            --shadow-card: 0 10px 25px -5px rgba(0, 0, 0, 0.4);
            --shadow-card-hover: 0 20px 40px -10px rgba(129, 140, 248, 0.2);
            --glass-bg: rgba(30, 41, 59, 0.7);
            --glass-border: rgba(255, 255, 255, 0.05);
        }

        /* ==========================================================================
           RESET Y BASE
           ========================================================================== */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            background-color: var(--bg-main);
            color: var(--text-main);
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            line-height: 1.6;
            transition: background-color 0.4s ease, color 0.4s ease;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: var(--bg-main); }
        ::-webkit-scrollbar-thumb { background: var(--text-muted); border-radius: 10px; border: 2px solid var(--bg-main); }
        ::-webkit-scrollbar-thumb:hover { background: var(--accent); }

        /* ==========================================================================
           NAVBAR (HEADER)
           ========================================================================== */
        .nav {
            display: flex; align-items: center; justify-content: space-between;
            padding: 16px 40px; background: var(--bg-nav);
            backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);
            box-shadow: var(--shadow-md); position: sticky; top: 0; z-index: 1000;
            transition: var(--transition);
        }
        .nav .left { display: flex; align-items: center; gap: 32px; }
        .nav .left a {
            color: #064E3B; font-family: 'Nunito', sans-serif; font-weight: 800;
            font-size: 1.1rem; text-decoration: none; position: relative;
            padding: 8px 4px; transition: var(--transition);
        }
        [data-theme="dark"] .nav .left a { color: #ECFDF5; }
        .nav .left a::after {
            content: ""; position: absolute; bottom: 0; left: 50%;
            width: 0%; height: 3px; background: currentColor; border-radius: 4px;
            transition: var(--transition); transform: translateX(-50%);
        }
        .nav .left a:hover::after, .nav .left a.active::after { width: 100%; }
        .nav .left a:hover { transform: translateY(-2px); opacity: 0.8; }
        .nav .right { display: flex; align-items: center; gap: 16px; }

        /* ==========================================================================
           BOTONES GLOBALES
           ========================================================================== */
        .btn {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            padding: 10px 20px; border-radius: var(--radius-md); border: none;
            cursor: pointer; font-weight: 700; font-family: inherit; font-size: 0.95rem;
            transition: var(--transition); text-decoration: none;
        }
        .btn:active { transform: scale(0.97); }
        
        .btn-ghost { background: transparent; color: var(--text-main); border: 1px solid var(--border-color); }
        .btn-ghost:hover { background: var(--bg-card); border-color: var(--accent); color: var(--accent); }
        .btn-ghost.active-toggle { background: var(--accent); color: white; border-color: var(--accent); }
        
        .btn-primary { background: var(--accent); color: #fff; box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3); }
        .btn-primary:hover { background: var(--accent-hover); transform: translateY(-2px); box-shadow: 0 6px 16px rgba(99, 102, 241, 0.4); }
        
        .btn-whatsapp { background: #10B981; color: white; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3); }
        .btn-whatsapp:hover { background: #059669; transform: translateY(-2px); box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4); color: white; }

        .btn-login { background: var(--btn-login); color: white; padding: 10px 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
        .btn-login:hover { background: var(--btn-login-hover); transform: translateY(-2px); color: white; }

        #toggleTheme { width: 42px; height: 42px; padding: 0; border-radius: 50%; font-size: 1.2rem; }

        /* ==========================================================================
           LAYOUT Y HEADER
           ========================================================================== */
        .container { max-width: 1250px; margin: 0 auto; padding: 40px 24px; }
        
        .page-header { margin-bottom: 40px; text-align: left; }
        h1 {
            font-family: 'Nunito', sans-serif; font-size: 3rem; font-weight: 800;
            color: var(--text-main); letter-spacing: -0.5px;
            animation: slideDown 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        h1 span { color: var(--accent); position: relative; display: inline-block; }
        h1 span::after {
            content: ''; position: absolute; bottom: 4px; left: 0; width: 100%;
            height: 8px; background: var(--accent); opacity: 0.2; border-radius: 4px;
        }

        /* ==========================================================================
           BUSCADOR / FILTROS
           ========================================================================== */
        .filters {
            display: flex; gap: 16px; flex-wrap: wrap; align-items: center;
            background: var(--glass-bg); backdrop-filter: blur(10px);
            padding: 20px 24px; border-radius: var(--radius-lg);
            box-shadow: var(--shadow-card); border: 1px solid var(--glass-border);
            margin-bottom: 30px; animation: fadeIn 0.8s ease backwards;
        }
        
        .input-wrapper { position: relative; flex: 1; min-width: 250px; }
        .input-wrapper i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted); }
        
        .filters input, .filters select {
            width: 100%; padding: 14px 16px 14px 45px; border-radius: var(--radius-md);
            border: 1px solid var(--border-color); background: var(--bg-card);
            color: var(--text-main); font-family: inherit; font-size: 1rem;
            transition: var(--transition); appearance: none;
        }
        .filters select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat; background-position: right 16px center; background-size: 16px; padding-right: 45px;
        }
        [data-theme="dark"] .filters select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        }
        .filters input:focus, .filters select:focus {
            outline: none; border-color: var(--accent); background: var(--bg-card);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
        }

        .controls {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 24px; padding: 0 8px; animation: fadeIn 1s ease backwards;
        }
        .view-toggles { display: flex; gap: 10px; background: var(--bg-card); padding: 6px; border-radius: var(--radius-md); border: 1px solid var(--border-color); }
        .view-toggles button { padding: 8px 16px; border: none; border-radius: 8px; font-size: 1rem; }
        .total-badge { background: var(--bg-card); padding: 8px 16px; border-radius: 50px; font-weight: 600; border: 1px solid var(--border-color); color: var(--text-muted); }
        .total-badge b { color: var(--accent); font-size: 1.1rem; margin-left: 4px; }

        /* ==========================================================================
           GRID / LISTA (TARJETAS DIRECTORIO)
           ========================================================================== */
        .list-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); /* Modo Grid por defecto */
            gap: 24px;
            transition: var(--transition);
        }

        /* Activar modo lista */
        .list-grid.list-view {
            display: flex;
            flex-direction: column;
        }

        .card {
            background: var(--bg-card); border-radius: var(--radius-lg);
            box-shadow: var(--shadow-card); overflow: hidden;
            transition: var(--transition); border: 1px solid var(--border-color);
            display: flex; flex-direction: column; /* Diseño grid por defecto */
            animation: slideUp 0.6s ease backwards;
        }
        .card:hover { transform: translateY(-6px); box-shadow: var(--shadow-card-hover); border-color: var(--accent); }
        
        .list-grid.list-view .card {
            flex-direction: row; /* Diseño lista horizontal */
            align-items: stretch;
        }

        .card-img-wrapper {
            position: relative; width: 100%; height: 200px; overflow: hidden;
            background: #E2E8F0; display: flex; justify-content: center; align-items: center;
        }
        [data-theme="dark"] .card-img-wrapper { background: #0F172A; }
        
        .list-grid.list-view .card-img-wrapper { width: 280px; height: auto; flex-shrink: 0; }

        .card-img-wrapper img {
            width: 100%; height: 100%; object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
        }
        .card:hover .card-img-wrapper img { transform: scale(1.05); }

        .card-body { padding: 24px; display: flex; flex-direction: column; gap: 12px; flex: 1; }
        
        .card h3 {
            margin: 0; color: var(--text-main); font-size: 1.4rem;
            font-family: 'Nunito', sans-serif; font-weight: 800; line-height: 1.3;
        }

        .info-row { display: flex; align-items: center; gap: 10px; color: var(--text-muted); font-size: 0.95rem; }
        .info-row i { color: var(--accent); width: 20px; text-align: center; font-size: 1.1rem; }
        .info-row strong { color: var(--text-main); font-weight: 600; margin-right: 4px; }

        .actions {
            margin-top: auto; padding-top: 20px;
            display: flex; justify-content: space-between; align-items: center; gap: 12px;
            border-top: 1px solid var(--border-color);
        }
        .actions .btn { flex: 1; }

        .empty {
            text-align: center; padding: 60px 20px; background: var(--glass-bg);
            border-radius: var(--radius-lg); border: 1px dashed var(--border-color);
            color: var(--text-muted); font-size: 1.1rem;
        }
        .empty i { font-size: 3rem; color: var(--border-color); margin-bottom: 16px; }

        /* ==========================================================================
           MODAL PREMIUM (Generado por JS)
           ========================================================================== */
        .modal-backdrop {
            position: fixed; inset: 0; background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);
            display: flex; justify-content: center; align-items: center;
            z-index: 9999; padding: 20px; animation: fadeIn 0.3s ease;
        }
        .modal {
            background: var(--bg-card); border-radius: var(--radius-lg); width: 100%;
            max-width: 650px; max-height: 90vh; overflow-y: auto; position: relative;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); border: 1px solid var(--border-color);
            padding: 32px; display: flex; flex-direction: column; gap: 20px;
            animation: slideUp 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .modal-close {
            position: absolute; right: 20px; top: 20px; background: rgba(0,0,0,0.05);
            color: var(--text-main); border: none; width: 36px; height: 36px;
            border-radius: 50%; font-size: 16px; cursor: pointer; z-index: 10;
            display: flex; align-items: center; justify-content: center; transition: var(--transition);
        }
        [data-theme="dark"] .modal-close { background: rgba(255,255,255,0.1); }
        .modal-close:hover { background: var(--danger); color: white; transform: rotate(90deg); }
        
        .modal img {
            width: 100%; height: 280px; object-fit: cover;
            border-radius: var(--radius-md); box-shadow: var(--shadow-md); margin-bottom: 10px;
        }

        /* ==========================================================================
           ANIMACIONES & RESPONSIVE
           ========================================================================== */
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
        
        @media(max-width: 992px) {
            .list-grid.list-view .card { flex-direction: column; }
            .list-grid.list-view .card-img-wrapper { width: 100%; height: 220px; }
            .filters { flex-direction: column; align-items: stretch; }
            .input-wrapper { min-width: 100%; }
        }
        @media(max-width: 768px) {
            .nav { padding: 12px 20px; flex-direction: column; gap: 16px; }
            .nav .left { flex-wrap: wrap; justify-content: center; gap: 16px; }
            h1 { font-size: 2.2rem; text-align: center; }
            .controls { flex-direction: column; gap: 16px; align-items: flex-start; }
            .total-badge { width: 100%; text-align: center; }
        }
    </style>
</head>

<body data-theme="{{ request()->cookie('theme','light') }}">

    <nav class="nav">
        <div class="left">
            <a href="{{ route('pagina.principal') }}"><i class="fa-solid fa-house"></i> Inicio</a>
            <a href="{{ route('vista.arriendo') }}"><i class="fa-solid fa-key"></i> Arriendo</a>
            <a href="{{ route('vista.venta') }}"><i class="fa-solid fa-tag"></i> Venta</a>
            <a href="{{ route('vista.inmobiliarias') }}" class="active"><i class="fa-solid fa-building-user"></i> Inmobiliarias</a>
        </div>
        <div class="right">
            <button id="toggleTheme" class="btn btn-ghost" title="Cambiar tema">
                <i class="fa-solid fa-circle-half-stroke"></i>
            </button>
            <a href="{{ route('login') }}" class="btn btn-login"><i class="fa-solid fa-user-lock"></i> Iniciar sesión</a>
        </div>
    </nav>

    <div class="container">
        
        <div class="page-header">
            <h1>Directorio de <span>Inmobiliarias</span></h1>
            <p style="color: var(--text-muted); font-size: 1.1rem; margin-top: 8px;">Conecta con las agencias más confiables y expertas del sector inmobiliario.</p>
        </div>

        <form class="filters" method="GET" action="{{ route('vista.inmobiliarias') }}">
            <div class="input-wrapper">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" name="q" placeholder="Buscar por nombre de agencia..." value="{{ request('q') }}">
            </div>

            <div class="input-wrapper">
                <i class="fa-solid fa-map-location-dot"></i>
                <select name="municipio">
                    <option value="">Todos los municipios</option>
                    @foreach($municipios as $m)
                        <option value="{{ $m->id }}" {{ request('municipio') == $m->id ? 'selected' : '' }}>
                            {{ $m->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-filter"></i> Filtrar</button>
            <a href="{{ route('vista.inmobiliarias') }}" class="btn btn-ghost"><i class="fa-solid fa-rotate-right"></i> Limpiar</a>
        </form>

        <div class="controls">
            <div class="view-toggles">
                <button id="gridBtn" class="btn btn-ghost active-toggle" title="Vista Cuadrícula"><i class="fa-solid fa-border-all"></i> Grid</button>
                <button id="listBtn" class="btn btn-ghost" title="Vista Lista"><i class="fa-solid fa-list"></i> Lista</button>
            </div>
            <div class="total-badge">
                Agencias registradas: <b>{{ $inmobiliarias->count() }}</b>
            </div>
        </div>

        @if($inmobiliarias->isEmpty())
            <div class="empty">
                <i class="fa-regular fa-folder-open"></i>
                <h2>Sin resultados</h2>
                <p>No encontramos inmobiliarias que coincidan con tu búsqueda actual.</p>
            </div>
        @else
            <div id="listing" class="list-grid">
                @foreach($inmobiliarias as $index => $inm)
                    <article class="card" style="animation-delay: {{ $index * 0.1 }}s">
                        
                        <div class="card-img-wrapper">
                            <img src="{{ $inm->imagen ? asset('storage/'.$inm->imagen) : asset('img/usuarios/default.png') }}" alt="Logo {{ $inm->nombreEmpresa }}">
                        </div>

                        <div class="card-body">
                            <h3>{{ $inm->nombreEmpresa }}</h3>
                            
                            <div class="info-row">
                                <i class="fa-solid fa-user-tie"></i>
                                <span><strong>Representante:</strong> {{ $inm->nombre }}</span>
                            </div>
                            
                            <div class="info-row">
                                <i class="fa-solid fa-envelope"></i>
                                <span><strong>Email:</strong> {{ $inm->email }}</span>
                            </div>

                            <div class="info-row">
                                <i class="fa-solid fa-location-dot"></i>
                                <span><strong>Municipio:</strong> {{ $inm->municipio->nombre ?? 'No registrado' }}</span>
                            </div>
                            
                            <div class="info-row">
                                <i class="fa-solid fa-phone"></i>
                                <span><strong>Teléfono:</strong> {{ $inm->telefono }}</span>
                            </div>

                            <div class="actions">
                                <a href="{{ route('inmobiliaria.ver', $inm->id) }}" class="btn btn-ghost">
                                    <i class="fa-solid fa-eye"></i> Perfil
                                </a>

                                <a href="https://wa.me/57{{ $inm->telefono }}" target="_blank" class="btn btn-whatsapp">
                                    <i class="fa-brands fa-whatsapp" style="font-size:1.2rem;"></i> Contactar
                                </a>
                            </div>
                        </div>
                        
                    </article>
                @endforeach
            </div>
        @endif
    </div>

    <div id="modalRoot" style="display:none;"></div>

    <script>
        /* ==========================================================================
           TEMA LIGHT / DARK
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
           CONTROLES GRID / LIST
           ========================================================================== */
        const listing = document.getElementById('listing');
        const gridBtn = document.getElementById('gridBtn');
        const listBtn = document.getElementById('listBtn');

        if(gridBtn && listBtn && listing) {
            gridBtn.onclick = () => {
                listing.classList.remove('list-view');
                gridBtn.classList.add('active-toggle');
                listBtn.classList.remove('active-toggle');
            };
            
            listBtn.onclick = () => {
                listing.classList.add('list-view');
                listBtn.classList.add('active-toggle');
                gridBtn.classList.remove('active-toggle');
            };
        }

        /* ==========================================================================
           LÓGICA DEL MODAL
           ========================================================================== */
        const modalRoot = document.getElementById('modalRoot');

        // Cerrar modal al hacer clic fuera o en la X
        document.addEventListener('click', e => {
            if (e.target.classList.contains('modal-backdrop') || e.target.closest('.modal-close')) {
                const backdrop = modalRoot.querySelector('.modal-backdrop');
                if(backdrop) {
                    backdrop.style.animation = 'fadeIn 0.2s ease reverse forwards';
                    setTimeout(() => {
                        modalRoot.innerHTML = "";
                        modalRoot.style.display = "none";
                        document.body.style.overflow = 'auto';
                    }, 200);
                }
            }
        });

        // Cerrar modal con la tecla Escape
        document.addEventListener('keydown', (e) => {
            if(e.key === 'Escape' && modalRoot.style.display === 'block') {
                document.querySelector('.modal-backdrop').click();
            }
        });

        /* FUNCIÓN ORIGINAL RESPETADA (Con diseño de contenedor Premium) */
        function mostrarInmobiliaria(imgSrc, htmlContent){
            document.body.style.overflow = 'hidden'; // Evita scroll de fondo
            
            modalRoot.innerHTML = `
                <div class="modal-backdrop">
                    <div class="modal">
                        <button class="modal-close" title="Cerrar"><i class="fa-solid fa-xmark"></i></button>
                        <img src="${imgSrc}" alt="Logo Agencia">
                        <div style="padding-top: 10px;">
                            ${htmlContent}
                        </div>
                    </div>
                </div>
            `;
            modalRoot.style.display = "block";
        }
    </script>

</body>
</html>