<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inmobiliarias</title>

<style>
/* ------------------------------------------
   VARIABLES
------------------------------------------ */
:root{
    --bg: #F4F7FF;
    --card: #ffffff;
    --muted: #7a7f8c;
    --accent: #7FA7FF;
    --accent-hover: #5C8CFF;
    --shadow: 0 4px 14px rgba(0,0,0,0.08);
    --glow: 0 0 20px rgba(127,167,255,0.55);
}

[data-theme="dark"]{
    --bg: #131722;
    --card: #1f2432;
    --muted: #AAB3CC;
    --accent: #9CBAFF;
    --accent-hover: #82A6FF;
    --shadow: 0 6px 22px rgba(0,0,0,0.6);
    --glow: 0 0 26px rgba(156,186,255,0.8);
    color:#DDE5F7;
}

html,body{
    height:100%;
    margin:0;
    font-family:Inter, Poppins, system-ui;
    background:var(--bg);
}

/* ------------------------------------------
   NAV
------------------------------------------ */
.nav{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:15px 28px;
    background:var(--card);
    box-shadow:var(--shadow);
    position:sticky;
    top:0;
    z-index:100;
    animation: fadeDown .6s ease-out;
}

.nav a{
    text-decoration:none;
    margin-right:18px;
    color:var(--accent);
    font-weight:600;
    transition:.25s;
}
.nav a:hover{
    color:var(--accent-hover);
    text-shadow:var(--glow);
}

.btn{
    padding:9px 13px;
    border-radius:10px;
    cursor:pointer;
}
.btn-ghost{
    background:transparent;
    color:var(--accent);
    border:1px solid rgba(0,0,0,0.1);
}
.btn-ghost:hover{
    background:rgba(140,180,255,0.12);
}

/* ------------------------------------------
   CONTENEDOR
------------------------------------------ */
.container{
    max-width:1100px;
    margin:36px auto;
    padding:0 18px;
}

h1{
    text-align:center;
    font-size:2rem;
    color:var(--accent);
    margin-bottom:28px;
    animation: fadeUp .7s ease-out;
}

/* ------------------------------------------
   BUSCADOR
------------------------------------------ */
.search-box{
    display:flex;
    gap:10px;
    margin-bottom:24px;
    animation: fadeUp .7s ease-out;
}
.search-box input{
    flex:1;
    padding:12px 16px;
    border-radius:12px;
    border:1px solid rgba(0,0,0,0.15);
    font-size:1rem;
}

/* ------------------------------------------
   LISTA HORIZONTAL CON EFECTOS
------------------------------------------ */
.list-horizontal{
    display:flex;
    flex-direction:column;
    gap:18px;
}

/* Tarjeta fila */
.inmo-row{
    background:var(--card);
    padding:20px;
    border-radius:16px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    border:1px solid rgba(0,0,0,0.05);
    box-shadow:var(--shadow);
    transition:.25s ease;
    position:relative;
    opacity:0;
    transform:translateY(14px) scale(.98);
    animation: fadeInRow .6s forwards ease;
}
.inmo-row:hover{
    transform:translateY(-4px) scale(1);
    box-shadow:0 12px 28px rgba(0,0,0,0.18);
}

/* LUZ SEGÚN MOUSE (PARALLAX LIGHT) */
.inmo-row::before{
    content:"";
    position:absolute;
    top:var(--y);
    left:var(--x);
    width:0;
    height:0;
    opacity:0;
    box-shadow:0 0 55px 25px rgba(127,167,255,0.4);
    border-radius:50%;
    transition:opacity .25s;
}
.inmo-row:hover::before{
    opacity:.6;
}

/* ------------------------------------------
   ICONO
------------------------------------------ */
.inmo-info{
    display:flex;
    align-items:center;
    gap:18px;
}
.inmo-icon{
    width:54px;
    height:54px;
    background:var(--accent);
    color:white;
    border-radius:14px;
    font-size:22px;
    display:flex;
    align-items:center;
    justify-content:center;
    box-shadow:var(--glow);
    animation: floatIcon 3s infinite ease-in-out;
}
@keyframes floatIcon{
    0%{ transform: translateY(0); }
    50%{ transform: translateY(-6px); }
    100%{ transform: translateY(0); }
}

/* ------------------------------------------
   TEXTO
------------------------------------------ */
.inmo-text h3{
    margin:0;
    font-size:1.05rem;
    color:var(--accent);
}
.inmo-text p{
    margin:2px 0;
    color:var(--muted);
    font-size:.85rem;
}

/* ------------------------------------------
   ACCIONES
------------------------------------------ */
.inmo-actions{
    display:flex;
    flex-direction:column;
    gap:10px;
    align-items:flex-end;
}

.badge{
    background:var(--accent);
    color:white;
    padding:5px 10px;
    border-radius:8px;
    font-size:.75rem;
}

.btn-view{
    padding:8px 12px;
    border-radius:12px;
    border:1px solid var(--accent);
    color:var(--accent);
    background:transparent;
    cursor:pointer;
    font-size:.9rem;
    position:relative;
    overflow:hidden;
    transition:.25s;
}

.btn-view:hover{
    background:var(--accent);
    color:white;
    box-shadow:var(--glow);
}

/* Ripple */
.btn-view::after{
    content:"";
    position:absolute;
    width:0;
    height:0;
    background:rgba(255,255,255,0.6);
    border-radius:50%;
    transform:translate(-50%,-50%);
    left:var(--rX);
    top:var(--rY);
    transition:width .35s ease, height .35s ease;
}
.btn-view:active::after{
    width:140px;
    height:140px;
}

