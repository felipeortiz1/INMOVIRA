<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de la búsqueda</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #0057ff;
            --primary-dark: #003ecb;
            --primary-light: #4d8bff;
            --accent: #00c2ff;
            --accent-soft: #e0f6ff;
            --success: #16a34a;
            --danger: #dc2626;
            --warning: #f59e0b;
            --glass: rgba(255, 255, 255, 0.85);
            --glass-strong: rgba(255, 255, 255, 0.95);
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --border: rgba(0, 0, 0, 0.06);
            --bg: linear-gradient(180deg, #f8fafc, #eef2ff);
            --shadow-sm: 0 4px 10px rgba(0,0,0,0.02);
            --shadow-md: 0 12px 24px rgba(0,0,0,0.06);
            --shadow-lg: 0 25px 60px rgba(0,0,0,0.1);
            --shadow-xl: 0 30px 80px rgba(0,0,0,0.14);
        }

        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            background: var(--bg);
            color: var(--text-dark);
            min-height: 100vh;
            background-attachment: fixed;
        }

        body::after {
            content: "";
            position: fixed;
            inset: 0;
            background-image: radial-gradient(rgba(0,0,0,0.02) 1px, transparent 1px);
            background-size: 18px 18px;
            pointer-events: none;
            z-index: -1;
        }

        .container {
            max-width: 1240px;
            margin: 40px auto;
            padding: 0 24px 50px;
        }

        .back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 25px;
            text-decoration: none;
            color: white;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 500;
            font-size: .95rem;
            transition: all .25s ease;
            box-shadow: var(--shadow-md);
        }

        .back:hover {
            color: white;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        h1 {
            font-size: 2.4rem;
            font-weight: 800;
            margin-bottom: 8px;
            background: linear-gradient(to right, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .subtitle {
            font-size: 1rem;
            color: var(--text-light);
            margin-bottom: 40px;
        }

        .main-content {
            display: flex;
            gap: 34px;
            align-items: flex-start;
        }

        .filters-wrapper {
            width: 320px;
            flex-shrink: 0;
            position: sticky;
            top: 20px;
            z-index: 10;
        }

        .filters {
            background: var(--glass);
            padding: 26px;
            border-radius: 24px;
            border: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            gap: 18px;
            backdrop-filter: blur(16px);
            box-shadow: var(--shadow-md);
        }

        .filters h5 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 4px;
            color: var(--text-dark);
        }

        .filters label {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: .9rem;
            cursor: pointer;
            color: var(--text-dark);
        }

        .filters input[type="checkbox"] {
            width: 17px;
            height: 17px;
            accent-color: var(--primary);
        }

        .filters input[type="text"], 
        .filters input[type="number"], 
        .filters select {
            padding: 12px 14px;
            border-radius: 12px;
            border: 1px solid rgba(0,0,0,0.08);
            font-size: .9rem;
            outline: none;
            transition: .25s;
            background: white;
        }

        .filters input:focus, .filters select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 87, 255, 0.15);
        }

        .filter-btn {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            border: none;
            padding: 14px;
            border-radius: 14px;
            cursor: pointer;
            transition: .3s;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .filter-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 87, 255, 0.3);
        }

        .results-wrapper {
            flex: 1;
        }

        .results-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 28px;
        }

        .card {
            position: relative;
            background: var(--glass);
            border: 1px solid var(--border);
            border-radius: 24px;
            overflow: hidden;
            backdrop-filter: blur(14px);
            transition: all .4s cubic-bezier(.4, 0, .2, 1);
            box-shadow: var(--shadow-md);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
            border-color: rgba(0, 87, 255, 0.3);
        }

        .img-container {
            position: relative;
            overflow: hidden;
            height: 220px;
        }

        .card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: .6s ease;
        }

        .card:hover img {
            transform: scale(1.06);
        }

        .fav {
            position: absolute;
            top: 14px;
            right: 16px;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            border: none;
            background: var(--glass-strong);
            color: #ef4444;
            font-size: 18px;
            cursor: pointer;
            transition: .3s;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-sm);
            z-index: 2;
        }

        .fav:hover {
            background: #ef4444;
            color: white;
            transform: scale(1.1);
        }

        .card-content {
            padding: 24px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .tag {
            align-self: flex-start;
            background: var(--accent-soft);
            color: var(--primary-dark);
            padding: 6px 14px;
            border-radius: 100px;
            font-size: 0.75rem;
            font-weight: 700;
            margin-bottom: 14px;
            text-transform: uppercase;
        }

        .card h3 {
            margin: 0 0 10px;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-dark);
            line-height: 1.4;
        }

        .price-tag {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 15px;
        }

        .info-line {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 10px;
            font-size: .9rem;
            color: var(--text-light);
        }

        .info-line i {
            color: var(--primary);
            margin-top: 3px;
            width: 16px;
            text-align: center;
        }

        .contacto-inmueble {
            margin-top: auto;
            padding-top: 15px;
            border-top: 1px dashed rgba(0,0,0,0.08);
        }

        .see-images-btn {
            width: 100%;
            border: none;
            background: #f1f5f9;
            color: var(--text-dark);
            padding: 11px;
            border-radius: 12px;
            font-size: .88rem;
            font-weight: 600;
            margin: 5px 0 15px;
            transition: .25s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .see-images-btn:hover {
            background: var(--primary);
            color: white;
        }

        .no-results {
            background: white;
            border-left: 6px solid var(--warning);
            padding: 30px;
            border-radius: 18px;
            max-width: 600px;
            margin: 40px auto;
            color: #7a6c00;
            box-shadow: var(--shadow-md);
            text-align: center;
        }
        
        .no-results i {
            font-size: 2rem;
            color: var(--warning);
            margin-bottom: 10px;
        }

        .modal-backdrop-custom {
            position: fixed; 
            inset: 0; 
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(8px); 
            display: flex; 
            justify-content: center;
            align-items: center; 
            z-index: 9999;
        }

        .modal-custom {
            background: white; 
            padding: 24px; 
            border-radius: 24px;
            width: 90%; 
            max-width: 780px; 
            position: relative;
            box-shadow: var(--shadow-xl);
            animation: zoomIn .3s cubic-bezier(.34, 1.56, 0.64, 1);
        }

        @keyframes zoomIn {
            from { transform: scale(.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        @media (max-width: 992px) {
            .main-content {
                flex-direction: column;
            }
            .filters-wrapper {
                width: 100%;
                position: relative;
                top: 0;
            }
            .results-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 680px) {
            .results-grid {
                grid-template-columns: 1fr;
            }
            h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <a href="{{ url('/') }}" class="back"><i class="fa-solid fa-arrow-left"></i> Volver</a>

        <h1>Resultados encontrados</h1>
        <div class="subtitle">
            Aquí están los inmuebles que coinciden con tu búsqueda actual.
        </div>

        @if ($inmuebles->count() > 0)
        <div class="main-content">

            <div class="filters-wrapper">
                <form class="filters" method="GET" action="{{ route('buscador.inmuebles') }}">
                    
                    <h5><i class="fa-solid fa-sliders"></i> Filtrar Búsqueda</h5>

                    <input type="text" name="q" placeholder="Título, barrio o municipio..." value="{{ request('q') }}">

                    <select name="municipio_id" id="municipioSelect">
                        <option value="">Seleccionar municipio</option>
                        @foreach($municipios as $municipio)
                            <option value="{{ $municipio->id }}" {{ request('municipio_id') == $municipio->id ? 'selected' : '' }}>
                                {{ $municipio->nombre }}
                            </option>
                        @endforeach
                    </select>

                    <div class="d-flex gap-2">
                        <input type="number" name="precio_min" placeholder="Mínimo" min="0" value="{{ request('precio_min') }}" style="width:50%;">
                        <input type="number" name="precio_max" placeholder="Máximo" min="0" value="{{ request('precio_max') }}" style="width:50%;">
                    </div>

                    <div class="d-flex flex-column gap-2 mt-2">
                        <label><input type="checkbox" name="tipos[]" value="Casa" {{ in_array('Casa', request('tipos', [])) ? 'checked' : '' }}> Casa</label>
                        <label><input type="checkbox" name="tipos[]" value="Apartamento" {{ in_array('Apartamento', request('tipos', [])) ? 'checked' : '' }}> Apartamento</label>
                        <label><input type="checkbox" name="tipos[]" value="Lote" {{ in_array('Lote', request('tipos', [])) ? 'checked' : '' }}> Lote</label>
                        <label><input type="checkbox" name="tipos[]" value="Local comercial" {{ in_array('Local comercial', request('tipos', [])) ? 'checked' : '' }}> Local comercial</label>
                    </div>

                    <button type="submit" class="filter-btn">Aplicar filtros</button>

                    <a href="{{ route('buscador.inmuebles') }}" style="text-align:center; font-size:0.85rem; color:var(--primary); text-decoration:none; font-weight:600;">
                        Limpiar todos los filtros
                    </a>
                </form>
            </div>

            <div class="results-wrapper">
                <div class="results-grid">

                    @foreach ($inmuebles as $item)
                        @php
                            $raw = [];
                            $imagenesStr = $item->imagenes ?? '';
                            
                            if (is_string($imagenesStr)) {
                                if (str_starts_with($imagenesStr, '[')) {
                                    $raw = json_decode($imagenesStr, true) ?: [];
                                }
                                if (!str_starts_with($imagenesStr, '[') && str_contains($imagenesStr, ',')) {
                                    $raw = array_map('trim', explode(',', $imagenesStr));
                                }
                                if (!str_starts_with($imagenesStr, '[') && !str_contains($imagenesStr, ',') && strlen($imagenesStr) > 0) {
                                    $raw = [$imagenesStr];
                                }
                            }
                            
                            if (empty($raw) && method_exists($item, 'imagens') && $item->imagens) {
                                $raw = $item->imagens->pluck('ruta')->toArray() ?? [];
                            }

                            $images = [];
                            foreach ($raw as $p) {
                                if ($p) {
                                    if (str_starts_with($p, 'http://') || str_starts_with($p, 'https://')) {
                                        $images[] = $p;
                                    }
                                    if (!str_starts_with($p, 'http://') && !str_starts_with($p, 'https://')) {
                                        $images[] = asset('storage/' . ltrim($p, '/'));
                                    }
                                }
                            }
                        @endphp

                        <div class="card">
                            <button class="fav"><i class="fa-solid fa-heart"></i></button>

                            <div class="img-container">
                                <img src="{{ $images[0] ?? 'https://via.placeholder.com/400x250' }}" alt="Imagen inmueble">
                            </div>

                            <div class="card-content">
                                <span class="tag">{{ $item->tipo }}</span>
                                <h3>{{ $item->titulo }}</h3>
                                
                                <div class="price-tag">${{ number_format($item->precio) }}</div>

                                <button class="see-images-btn" type="button" data-images="{{ json_encode($images) }}" onclick="abrirModal(JSON.parse(this.getAttribute('data-images')), 0)">
                                    <i class="fa-solid fa-camera"></i> Ver galería ({{ count($images) }})
                                </button>

                                <div class="info-line">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>{{ $item->direccion }}</span>
                                </div>

                                <div class="info-line">
                                    <i class="fa-solid fa-map-location-dot"></i>
                                    <span>{{ $item->barrio->municipio->nombre ?? 'Sin municipio' }} - {{ $item->barrio->nombre ?? '' }}</span>
                                </div>

                                @if($item->usuario)
                                <div class="contacto-inmueble">
                                    @if(!empty($item->usuario->telefono))
                                        <div class="info-line" style="margin-bottom: 5px;">
                                            <i class="fa-solid fa-phone"></i>
                                            <strong>{{ $item->usuario->telefono }}</strong>
                                        </div>
                                    @endif

                                    @if(!empty($item->usuario->email))
                                        <div class="info-line" style="font-size: 0.85rem;">
                                            <i class="fa-solid fa-envelope"></i>
                                            <span>{{ $item->usuario->email }}</span>
                                        </div>
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

        @if ($inmuebles->count() == 0)
        <div class="no-results">
            <i class="fa-solid fa-house-crack"></i>
            <h4>No se encontraron inmuebles</h4>
            <p class="mb-3 text-muted">No hay propiedades disponibles que cumplan con los criterios seleccionados en este momento.</p>
            <a href="{{ route('buscador.inmuebles') }}" class="btn btn-sm btn-primary px-3 rounded-pill">Ver todos los inmuebles</a>
        </div>
        @endif

    </div>

    <div id="imgModal" style="display:none;">
        <div class="modal-backdrop-custom">
            <div class="modal-custom">

                <button id="closeModal" style="position:absolute; top:15px; right:20px; background:none; border:none; font-size:24px; cursor:pointer; color: var(--text-dark); z-index: 10;">✕</button>

                <div style="width:100%; height:400px; background: #f8fafc; border-radius:16px; overflow:hidden; display:flex; align-items:center; justify-content:center;">
                    <img id="imgModalSrc" src="" style="max-width:100%; max-height:100%; object-fit:contain;">
                </div>

                <div style="display:flex; justify-content:space-between; margin-top:20px; gap:10px;">
                    <button id="prevBtn" class="btn btn-outline-primary px-4 rounded-pill"><i class="fa-solid fa-chevron-left"></i> Anterior</button>
                    <button id="zoomBtn" class="btn btn-light px-4 rounded-pill"><i class="fa-solid fa-magnifying-glass-plus"></i> Ver completo</button>
                    <button id="nextBtn" class="btn btn-outline-primary px-4 rounded-pill">Siguiente <i class="fa-solid fa-chevron-right"></i></button>
                </div>

            </div>
        </div>
    </div>

    <script>
        let imagenesCarrusel = [];
        let indexActual = 0;

        function abrirModal(listaImagenes, indexInicial = 0) {
            if(!listaImagenes || listaImagenes.length === 0) {
                imagenesCarrusel = ['https://via.placeholder.com/400x250'];
            } else {
                imagenesCarrusel = listaImagenes;
            }
            
            indexActual = indexInicial;
            actualizarImagen();
            document.getElementById('imgModal').style.display = "block";
        }

        function actualizarImagen() {
            document.getElementById('imgModalSrc').src = imagenesCarrusel[indexActual];
        }

        document.getElementById("prevBtn").addEventListener("click", () => {
            indexActual = (indexActual === 0) ? imagenesCarrusel.length - 1 : indexActual - 1;
            actualizarImagen();
        });

        document.getElementById("nextBtn").addEventListener("click", () => {
            indexActual = (indexActual === imagenesCarrusel.length - 1) ? 0 : indexActual + 1;
            actualizarImagen();
        });

        document.getElementById("zoomBtn").addEventListener("click", () => {
            window.open(imagenesCarrusel[indexActual], "_blank");
        });

        document.getElementById("closeModal").addEventListener("click", () => {
            document.getElementById('imgModal').style.display = "none";
        });
        
        document.querySelector('.modal-backdrop-custom').addEventListener('click', (e) => {
            if(e.target === e.currentTarget) {
                document.getElementById('imgModal').style.display = "none";
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>