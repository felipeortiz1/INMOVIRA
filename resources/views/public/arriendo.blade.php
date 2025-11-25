<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Inmuebles en Arriendo</title>

    <style>
        :root{
            --bg: #FAFCFF;
            --card: #ffffff;
            --muted: #7a7f8c;
            --accent: #8CB4FF;
            --accent-hover: #6EA1FF;
            --success: #7DD88C;
            --danger: #FF8A8A;
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
        .btn-primary { background:var(--accent); color:white; }
        .btn-primary:hover { background:var(--accent-hover); }

        .container{ max-width:1120px; margin:36px auto; padding:0 18px; }
        h1{ text-align:center; margin-bottom:20px; font-size:2rem; }

        /* FILTROS */
        .filters{
            display:flex; gap:12px; flex-wrap:wrap;
            background:var(--card);
            padding:16px;
            border-radius:14px;
            box-shadow:var(--shadow);
            border:1px solid rgba(0,0,0,0.04);
            margin-bottom:24px;
        }
        .filters input,
        .filters select{
            width:100%;
            padding:10px 12px;
            border-radius:10px;
            border:1px solid rgba(0,0,0,0.1);
            background:var(--bg);
            transition:0.2s;
        }
        .filters input:focus,
        .filters select:focus{
            border-color:var(--accent);
            box-shadow:0 0 0 2px rgba(140,180,255,0.3);
        }

        /* GRID */
        .list-grid{
            display: grid;
            grid-template-columns: repeat(auto-fill,minmax(260px,1fr));
            gap:18px;
        }
        .list-view{
            display:block;
        }

        /* CARD */
        .card{
            background:var(--card);
            border-radius:14px;
            box-shadow:var(--shadow);
            overflow:hidden;
            cursor:pointer;
            transition:.25s;
            display:flex; flex-direction:column;
        }
        .card:hover{ transform:translateY(-3px); }

        .card img{ width:100%; height:170px; object-fit:cover; }

        .card-body{
            padding:12px;
            display:flex; flex-direction:column; gap:4px;
        }

        .muted{ color:var(--muted); font-size:.9rem; }
        .price{ font-weight:700; font-size:1.1rem; }

        /* MODAL GENERAL */
        .modal-backdrop{
            position:fixed; inset:0;
            background:rgba(0,0,0,0.45);
            backdrop-filter:blur(6px);
            display:flex; justify-content:center; align-items:center;
            animation:fadeIn .25s;
        }

        .modal{
            background:var(--card);
            padding:14px;
            border-radius:14px;
            width:90%;
            max-width:700px;
            max-height:90vh;
            overflow-y:auto;
            position:relative;
        }

        .modal img{
            max-width:100%;
            height:auto;
            border-radius:10px;
            display:block;
        }

        /* BOTÓN LUPA */
        .zoom-btn{
            margin-top:10px;
            background:var(--accent);
            color:white;
            padding:8px 12px;
            border-radius:10px;
            border:none;
            cursor:pointer;
            font-size:.9rem;
            display:inline-flex;
            align-items:center;
            gap:6px;
        }
        .zoom-btn:hover{
            background:var(--accent-hover);
        }

        /* LIGHTBOX */
        .zoom-modal{
            position:relative;
            max-width:95vw;
            max-height:95vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }
        .zoom-full{
            max-width:95vw;
            max-height:95vh;
            object-fit:contain;
            border-radius:8px;
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
            <a href="{{ route('vista.arriendo') }}">Arriendo</a>
            <a href="{{ route('vista.venta') }}">Venta</a>
            <a href="{{ route('vista.inmobiliarias') }}">Inmobiliarias</a>
        </div>

        <div class="right">
            <button id="toggleTheme" class="btn btn-ghost">🌓</button>
            <a href="{{ route('login') }}" class="btn btn-ghost">Iniciar sesión</a>
        </div>
    </nav>

    <div class="container fade-in">
        <h1>Inmuebles en Arriendo</h1>

        {{-- FILTROS --}}
        <form id="filterForm" method="GET" class="filters" action="{{ route('vista.arriendo') }}">

            <div style="flex:1; min-width:220px;">
                <input type="search" name="q" placeholder="Buscar por título, dirección o barrio"
                    value="{{ request('q') }}">
            </div>

            <select name="tipo">
                <option value="">Tipo (todos)</option>
                <option value="Casa" {{ request('tipo')=='Casa'?'selected':'' }}>Casa</option>
                <option value="Apartamento" {{ request('tipo')=='Apartamento'?'selected':'' }}>Apartamento</option>
                <option value="Lote" {{ request('tipo')=='Lote'?'selected':'' }}>Lote</option>
                <option value="Local comercial" {{ request('tipo')=='Local comercial'?'selected':'' }}>Local comercial</option>
            </select>

            <select name="municipio" id="municipio">
                <option value="">Municipio</option>
                @foreach($municipios as $m)
                    <option value="{{ $m->id }}" {{ request('municipio')==$m->id?'selected':'' }}>
                        {{ $m->nombre }}
                    </option>
                @endforeach
            </select>

            <select name="barrio" id="barrio">
                <option value="">Barrio</option>
                @foreach($barrios as $b)
                    @if(request('municipio') == $b->idMunicipio)
                        <option value="{{ $b->id }}" {{ request('barrio')==$b->id?'selected':'' }}>
                            {{ $b->nombre }}
                        </option>
                    @endif
                @endforeach
            </select>

            <input type="number" name="min" placeholder="Precio min" value="{{ request('min') }}">
            <input type="number" name="max" placeholder="Precio max" value="{{ request('max') }}">

            <button class="btn btn-primary">Aplicar</button>
            <a href="{{ route('vista.arriendo') }}" class="btn btn-ghost">Limpiar</a>
        </form>

        {{-- CONTROLS --}}
        <div class="controls" style="margin-bottom:12px; display:flex; align-items:center;">
            <div class="view-toggle">
                <button id="gridBtn" class="btn btn-ghost">Grid</button>
                <button id="listBtn" class="btn btn-ghost">Lista</button>
            </div>
            <span class="muted" style="margin-left:12px;">Resultados:
                <strong>{{ $inmuebles->total() }}</strong></span>
        </div>

        {{-- LISTADO --}}
        @if($inmuebles->isEmpty())
            <div class="empty" style="text-align:center; margin-top:40px;">No hay inmuebles disponibles.</div>
        @else

            <div id="listing" class="list-grid {{ request('view')=='list'?'list-view':'' }}">
                @foreach($inmuebles as $item)
                    @php $img = optional($item->imagens->first())->ruta; @endphp

                    <article class="card">
                        <img src="{{ $img ? asset('storage/'.$img) : asset('img/no-image.jpg') }}"
                             alt="Imagen inmueble">

                        <div class="card-body">
                            <h3>{{ $item->titulo }}</h3>
                            <div class="muted">{{ $item->direccion }}</div>
                            <div class="muted" style="font-size:.9rem;">
                                {{ $item->barrio->nombre ?? 'Barrio N/A' }} •
                                {{ $item->barrio->municipio->nombre ?? 'Municipio N/A' }}
                            </div>

                            <div style="margin-top:auto; display:flex; justify-content:space-between; align-items:center;">
                                <div class="price">
                                    ${{ number_format($item->precio,0,',','.') }}
                                </div>
                                <a href="#" class="btn btn-ghost"
                                    onclick="event.preventDefault(); mostrarDetalles({{ $item->id }});">
                                    Ver
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="pagination">
                {{ $inmuebles->withQueryString()->links() }}
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


        /* MODAL DE DETALLES CON LUPA */
        function showModalWithContent(imgSrc, htmlContent){
            modalRoot.innerHTML = `
                <div class="modal-backdrop">
                    <div class="modal">
                        <button class="modal-close"
                            style="position:absolute;right:10px;top:10px;background:transparent;border:none;font-size:20px;cursor:pointer;">✕</button>

                        <img src="${imgSrc}" class="modal-img">

                        <button class="zoom-btn" onclick="zoomImage('${imgSrc}')">
                            🔍 Ver imagen completa
                        </button>

                        <div style="padding:10px;">${htmlContent}</div>
                    </div>
                </div>
            `;
            modalRoot.style.display = "block";
        }


        /* LIGHTBOX (SOLO LA IMAGEN) */
        function zoomImage(src){
            modalRoot.innerHTML = `
                <div class="modal-backdrop">
                    <div class="zoom-modal">
                        <button class="modal-close"
                            style="position:absolute;right:20px;top:20px;background:transparent;border:none;font-size:24px;">✕</button>
                        <img src="${src}" class="zoom-full">
                    </div>
                </div>
            `;
            modalRoot.style.display = "block";
        }


        /* SELECT DEPENDIENTE */
        document.getElementById('municipio')?.addEventListener('change',function(){
            const mid = this.value;
            const barrio = document.getElementById('barrio');
            barrio.innerHTML = '<option value="">Barrio</option>';

            const data = @json($barrios);

            data.forEach(b=>{
                if(String(b.idMunicipio)===String(mid)){
                    barrio.innerHTML += `<option value="${b.id}">${b.nombre}</option>`;
                }
            });
        });


        /* MOSTRAR DETALLES */
        async function mostrarDetalles(id){
            try{
                const res = await fetch(`/inmueble/${id}/detalles`);
                const data = await res.json();

                const info = `
                    <h3>${data.titulo}</h3>
                    <p class="muted">${data?.barrio?.nombre || ''} • ${data?.barrio?.municipio?.nombre || ''}</p>
                    <p><b>Dirección:</b> ${data.direccion}</p>
                    <p><b>Usuario:</b> ${data.usuario?.nombre || ''}</p>
                    <p><b>Precio:</b> $${Number(data.precio||0).toLocaleString()}</p>
                `;

                const src = data.imagenes?.length
                    ? (data.imagenes[0].url_imagen || '/storage/'+data.imagenes[0].ruta)
                    : '{{ asset("img/no-image.jpg") }}';

                showModalWithContent(src, info);

            }catch(e){
                console.error(e);
            }
        }
    </script>

</body>
</html>
