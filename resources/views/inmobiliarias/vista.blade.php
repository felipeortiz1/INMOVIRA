<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Inmobiliarias</title>

    <style>
        :root {
            --bg: #FAFCFF;
            --card: #ffffff;
            --muted: #6b7280;
            --accent: #1f3b8b;
            --accent-hover: #274baf;
            --shadow: 0 10px 28px rgba(0, 0, 0, .08);
            --radius: 18px;
        }

        body {
            margin: 0;
            font-family: Inter, system-ui;
            background: var(--bg);
            display: flex;
        }

        /* SIDEBAR */
        .sidebar {
            width: 220px;
            background: #0f172a;
            min-height: 100vh;
            padding: 25px 20px;
            color: white;
            position: sticky;
            top: 0;
        }

        .sidebar h2 {
            font-size: 1.1rem;
            margin-bottom: 25px;
            letter-spacing: 1px;
        }

        .sidebar a {
            display: block;
            padding: 12px 14px;
            margin-bottom: 10px;
            border-radius: 12px;
            text-decoration: none;
            color: #c7d2fe;
            transition: .2s;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, .08);
            color: white;
            transform: translateX(5px);
        }

        /* MAIN */
        .main {
            flex: 1;
            padding: 40px 30px;
        }

        h1 {
            margin-top: 0;
            margin-bottom: 25px;
            color: var(--accent);
        }

        /* BUSCADOR */
        .search-box {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
        }

        .search-box input {
            flex: 1;
            padding: 14px 18px;
            border-radius: 14px;
            border: 1px solid #ddd;
            font-size: .95rem;
        }

        .search-box button {
            border-radius: 14px;
            padding: 14px 22px;
            border: none;
            background: var(--accent);
            color: white;
            cursor: pointer;
            font-weight: 600;
        }

        .search-box button:hover {
            background: var(--accent-hover);
        }

        /* CARD HORIZONTAL */
        .inmo-card {
            display: grid;
            grid-template-columns: 260px 1fr;
            background: var(--card);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            margin-bottom: 26px;
            transition: .3s ease;
            animation: fadeUp .5s ease;
        }

        .inmo-card:hover {
            transform: translateY(-7px) scale(1.01);
            box-shadow: 0 18px 40px rgba(0, 0, 0, .12);
        }

        .inmo-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .inmo-info {
            padding: 22px 28px;
            display: flex;
            flex-direction: column;
        }

        .inmo-info h3 {
            margin: 0;
            font-size: 1.25rem;
            color: var(--accent);
        }

        .inmo-info p {
            margin: 5px 0;
            color: var(--muted);
            font-size: .95rem;
        }

        .actions {
            margin-top: auto;
            display: flex;
            gap: 14px;
            padding-top: 12px;
        }

        .btn {
            padding: 10px 18px;
            border-radius: 999px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: .25s;
        }

        .btn-primary {
            background: var(--accent);
            color: white;
        }

        .btn-primary:hover {
            background: var(--accent-hover);
            transform: translateY(-2px) scale(1.02);
        }

        .btn-outline {
            border: 2px solid var(--accent);
            color: var(--accent);
        }

        .btn-outline:hover {
            background: var(--accent);
            color: white;
        }

        /* RESPONSIVE */
        @media(max-width:900px) {

            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                display: flex;
                overflow-x: auto;
                gap: 8px;
                min-height: unset;
            }

            .sidebar h2 {
                display: none;
            }

            .sidebar a {
                white-space: nowrap;
            }

            .inmo-card {
                grid-template-columns: 1fr;
            }

            .inmo-img {
                height: 200px;
            }
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR VERTICAL -->
    <div class="sidebar">
        <h2>NAVEGACIÓN</h2>

        <a href="{{ route('pagina.principal') }}">🏠 Inicio</a>
        <a href="{{ route('vista.arriendo') }}">🏘 Arriendo</a>
        <a href="{{ route('vista.venta') }}">💰 Venta</a>
        <a href="{{ route('vista.inmobiliarias') }}">🏢 Inmobiliarias</a>
        <a href="javascript:history.back()">🔙 Volver</a>
    </div>

    <!-- MAIN -->
    <div class="main">

        <h1>Inmobiliarias registradas</h1>

        <!-- BUSCADOR -->
        <form method="GET" class="search-box" action="{{ route('vista.inmobiliarias') }}">
            <input type="search" name="q"
                    placeholder="Buscar inmobiliaria..."
                    value="{{ request('q') }}">
            <button>Buscar</button>
        </form>

        @if($inmobiliarias->isEmpty())
            <p style="color:#777">No hay inmobiliarias registradas.</p>
        @else

            @foreach($inmobiliarias as $inm)
                <div class="inmo-card">

                    <div class="inmo-img">
                        <img src="{{ $inm->imagen
                            ? asset('storage/'.$inm->imagen)
                            : asset('img/usuarios/default.png') }}">
                    </div>

                    <div class="inmo-info">

                        <h3>{{ $inm->nombreEmpresa }}</h3>

                        <p><b>Representante:</b> {{ $inm->nombre }}</p>
                        <p><b>Email:</b> {{ $inm->email }}</p>
                        <p><b>Teléfono:</b> {{ $inm->telefono }}</p>

                        <div class="actions">

                            <!-- APARTADO INDEPENDIENTE -->
                            <a href="{{ route('inmobiliaria.ver', $inm->id) }}"
                                class="btn btn-primary">
                                🔍 Ver más
                            </a>

                            <a href="https://wa.me/57{{ $inm->telefono }}"
                                target="_blank"
                                class="btn btn-outline">
                                📱 WhatsApp
                            </a>

                        </div>

                    </div>

                </div>
            @endforeach

        @endif
    </div>

</body>
</html>
