<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Inmobiliarias</title>

    <style>
        :root{
            --bg: #FAFCFF;
            --card: #ffffff;
            --muted: #7a7f8c;
            --accent: #8CB4FF;
            --accent-hover: #6EA1FF;
            --shadow: 0 4px 16px rgba(0,0,0,0.05);
        }

        [data-theme="dark"]{
            --bg: #1a1f2a;
            --card: #242b38;
            --muted: #d0d6e0;
            --accent: #9CC4FF;
            --accent-hover: #7FB0FF;
            --shadow: 0 6px 28px rgba(0,0,0,0.55);
            color: #e6eef8;
        }

        html,body{height:100%; margin:0; font-family:Inter, Poppins, system-ui;}
        body{ background:var(--bg); color:#0f172a; transition:.25s; }

        /* NAV */
        .nav{
            display:flex; justify-content:space-between; align-items:center;
            padding:14px 28px;
            background:var(--card);
            box-shadow:var(--shadow);
            position:sticky; top:0; z-index:120;
        }
        .nav .left a{
            color:var(--accent); font-weight:600; margin-right:18px;
            text-decoration:none; transition:.2s;
        }
        .nav .left a:hover{ color:var(--accent-hover); }

        .btn { padding:8px 12px; border-radius:10px; border:none; cursor:pointer; font-weight:600; }
        .btn-ghost { background: transparent; color:var(--accent); border:1px solid rgba(0,0,0,0.07); }
        .btn-ghost:hover { background: rgba(140,180,255,0.12); }
        .btn-primary { background:var(--accent); color:white; text-decoration:none; }
        .btn-primary:hover { background:var(--accent-hover); }

        .container{ max-width:1120px; margin:36px auto; padding:0 18px; }
        h1{ text-align:center; margin-bottom:20px; font-size:2rem; }

        /* BUSCADOR */
        .filters{
            display:flex; gap:12px; flex-wrap:wrap;
            background:var(--card);
            padding:16px;
            border-radius:14px;
            box-shadow:var(--shadow);
            border:1px solid rgba(0,0,0,0.04);
            margin-bottom:24px;
        }
        .filters input{
            flex:1;
            padding:10px 12px;
            border-radius:10px;
            border:1px solid rgba(0,0,0,0.1);
            background:var(--bg);
        }
        .filters input:focus{
            border-color:var(--accent);
            box-shadow:0 0 0 2px rgba(140,180,255,0.3);
        }

        /* GRID / LIST */
        .list-grid{
            display:flex;
            flex-direction:column;
            gap:18px;
        }
        .list-view{ display:flex; flex-direction:column; }
        .list-view{ display:block; }

        /* CARD */
        .card{
            background:var(--card);
            border-radius:14px;
            box-shadow:var(--shadow);
            overflow:hidden;
            transition:.25s;
            display:flex;
            flex-direction:row;
            align-items:stretch;
        }
        .card:hover{ transform:translateY(-4px); }

        .card img{
            width:260px;
            height:180px;
            object-fit:cover;
            flex-shrink:0;
        }

        .card-body{
            padding:14px;
            display:flex;
            flex-direction:column;
            gap:6px;
        }

        .muted{ color:var(--muted); font-size:.9rem; }

        .actions{
            margin-top:10px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:10px;
        }

        /* MODAL */
        .modal-backdrop{
            position:fixed; inset:0;
            background:rgba(0,0,0,0.45);
            backdrop-filter:blur(6px);
            display:flex; justify-content:center; align-items:center;
            animation:fadeIn .25s;
            z-index:200;
        }

        .modal{
            background:var(--card);
            padding:16px;
            border-radius:14px;
            width:90%;
            max-width:600px;
            max-height:90vh;
            overflow-y:auto;
            position:relative;
        }

        .modal img{
            max-width:100%;
            border-radius:10px;
            margin-bottom:10px;
        }

        @keyframes fadeIn{
            from{ opacity:0; transform:translateY(8px); }
        }
    </style>
</head>

<body>

    {{-- NAV --}}
    <nav class="nav">
        <div class="left">
            <a href="{{ route('pagina.principal') }}">Inicio</a>
            <a href="{{ route('vista.arriendo') }}">Arriendo</a>
            <a href="{{ route('vista.venta') }}">Venta</a>
            <a href="{{ route('vista.inmobiliarias') }}">Inmobiliarias</a>
        </div>

        <div class="right">
            <button id="toggleTheme" class="btn btn-ghost">🌓</button>
            <a href="{{ route('login') }}" class="btn btn-ghost">Iniciar sesión</a>
        </div>
    </nav>

    <div class="container">
        <h1>Inmobiliarias registradas</h1>

        {{-- BUSCADOR --}}
        <form class="filters" method="GET" action="{{ route('vista.inmobiliarias') }}">
            <input type="search" name="q" placeholder="Buscar inmobiliaria..."
                    value="{{ request('q') }}">
            <button class="btn btn-primary">Buscar</button>
            <a href="{{ route('vista.inmobiliarias') }}" class="btn btn-ghost">Limpiar</a>
        </form>

        <div class="controls" style="margin-bottom:12px; display:flex; align-items:center; gap:10px;">
            <button id="gridBtn" class="btn btn-ghost">Horizontal</button>
            <button id="listBtn" class="btn btn-ghost">Lista</button>
            <span class="muted">Total: <b>{{ $inmobiliarias->count() }}</b></span>
        </div>

        @if($inmobiliarias->isEmpty())
            <div style="text-align:center; margin-top:40px;" class="muted">No hay inmobiliarias registradas.</div>
        @else
            <div id="listing" class="list-grid">

                @foreach($inmobiliarias as $inm)

                    <article class="card">

                        <img src="{{ $inm->imagen ? asset('storage/'.$inm->imagen) : asset('img/usuarios/default.png') }}">

                        <div class="card-body">

                            <h3 style="margin:0;">{{ $inm->nombreEmpresa }}</h3>

                            <div class="muted"><b>Representante:</b> {{ $inm->nombre }}</div>
                            <div class="muted"><b>Email:</b> {{ $inm->email }}</div>
                            <div class="muted"><b>Teléfono:</b> {{ $inm->telefono }}</div>

                            <div class="actions">

                                <a href="{{ route('inmobiliaria.ver', $inm->id) }}" class="btn btn-ghost">
                                    Ver más
                                </a>

                                <a href="https://wa.me/57{{ $inm->telefono }}"
                                    target="_blank"
                                    class="btn btn-primary">
                                    WhatsApp
                                </a>

                            </div>

                        </div>
                    </article>
                @endforeach

            </div>
        @endif
    </div>

    {{-- MODAL ROOT --}}
    <div id="modalRoot" style="display:none;"></div>

    <script>
        /* TEMA */
        const body = document.body;
        const themeBtn = document.getElementById('toggleTheme');

        (function initTheme(){
            const match = document.cookie.split('; ').find(r => r.startsWith('theme='));
            const theme = match ? match.split('=')[1] :
                (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            body.setAttribute('data-theme', theme);
        })();

        themeBtn.onclick = () => {
            const isDark = body.getAttribute('data-theme') === 'dark';
            const newTheme = isDark ? 'light' : 'dark';
            body.setAttribute('data-theme', newTheme);
            document.cookie = "theme="+newTheme+"; path=/; max-age=" + 60*60*24*365;
        };

        /* GRID/LIST */
        const listing = document.getElementById('listing');
        document.getElementById('gridBtn').onclick = () => listing.classList.remove('list-view');
        document.getElementById('listBtn').onclick = () => listing.classList.add('list-view');

        /* CERRAR MODAL */
        document.addEventListener('click', e => {
            if (e.target.classList.contains('modal-backdrop') ||
                e.target.classList.contains('modal-close')) {
                modalRoot.innerHTML = "";
                modalRoot.style.display = "none";
            }
        });

        /* MOSTRAR MODAL */
        function mostrarInmobiliaria(imgSrc, htmlContent){
            const modalRoot = document.getElementById('modalRoot');
            modalRoot.innerHTML = `
                <div class="modal-backdrop">
                    <div class="modal">
                        <button class="modal-close"
                            style="position:absolute;right:10px;top:10px;background:transparent;border:none;font-size:20px;cursor:pointer;">✕</button>
                        <img src="${imgSrc}">
                        <div>${htmlContent}</div>
                    </div>
                </div>
            `;
            modalRoot.style.display = "block";
        }
    </script>

</body>
</html>
