<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Resultados de la búsqueda</title>

    <style>
/* ===============================
   VARIABLES GLOBALES PREMIUM
================================ */
:root {
    --primary: #0057ff;
    --primary-dark: #003ecb;
    --accent: #00c2ff;
    --glass: rgba(255,255,255,0.75);
    --text-dark: #1f2937;
    --text-light: #6b7280;
    --border: rgba(0,0,0,0.08);
    --bg: linear-gradient(180deg, #f8fafc, #eef2ff);
}

/* ===============================
   BODY + FONDO PREMIUM
================================ */
body {
    margin: 0;
    font-family: "Poppins", sans-serif;
    background: var(--bg);
    color: var(--text-dark);
}

/* ===============================
   CONTENEDOR PRINCIPAL
================================ */
.container {
    max-width: 1200px;
    margin: 70px auto;
    padding: 0 24px;
}

/* ===============================
   BOTÓN VOLVER
================================ */
.back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 25px;
    text-decoration: none;
    color: white;
    background: var(--primary);
    padding: 9px 18px;
    border-radius: 50px;
    font-weight: 500;
    font-size: .9rem;
    transition: all .25s ease;
    box-shadow: 0 10px 20px rgba(0,0,0,.1);
}

.back:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
}

/* ===============================
   TITULO + SUBTITULO
================================ */
h1 {
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 10px;
    background: linear-gradient(to right, var(--primary), var(--accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.subtitle {
    font-size: .95rem;
    color: var(--text-light);
    margin-bottom: 40px;
}

/* ===============================
   GRID DE RESULTADOS
================================ */
.results-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 30px;
}

/* ===============================
   TARJETAS PRO
================================ */
.card {
    background: var(--glass);
    border: 1px solid var(--border);
    border-radius: 20px;
    overflow: hidden;
    backdrop-filter: blur(12px);
    transition: all .35s cubic-bezier(.4,0,.2,1);
    box-shadow: 0 10px 22px rgba(0,0,0,0.06);
}

.card:hover {
    transform: translateY(-8px) scale(1.01);
    box-shadow: 0 25px 50px rgba(0,0,0,0.15);
    border-color: var(--primary);
}

/* ===============================
   IMAGEN TARJETA
================================ */
.card img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    display: block;
    transition: .4s ease;
}

.card:hover img {
    transform: scale(1.06);
}

/* ===============================
   BOTONES SOBRE IMAGEN
================================ */
.card button {
    backdrop-filter: blur(5px);
}

/* ===============================
   CONTENIDO TARJETA
================================ */
.card-content {
    padding: 20px;
}

/* ===============================
   TAG DE TIPO
================================ */
.tag {
    display: inline-block;
    background: linear-gradient(135deg, var(--primary), var(--accent));
    color: #fff;
    padding: 6px 14px;
    border-radius: 100px;
    font-size: 0.72rem;
    font-weight: 600;
    margin-bottom: 12px;
}

/* ===============================
   TITULO INMUEBLE
================================ */
.card h3 {
    margin: 0 0 10px;
    font-size: 1.1rem;
    font-weight: 600;
}

/* ===============================
   TEXTOS INFO
================================ */
.card p {
    margin-bottom: 6px;
    color: var(--text-light);
    font-size: .9rem;
    line-height: 1.5;
}

/* ===============================
   BOTONES SOBRE LA IMAGEN
================================ */
.fav {
    position: absolute;
    top: 12px;
    right: 14px;
    border-radius: 50%;
    width: 36px;
    height: 36px;
    border: none;
    background: rgba(255,255,255,0.9);
    font-size: 18px;
    cursor: pointer;
    transition: .3s;
}

.fav:hover {
    background: var(--primary);
    color: white;
    transform: scale(1.1);
}

/* Botón ver imágenes */
.card .btn {
    position: absolute;
    bottom: 12px;
    left: 12px;
    border-radius: 50px;
    background: white;
    border: none;
    font-size: .8rem;
    padding: 6px 14px;
    box-shadow: 0 8px 15px rgba(0,0,0,.15);
    transition: .3s;
}

.card .btn:hover {
    background: var(--primary);
    color: white;
}

/* ===============================
   MENSAJE SIN RESULTADOS
================================ */
.no-results {
    background: linear-gradient(120deg, #fff7e6, #fff3cd);
    border-left: 6px solid #ffcc00;
    padding: 22px;
    border-radius: 14px;
    max-width: 550px;
    margin-top: 20px;
    color: #7a6c00;
    font-size: 0.95rem;
    box-shadow: 0 12px 30px rgba(0,0,0,.08);
}

/* ===============================
   MODAL MEJORADO
================================ */
#imgModal .modal {
    animation: zoomIn .3s ease;
}

@keyframes zoomIn {
    from { transform: scale(.7); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

/* Botones carrusel animados */
#prevBtn,
#nextBtn,
#zoomBtn {
    transition: all .25s ease;
}

#prevBtn:hover,
#nextBtn:hover,
#zoomBtn:hover {
    transform: scale(1.08);
    background: var(--primary-dark) !important;
}

/* ===============================
   RESPONSIVE
================================ */
@media (max-width: 600px) {

    h1 {
        font-size: 1.6rem;
    }

    .card img {
        height: 180px;
    }

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
