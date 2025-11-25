<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inmobiliarias</title>

    <!DOCTYPE html>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inmobiliarias</title>

```
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
        padding:14px 28px; background:var(--card); box-shadow:var(--shadow);
        position:sticky; top:0; z-index:120;
    }
    .nav a{
        text-decoration:none; margin-right:18px;
        color:var(--accent); font-weight:600; transition:.2s;
    }
    .nav a:hover{ color:var(--accent-hover); }

    .btn {
        padding:8px 12px;
        border-radius:10px;
        border:none;
        cursor:pointer;
        font-weight:600;
    }
    .btn-ghost {
        background:transparent;
        color:var(--accent);
        border:1px solid rgba(0,0,0,0.07);
    }
    .btn-ghost:hover { background:rgba(140,180,255,0.12); }

    .container{ max-width:1100px; margin:36px auto; padding:0 18px; }

    h1{ text-align:center; margin-bottom:32px; font-size:2rem; }

    /* BUSCADOR */
    .search-box{
        display:flex;
        gap:10px;
        margin-bottom:24px;
        width:100%;
    }
    .search-box input{
        flex:1;
        padding:10px 12px;
        border-radius:10px;
        border:1px solid rgba(0,0,0,0.12);
        background:var(--bg);
    }

    /* GRID */
    .list-grid{
        display:grid;
        gap:20px;
        grid-template-columns:repeat(auto-fill, minmax(280px, 1fr));
    }

    /* CARD */
    .card{
        background:var(--card);
        padding:18px;
        border-radius:14px;
        box-shadow:var(--shadow);
        border:1px solid rgba(0,0,0,0.05);
        transition:.25s;
    }
    .card:hover{
        transform:translateY(-4px);
    }
    .card h3{
        margin:0;
        color:var(--accent);
        font-size:1.2rem;
    }
    .card p{
        margin:6px 0;
        color:var(--muted);
    }

    .badge{
        display:inline-block;
        background:var(--accent);
        padding:6px 12px;
        color:white;
        border-radius:8px;
        font-size:.8rem;
        margin-top:12px;
    }

    .empty{
        text-align:center;
        font-size:1.1rem;
        margin-top:40px;
    }

    /* MODAL */
    .modal-backdrop{
        position:fixed;
        inset:0;
        background:rgba(0,0,0,0.45);
        backdrop-filter:blur(6px);
        display:flex; justify-content:center; align-items:center;
    }
    .modal{
        background:var(--card);
        border-radius:12px;
        padding:18px;
        width:90%;
        max-width:650px;
        max-height:90vh;
        overflow-y:auto;
        position:relative;
    }
    .modal-close{
        position:absolute;
        top:12px;
        right:12px;
        border:none;
        background:transparent;
        font-size:20px;
        cursor:pointer;
    }
</style>
```

</head>

<body data-theme="{{ request()->cookie('theme','light') }}">

```
<!-- NAV -->
<nav class="nav">
    <div>
        <a href="{{ url('/') }}">Inicio</a>
        <a href="{{ route('vista.arriendo') }}">Arriendo</a>
        <a href="{{ route('vista.venta') }}">Venta</a>
        <a href="{{ route('vista.inmobiliarias') }}">Inmobiliarias</a>
    </div>

    <button id="toggleTheme" class="btn btn-ghost">🌓</button>
</nav>


<!-- CONTENIDO -->
<div class="container fade-in">

    <h1>Inmobiliarias Registradas</h1>

    <!-- BUSCADOR -->
    <form method="GET" class="search-box" action="{{ route('vista.inmobiliarias') }}">
        <input 
            type="search"
            name="q"
            placeholder="Buscar por nombre, representante, email o teléfono"
            value="{{ request('q') }}"
        >
        <button class="btn btn-ghost">Buscar</button>
    </form>

    @if ($inmobiliarias->isEmpty())

        <p class="empty">No hay inmobiliarias registradas.</p>

    @else

        <div id="listing" class="list-grid">

            @foreach ($inmobiliarias as $inm)
                <div class="card">
                    <h3>{{ $inm->nombreEmpresa ?? 'Sin nombre comercial' }}</h3>

                    <p><strong>Representante:</strong> {{ $inm->nombre }}</p>
                    <p><strong>Email:</strong> {{ $inm->email }}</p>
                    <p><strong>Teléfono:</strong> {{ $inm->telefono }}</p>

                    <button class="btn btn-ghost"
                            onclick="mostrarDetalles('{{ $inm->id }}')">
                        Ver más
                    </button>

                    <span class="badge">Inmobiliaria</span>
                </div>
            @endforeach

        </div>

    @endif

</div>


<!-- MODAL ROOT -->
<div id="modalRoot" style="display:none;"></div>


<script>

    /* ====== TEMA ====== */
    const body = document.body;
    const themeBtn = document.getElementById('toggleTheme');

    (function(){
        const cookie = document.cookie.split('; ').find(r => r.startsWith('theme='));
        const theme = cookie ? cookie.split('=')[1] :
            (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        body.setAttribute('data-theme', theme);
    })();

    themeBtn.onclick = () => {
        const isDark = body.getAttribute('data-theme') === 'dark';
        const newTheme = isDark ? 'light' : 'dark';
        body.setAttribute('data-theme', newTheme);
        document.cookie = "theme="+newTheme+"; path=/; max-age=" + 60*60*24*365;
    };


    /* ====== MODAL GLOBAL ====== */
    const modalRoot = document.getElementById('modalRoot');

    document.addEventListener('click', e => {
        if(
            e.target.classList.contains('modal-backdrop') ||
            e.target.classList.contains('modal-close')
        ){
            modalRoot.innerHTML = "";
            modalRoot.style.display = "none";
        }
    });


    /* ====== MOSTRAR DETALLES ====== */
    async function mostrarDetalles(id){

        try{
            const res = await fetch(`/inmobiliaria/${id}/detalles`);
            const data = await res.json();

            const contenido = `
                <h2 style="margin-top:0;">${data.nombreEmpresa || 'Sin nombre'}</h2>
                <p><strong>Representante:</strong> ${data.nombre}</p>
                <p><strong>Email:</strong> ${data.email}</p>
                <p><strong>Teléfono:</strong> ${data.telefono}</p>
                ${data.direccion ? `<p><strong>Dirección:</strong> ${data.direccion}</p>` : ''}
            `;

            modalRoot.innerHTML = `
                <div class="modal-backdrop">
                    <div class="modal">
                        <button class="modal-close">✕</button>
                        ${contenido}
                    </div>
                </div>
            `;
            modalRoot.style.display = "block";

        }catch(e){
            console.error(e);
            alert("Error al cargar los detalles");
        }
    }

</script>
```

</body>
</html>
