<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inmobiliarias</title>

    <style>
        /* ====== ESTILOS GENERALES ====== */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background: #f6f9fc;
            color: #333;
        }

        /* ====== NAVBAR ====== */
        .nav {
            background: white;
            padding: 14px 38px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .nav a {
            text-decoration: none;
            color: #4da3ff;
            font-weight: 600;
            margin-right: 18px;
            transition: 0.2s;
        }

        .nav a:hover {
            color: #1e8cff;
        }

        /* ====== CONTENEDOR ====== */
        .container {
            max-width: 1100px;
            margin: 50px auto;
            padding: 0 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 2.4rem;
            font-weight: 700;
            color: #222;
        }

        /* ====== GRID ====== */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 28px;
        }

        /* ====== CARD ====== */
        .card {
            background: white;
            padding: 22px;
            border-radius: 18px;
            box-shadow: 0px 4px 14px rgba(0,0,0,0.07);
            transition: 0.25s;
            border: 1px solid #e9edf3;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 25px rgba(0,0,0,0.12);
        }

        .card h3 {
            margin: 0;
            font-size: 1.35rem;
            color: #4da3ff;
            font-weight: 700;
        }

        .card p {
            margin: 8px 0;
            color: #555;
            line-height: 1.45;
        }

        /* ====== BADGE ====== */
        .badge {
            display: inline-block;
            margin-top: 14px;
            padding: 6px 15px;
            border-radius: 50px;
            font-size: 0.78rem;
            background: #4da3ff;
            color: white;
            font-weight: 500;
            letter-spacing: 0.3px;
        }

        /* ====== MENSAJE VACÍO ====== */
        .empty {
            text-align: center;
            color: #666;
            font-size: 1.1rem;
            margin-top: 50px;
        }
    </style>
</head>

<body>

    <!-- NAV -->
    <nav class="nav">
        <div>
            <a href="{{ url('/') }}">Inicio</a>
            <a href="{{ route('vista.arriendo') }}">Arriendo</a>
            <a href="{{ route('vista.venta') }}">Venta</a>
            <a href="{{ route('vista.inmobiliarias') }}">Inmobiliarias</a>
        </div>

        <a href="{{ route('login') }}" style="color:#1e8cff; font-weight:600;">Iniciar sesión</a>
    </nav>



    <!-- CONTENIDO -->
    <div class="container">

        <h1>Inmobiliarias Registradas</h1>

        @if ($inmobiliarias->isEmpty())
            <p class="empty">No hay inmobiliarias registradas aún.</p>
        @else
            <div class="grid">
                @foreach ($inmobiliarias as $inm)
                    <div class="card">
                        <h3>{{ $inm->nombreEmpresa ?? 'Sin nombre comercial' }}</h3>

                        <p><strong>Representante:</strong> {{ $inm->nombre }}</p>
                        <p><strong>Email:</strong> {{ $inm->email }}</p>
                        <p><strong>Teléfono:</strong> {{ $inm->telefono }}</p>

                        <span class="badge">Inmobiliaria</span>
                    </div>
                @endforeach
            </div>
        @endif

    </div>

</body>
</html>
