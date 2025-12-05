<!DOCTYPE html>
<html lang="es">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <meta charset="UTF-8">
    <title>Resultados de la búsqueda</title>

    <style>
/* ===============================
    VARIABLES GLOBALES PREMIUM
    (Se añadieron más variables 
    para micro-interacciones)
================================ */
:root {
    --primary: #0057ff;
    --primary-dark: #003ecb;
    --primary-light: #4d8bff;
    --accent: #00c2ff;
    --accent-soft: #e0f6ff;
    --success: #16a34a;
    --danger: #dc2626;
    --warning: #f59e0b;
    --glass: rgba(255,255,255,0.75);
    --glass-strong: rgba(255,255,255,0.9);
    --text-dark: #1f2937;
    --text-light: #6b7280;
    --border: rgba(0,0,0,0.08);
    --border-strong: rgba(0,0,0,0.15);
    --bg: linear-gradient(180deg, #f8fafc, #eef2ff);
    --radius-sm: 10px;
    --radius-md: 16px;
    --radius-lg: 24px;
    --radius-xl: 32px;
    --shadow-sm: 0 4px 10px rgba(0,0,0,0.04);
    --shadow-md: 0 12px 24px rgba(0,0,0,0.08);
    --shadow-lg: 0 25px 60px rgba(0,0,0,0.12);
    --shadow-xl: 0 30px 80px rgba(0,0,0,0.16);
}

/* ===============================
    BODY + FONDO PREMIUM
================================ */
body {
    margin: 0;
    font-family: "Poppins", sans-serif;
    background: var(--bg);
    color: var(--text-dark);
    min-height: 100vh;
    background-attachment: fixed;
}

/* Fondo con ruido suave */
body::after {
    content: "";
    position: fixed;
    inset: 0;
    background-image: radial-gradient(rgba(0,0,0,0.03) 1px, transparent 1px);
    background-size: 18px 18px;
    pointer-events: none;
    z-index: -1;
}

/* ===============================
    CONTENEDOR PRINCIPAL
================================ */
.container {
    max-width: 1200px;
    margin: 70px auto;
    padding: 0 24px 50px;
    position: relative;
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
    background: linear-gradient(135deg,var(--primary),var(--accent));
    padding: 10px 22px;
    border-radius: 50px;
    font-weight: 500;
    font-size: .95rem;
    transition: all .25s ease;
    box-shadow: var(--shadow-md);
    letter-spacing: .3px;
}

.back:hover {
    background: linear-gradient(135deg,var(--primary-dark),var(--primary));
    transform: translateY(-3px) scale(1.02);
    box-shadow: var(--shadow-lg);
}

/* ===============================
    TITULO + SUBTITULO
================================ */
h1 {
    font-size: 2.4rem;
    font-weight: 800;
    margin-bottom: 14px;
    background: linear-gradient(to right, var(--primary), var(--accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.subtitle {
    font-size: 1rem;
    color: var(--text-light);
    margin-bottom: 40px;
    max-width: 600px;
}

/* ===============================
    GRID DE RESULTADOS
================================ */
.results-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 32px;
}

/* ===============================
    TARJETAS PRO
================================ */
.card {
    position: relative;
    background: var(--glass);
    border: 1px solid var(--border);
    border-radius: 22px;
    overflow: hidden;
    backdrop-filter: blur(14px);
    transition: all .4s cubic-bezier(.4,0,.2,1);
    box-shadow: var(--shadow-md);
}

.card::before {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(120deg, transparent 60%, rgba(0,87,255,.04));
    opacity: 0;
    transition: .4s;
}

.card:hover::before {
    opacity: 1;
}

.card:hover {
    transform: translateY(-10px) scale(1.015);
    box-shadow: var(--shadow-xl);
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
    transition: .6s ease;
}

.card:hover img {
    transform: scale(1.08);
}

/* ===============================
    BOTONES SOBRE IMAGEN
================================ */
.card button {
    backdrop-filter: blur(8px);
}

/* ===============================
    CONTENIDO TARJETA
================================ */
.card-content {
    padding: 22px 22px 26px;
}

/* ===============================
    TAG DE TIPO
================================ */
.tag {
    display: inline-block;
    background: linear-gradient(135deg, var(--primary), var(--accent));
    color: #fff;
    padding: 6px 16px;
    border-radius: 100px;
    font-size: 0.72rem;
    font-weight: 700;
    margin-bottom: 12px;
    letter-spacing: .5px;
}

/* ===============================
    TITULO INMUEBLE
================================ */
.card h3 {
    margin: 0 0 12px;
    font-size: 1.15rem;
    font-weight: 700;
}

/* ===============================
    TEXTOS INFO
================================ */
.card p {
    margin-bottom: 8px;
    color: var(--text-light);
    font-size: .93rem;
    line-height: 1.6;
}



/* ===============================
    BOTONES SOBRE LA IMAGEN
================================ */
.fav {
    position: absolute;
    top: 14px;
    right: 16px;
    border-radius: 50%;
    width: 38px;
    height: 38px;
    border: none;
    background: var(--glass-strong);
    font-size: 18px;
    cursor: pointer;
    transition: .3s;
}

.fav:hover {
    background: var(--primary);
    color: white;
    transform: scale(1.15) rotate(5deg);
}



/* ===============================
    MENSAJE SIN RESULTADOS
================================ */
.no-results {
    background: linear-gradient(120deg, #fff7e6, #fff3cd);
    border-left: 6px solid var(--warning);
    padding: 24px;
    border-radius: 18px;
    max-width: 550px;
    margin-top: 20px;
    color: #7a6c00;
    font-size: 0.95rem;
    box-shadow: var(--shadow-md);
}

/* ===============================
    MODAL MEJORADO
================================ */
#imgModal .modal {
    animation: zoomIn .35s ease;
}

.see-images-btn {
    width: 100%;
    border: none;
    background: var(--primary);
    color: white;
    padding: 10px;
    border-radius: 12px;
    font-size: .85rem;
    margin: 10px 0 15px;
    transition: .3s;
}

.see-images-btn:hover {
    background: var(--primary-dark);
}


@keyframes zoomIn {
    from { transform: scale(.7) translateY(40px); opacity: 0; }
    to { transform: scale(1) translateY(0); opacity: 1; }
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
    CONTENEDOR CON BARRA LATERAL
================================ */
.main-content{
    display:flex;
    gap:34px;
}

/* ===============================
    COLUMNA IZQUIERDA - FILTROS
================================ */
.filters-wrapper{
    width:300px;
    flex-shrink:0;
}

.filters{
    background: var(--glass);
    padding:24px;
    border-radius:24px;
    border:1px solid var(--border);
    display:flex;
    flex-direction:column;
    gap:16px;
    backdrop-filter: blur(12px);
    box-shadow: var(--shadow-sm);
}

.filters label{
    display:flex;
    align-items:center;
    gap:8px;
    font-size:.9rem;
}

.filters input, .filters select{
    padding:12px 14px;
    border-radius:12px;
    border:1px solid var(--border);
    font-size:.9rem;
    outline:none;
    transition:.25s;
}

.filters input:focus{
    border-color: var(--primary);
    box-shadow: 0 0 0 2px rgba(0,87,255,.1);
}

/* Botón filtro */
.filter-btn{
    background: linear-gradient(135deg,var(--primary),var(--accent));
    color: white;
    border:none;
    padding:12px;
    border-radius:14px;
    cursor:pointer;
    transition:.3s;
    font-weight:600;
}

.filter-btn:hover{
    background: linear-gradient(135deg,var(--primary-dark),var(--primary));
    transform: translateY(-2px);
}



/* ===============================
    COLUMNA DERECHA
================================ */
.results-wrapper{
    flex:1;
}

/* Adaptar grid cuando hay barra lateral */
.results-wrapper .results-grid{
    grid-template-columns: repeat(2, 1fr);
}

/* ===============================
    RESPONSIVE
================================ */
@media (max-width:900px){
    .main-content{
        flex-direction:column;
    }

    .filters-wrapper{
        width:100%;
    }

    .results-wrapper .results-grid{
        grid-template-columns:1fr;
    }
}

@media (max-width: 600px) {
    h1 {
        font-size: 1.65rem;
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

<div class="main-content">

    <!-- FILTROS A LA IZQUIERDA -->
    <div class="filters-wrapper">
        <form class="filters" method="GET" action="{{ route('buscador.inmuebles') }}">

            <!-- Texto general de búsqueda -->
            <input type="text" name="q" placeholder="Buscar por título, barrio o municipio..." value="{{ request('q') }}">

            <!-- MUNICIPIO -->
        <select name="municipio_id" id="municipioSelect">
            <option value="">Seleccionar municipio</option>
            @foreach($municipios as $municipio)
                <option value="{{ $municipio->id }}"
                    {{ request('municipio_id') == $municipio->id ? 'selected' : '' }}>
                    {{ $municipio->nombre }}
                </option>
            @endforeach
        </select>

                <!-- PRECIO MÍNIMO -->
<input 
    type="number" 
    name="precio_min" 
    placeholder="Precio mínimo" 
    min="0" 
    value="{{ request('precio_min') }}"
>

<!-- PRECIO MÁXIMO -->
<input 
    type="number" 
    name="precio_max" 
    placeholder="Precio máximo" 
    min="0" 
    value="{{ request('precio_max') }}"

            <!-- Tipos de inmueble (deben ser ARRAY: tipos[]) -->
            <label><input type="checkbox" name="tipos[]" value="Casa"
                {{ in_array('Casa', request('tipos', [])) ? 'checked' : '' }}> Casa</label>

            <label><input type="checkbox" name="tipos[]" value="Apartamento"
                {{ in_array('Apartamento', request('tipos', [])) ? 'checked' : '' }}> Apartamento</label>

            <label><input type="checkbox" name="tipos[]" value="Lote"
                {{ in_array('Lote', request('tipos', [])) ? 'checked' : '' }}> Lote</label>

            <button type="submit" class="filter-btn">Aplicar filtros</button>

            <a href="{{ route('buscador.inmuebles') }}"
            style="text-align:center;font-size:0.85rem;color:var(--primary);text-decoration:none;">
            Limpiar filtros
            </a>
        </form>

    </div>

    <!-- RESULTADOS A LA DERECHA -->
    <div class="results-wrapper">
        <div class="results-grid">

            @foreach ($inmuebles as $item)
        @php
            $raw = json_decode($item->imagenes, true) ?: [];

            $images = array_map(function($p){
                if(!$p) return null;

                // Si ya es URL completa, devolverla
                if(Str::startsWith($p, ['http://','https://','/'])) {
                    return $p;
                }

                // Si es relativa, convertir a URL válida
                return asset('storage/' . ltrim($p, '/'));
            }, $raw);

            $images = array_values(array_filter($images));
        @endphp

        <div class="card">

            <button class="fav">❤</button>


            <img src="{{ $images[0] ?? 'https://via.placeholder.com/400x250' }}" alt="Imagen inmueble">

            <div class="card-content">
                <span class="tag">{{ $item->tipo }}</span>

                <h3>{{ $item->titulo }}</h3>

                <button class="see-images-btn" type="button" onclick="abrirModal(@json($images), 0)">
                    📷 Ver imágenes
                </button>

                <p><strong>Precio:</strong> ${{ number_format($item->precio) }}</p>
                <p><strong>Ubicación:</strong> {{ $item->direccion }}</p>
                <p class="location"><strong>Municipio:</strong>
                    <i class="fa-solid fa-map-location-dot"></i>
                    {{ $item->barrio->municipio->nombre ?? 'Sin municipio' }} - {{ $item->barrio->nombre ?? '' }}
                </p>
                @if($item->usuario)
                <div class="contacto-inmueble">

                    @if(!empty($item->usuario->telefono))
                        <p class="contact-info">
                            <strong>Teléfono:</strong>
                            <i class="fa-solid fa-phone"></i>
                            {{ $item->usuario->telefono }}
                        </p>
                    @endif

                    @if(!empty($item->usuario->email))
                        <p class="contact-info">
                            <strong>Correo:</strong>
                            <i class="fa-solid fa-envelope"></i>
                            {{ $item->usuario->email }}
                        </p>
                    @endif


                </div>
                @endif



            </div>

        </div>

@endforeach

        </div>
    </div>

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
    



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>