/* ------------------------------------------
   MODAL ÉPICO
------------------------------------------ */
.modal-backdrop{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,0.62);
    backdrop-filter:blur(6px);
    display:flex;
    justify-content:center;
    align-items:center;
    z-index:200;
    animation: fadeIn .4s ease-out;
}

.modal{
    background:var(--card);
    padding:28px;
    border-radius:18px;
    width:90%;
    max-width:650px;
    max-height:90vh;
    overflow-y:auto;
    position:relative;
    animation: epicModal .55s cubic-bezier(.19,1.35,.4,1);
    box-shadow:var(--glow);
}

.modal-close{
    position:absolute;
    top:12px;
    right:12px;
    cursor:pointer;
    font-size:22px;
    color:var(--muted);
}

/* ------------------------------------------
   ANIMACIONES VARIAS
------------------------------------------ */
@keyframes fadeUp{ from{opacity:0; transform:translateY(18px);} to{opacity:1; transform:translateY(0);} }
@keyframes fadeDown{ from{opacity:0; transform:translateY(-18px);} to{opacity:1; transform:translateY(0);} }
@keyframes fadeIn{ from{opacity:0;} to{opacity:1;} }
@keyframes fadeInRow{ to{ opacity:1; transform:translateY(0) scale(1); } }
@keyframes epicModal{
    0%{ transform:scale(.5) translateY(30px) rotate(-4deg); opacity:0; filter:blur(4px); }
    60%{ transform:scale(1.05) translateY(-6px); }
    100%{ transform:scale(1) translateY(0) rotate(0); opacity:1; filter:blur(0); }
}

</style>
</head>


<body data-theme="{{ request()->cookie('theme','light') }}">

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
<div class="container">

<h1>Inmobiliarias Registradas</h1>

<!-- BUSCADOR -->
<form method="GET" class="search-box" action="{{ route('vista.inmobiliarias') }}">
    <input type="search" name="q" placeholder="Buscar..." value="{{ request('q') }}">
    <button class="btn-ghost">Buscar</button>
</form>

@if ($inmobiliarias->isEmpty())

<p style="text-align:center; opacity:.6;">No hay inmobiliarias registradas.</p>

@else

<div class="list-horizontal">

@foreach ($inmobiliarias as $i => $inm)

<div class="inmo-row" style="animation-delay: {{ $i * 0.1 }}s">

    <div class="inmo-info">
        <div class="inmo-icon">
            {{ strtoupper(substr($inm->nombreEmpresa ?? 'I', 0, 1)) }}
        </div>

        <div class="inmo-text">
            <h3>{{ $inm->nombreEmpresa }}</h3>
            <p><strong>Rep:</strong> {{ $inm->nombre }}</p>
            <p><strong>Email:</strong> {{ $inm->email }}</p>
            <p><strong>Tel:</strong> {{ $inm->telefono }}</p>
        </div>
    </div>

    <div class="inmo-actions">
        <button class="btn-view" onclick="mostrarDetalles('{{ $inm->id }}', event)">Ver más</button>
        <span class="badge">Inmobiliaria</span>
    </div>

</div>

@endforeach
</div>

@endif

</div>

<!-- MODAL ROOT -->
<div id="modalRoot" style="display:none;"></div>


<script>
/* -------------------------
   TEMA
------------------------- */
const body = document.body;
const themeBtn = document.getElementById("toggleTheme");

themeBtn.onclick = () => {
    const isDark = body.dataset.theme === "dark";
    const newTheme = isDark ? "light" : "dark";
    body.dataset.theme = newTheme;
    document.cookie = "theme="+newTheme+"; path=/; max-age="+60*60*24*365;
};

/* -------------------------
   PARALLAX LUZ
------------------------- */
document.addEventListener("mousemove", e => {
    document.querySelectorAll(".inmo-row").forEach(row => {
        const rect = row.getBoundingClientRect();
        row.style.setProperty("--x", (e.clientX - rect.left)+"px");
        row.style.setProperty("--y", (e.clientY - rect.top)+"px");
    });
});

/* -------------------------
   RIPPLE
------------------------- */
document.addEventListener("mousedown", e => {
    if(e.target.classList.contains("btn-view")){
        const r = e.target.getBoundingClientRect();
        e.target.style.setProperty("--rX", e.clientX - r.left + "px");
        e.target.style.setProperty("--rY", e.clientY - r.top + "px");
    }
});

/* -------------------------
   MODAL
------------------------- */
const modalRoot = document.getElementById("modalRoot");

document.addEventListener("click", e => {
    if(e.target.classList.contains("modal-backdrop") ||
       e.target.classList.contains("modal-close")){
        modalRoot.innerHTML = "";
        modalRoot.style.display = "none";
    }
});

/* -------------------------
   MOSTRAR DETALLES
------------------------- */
async function mostrarDetalles(id){
    try{
        const res = await fetch(`/inmobiliaria/${id}/detalles`);
        const d = await res.json();

        modalRoot.innerHTML = `
            <div class="modal-backdrop">
                <div class="modal">
                    <button class="modal-close">✕</button>

                    <h2 style="margin-top:0; color:var(--accent); font-size:1.35rem;">
                        ${d.nombreEmpresa}
                    </h2>

                    <p><strong>Representante:</strong> ${d.nombre}</p>
                    <p><strong>Email:</strong> ${d.email}</p>
                    <p><strong>Teléfono:</strong> ${d.telefono}</p>
                    ${d.direccion ? `<p><strong>Dirección:</strong> ${d.direccion}</p>` : ""}
                </div>
            </div>
        `;
        modalRoot.style.display = "block";

    }catch(err){
        console.log(err);
        alert("Error al cargar los detalles");
    }
}
</script>

</body>
</html>
