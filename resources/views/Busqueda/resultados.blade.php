<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Resultados de la búsqueda</title>

    <style>
        /* 🎨 Variables globales de colores para facilitar cambios */
        :root {
            --primary: #0057ff;
            --text-dark: #222;
            --text-light: #666;
            --border: #e3e7ef;
            --bg: #f6f8fd;
        }

        /* Estilos generales del body */
        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            background: var(--bg);
            color: var(--text-dark);
        }

        /* Contenedor central para la página */
        .container {
            max-width: 1100px;
            margin: 60px auto;
            padding: 0 20px;
        }

        /* Enlace "volver" */
        .back {
            display: inline-block;
            margin-bottom: 25px;
            text-decoration: none;
            color: var(--primary);
            font-weight: 500;
        }

        /* Título principal */
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

        /* 🧱 Grid responsiva para mostrar tarjetas */
        .results-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(310px, 1fr));
            gap: 25px;
        }

        /* Estilo general de las tarjetas */
        .card {
            background: white;
            border: 2px solid var(--border);
            border-radius: 12px;
            padding: 0;
            overflow: hidden;
            transition: 0.3s ease;
            cursor: pointer;
        }

        /* Efecto hover en tarjetas */
        .card:hover {
            border-color: var(--primary);
            transform: translateY(-3px);
            box-shadow: 0 8px 26px rgba(0, 0, 0, 0.12);
        }

        /* Imagen superior de la tarjeta */
        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            background: #d7d7d7;
            display: block;
        }

        /* Contenido interno de la tarjeta */
        .card-content {
            padding: 18px;
        }

        /* Título del inmueble */
        .card h3 {
            margin: 0 0 9px;
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary);
        }

        /* Párrafos descriptivos */
        .card p {
            margin-bottom: 8px;
            color: var(--text-light);
            font-size: 0.9rem;
            line-height: 1.4rem;
        }

        /* Etiqueta superior con el tipo de inmueble */
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

        /* Estilo del mensaje cuando NO hay resultados */
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

        <!-- Botón para volver al inicio -->
        <a href="{{ url('/') }}" class="back"> Volver</a>

        <!-- Título principal -->
        <h1>Resultados encontrados</h1>

        <!-- Subtítulo explicativo -->
        <div class="subtitle">
            Aquí están los inmuebles que coinciden con tu búsqueda.
        </div>

        <!-- Verifica si existen inmuebles -->
        @if ($inmuebles->count() > 0)

            <!-- Grid donde se muestran los resultados -->
            <div class="results-grid">

                <!-- Recorremos cada inmueble -->
                @foreach ($inmuebles as $item)
                    @php
                        // Obtiene la primera imagen del inmueble, si existe.
                        // optional() evita error si no hay imagen.
                        $img = optional($item->imagens->first())->ruta;
                    @endphp

                    <div class="card">

                        <!-- Imagen principal del inmueble -->

                        <div style="position:relative;">
                            <img src="{{ $img ? asset('storage/' . $img) : asset('img/no-image.jpg') }}"
                                alt="Imagen inmueble">
                            <button class="fav" data-id="{{ $item->id }}">♡</button>
                            <button class="btn btn-light btn-sm"
                                onclick="abrirModal(
                                [
                                    @foreach ($item->imagens as $img)
                                        '{{ asset('storage/' . $img->ruta) }}', @endforeach
                                ],
                                0
                            )">
                                🔍 Ver imágenes
                            </button>
                        </div>


                        <div class="card-content">

                            <!-- Tipo del inmueble (ej. Casa, Apto...) -->
                            <div class="tag">{{ $item->tipo }}</div>

                            <!-- Título del anuncio -->
                            <h3>{{ $item->titulo }}</h3>

                            <!-- Municipio -->
                            <p><strong style="color:#333;">Municipio:</strong>
                                {{ $item->barrio->municipio->nombre }}
                            </p>

                            <!-- Barrio -->
                            <p><strong style="color:#333;">Barrio:</strong>
                                {{ $item->barrio->nombre }}
                            </p>

                            <!-- Descripción recortada -->
                            <p>{{ Str::limit($item->descripcion, 140) }}</p>

                        </div>

                    </div>
                @endforeach

            </div>
        @else
            <!-- Mensaje cuando NO hay resultados -->
            <div class="no-results">
                No se encontraron resultados.<br>
                Prueba buscando con otros términos o filtros.
            </div>

        @endif

    </div>

    <!-- ======================= -->
    <!-- MODAL DE CARRUSEL       -->
    <!-- ======================= -->
    <div id="imgModal" style="display:none;">
        <div class="modal-backdrop"
            style="position:fixed; inset:0; background:rgba(0,0,0,0.55);
               backdrop-filter:blur(8px); display:flex; justify-content:center;
               align-items:center; z-index:9999;">

            <div class="modal"
                style="background:white; padding:15px; border-radius:15px;
                   width:90%; max-width:760px; position:relative;">

                <!-- Botón Cerrar -->
                <button id="closeModal"
                    style="position:absolute; top:10px; right:10px; background:none;
                       border:none; font-size:26px; cursor:pointer;">✕</button>

                <!-- Imagen -->
                <img id="imgModalSrc" src=""
                    style="width:100%; height:420px; object-fit:contain; border-radius:10px;">

                <!-- Controles del carrusel -->
                <div style="display:flex; justify-content:space-between; margin-top:10px;">
                    <button id="prevBtn"
                        style="background:#0d6efd; padding:6px 14px; border:none;
                           color:white; border-radius:8px; cursor:pointer;">⬅
                        Anterior</button>

                    <button id="zoomBtn"
                        style="background:#6c757d; padding:6px 14px; border:none;
                           color:white; border-radius:8px; cursor:pointer;">🔍
                        Zoom</button>

                    <button id="nextBtn"
                        style="background:#0d6efd; padding:6px 14px; border:none;
                           color:white; border-radius:8px; cursor:pointer;">Siguiente
                        ➡</button>
                </div>

            </div>
        </div>
    </div>


    <script>
        let imagenesCarrusel = [];
        let indexActual = 0;

        function abrirModal(listaImagenes, indexInicial = 0) {
            imagenesCarrusel = listaImagenes;
            indexActual = indexInicial;

            actualizarImagen();

            document.getElementById('imgModal').style.display = "block";
        }

        function actualizarImagen() {
            document.getElementById('imgModalSrc').src = imagenesCarrusel[indexActual];
        }

        // Botones
        document.getElementById("prevBtn").addEventListener("click", () => {
            indexActual = (indexActual === 0) ?
                imagenesCarrusel.length - 1 :
                indexActual - 1;
            actualizarImagen();
        });

        document.getElementById("nextBtn").addEventListener("click", () => {
            indexActual = (indexActual === imagenesCarrusel.length - 1) ?
                0 :
                indexActual + 1;
            actualizarImagen();
        });

        document.getElementById("zoomBtn").addEventListener("click", () => {
            const zoom = window.open("", "_blank");
            zoom.document.write(`<img src="${imagenesCarrusel[indexActual]}" style="width:100%">`);
        });

        document.getElementById("closeModal").addEventListener("click", () => {
            document.getElementById('imgModal').style.display = "none";
        });
    </script>

</body>

</html>
