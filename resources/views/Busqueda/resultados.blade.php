<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados de la búsqueda</title>

    <style>
        :root {
            --primary: #0057ff;
            --text-dark: #222;
            --text-light: #666;
            --border: #e3e7ef;
            --bg: #f6f8fd;
        }

        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            background: var(--bg);
            color: var(--text-dark);
        }

        /* Contenedor */
        .container {
            max-width: 1100px;
            margin: 60px auto;
            padding: 0 20px;
        }

        /* Regresar */
        .back {
            display: inline-block;
            margin-bottom: 25px;
            text-decoration: none;
            color: var(--primary);
            font-weight: 500;
            transition: 0.2s;
        }
        .back:hover {
            opacity: 0.8;
        }

        /* Título */
        h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 25px;
            color: var(--primary);
        }

        /* Subtítulo */
        .subtitle {
            font-size: 0.95rem;
            color: var(--text-light);
            margin-bottom: 35px;
        }

        /* Grid de tarjetas */
        .results-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(310px, 1fr));
            gap: 25px;
        }

        /* Tarjeta */
        .card {
            background: white;
            border: 2px solid var(--border);
            border-radius: 12px;
            padding: 18px;
            transition: 0.3s ease;
            cursor: pointer;
        }

        .card:hover {
            border-color: var(--primary);
            transform: translateY(-3px);
            box-shadow: 0 8px 26px rgba(0,0,0,0.12);
        }

        .card h3 {
            margin: 0 0 9px;
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary);
        }

        .card p {
            margin-bottom: 8px;
            color: var(--text-light);
            font-size: 0.9rem;
            line-height: 1.4rem;
        }

        /* Etiqueta tipo */
        .tag {
            display: inline-block;
            background: rgba(0, 87, 255, 0.12);
            color: var(--primary);
            padding: 5px 12px;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-bottom: 12px;
        }

        /* Sin resultados */
        .no-results {
            background: #fff3cd;
            border-left: 6px solid #ffcc00;
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
            margin-top: 20px;
            color: #7a6c00;
            font-size: 0.95rem;
        }

    </style>

</head>
<body>

<div class="container">

    <!-- Volver -->
    <a href="{{ url('/') }}" class="back"> Volver</a>

    <h1>Resultados encontrados</h1>

    <div class="subtitle">
        Aquí están los inmuebles que coinciden con tu búsqueda.
    </div>

    @if($inmuebles->count() > 0)

        <div class="results-grid">

            @foreach($inmuebles as $item)
            <div class="card">

                <div class="tag">{{ $item->tipo }}</div>

                <h3>{{ $item->titulo }}</h3>

                <p><strong style="color:#333;">Municipio:</strong> {{ $item->barrio->municipio->nombre }}</p>

                <p>{{ Str::limit($item->descripcion, 140) }}</p>

            </div>
            @endforeach

        </div>

    @else

        <div class="no-results">
            No se encontraron resultados.<br>
            Prueba buscando con otros términos o filtros.
        </div>

    @endif

</div>

</body>
</html>
