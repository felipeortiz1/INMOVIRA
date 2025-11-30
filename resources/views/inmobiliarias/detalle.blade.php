<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>{{ $inmobiliaria->nombreEmpresa }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
:root{
    --bg:#f5f7fb;
    --card:#ffffff;
    --accent:#1f3b8b;
    --accent2:#3b82f6;
    --muted:#6b7280;
    --radius:18px;
    --shadow:0 12px 30px rgba(0,0,0,.08);
}

body{
    margin:0;
    font-family:Inter, system-ui;
    background:var(--bg);
}

/* NAV VERTICAL */
.nav{
    position:fixed;
    top:0;
    left:0;
    width:230px;
    height:100vh;
    background:var(--card);
    box-shadow:0 0 20px rgba(0,0,0,0.04);
    padding:30px 20px;
    display:flex;
    flex-direction:column;
    gap:20px;
}

.nav h2{
    margin:0 0 15px 0;
    color:var(--accent);
}

.nav a{
    text-decoration:none;
    color:#111827;
    padding:10px 14px;
    border-radius:14px;
    font-weight:600;
    display:flex;
    align-items:center;
    gap:8px;
    transition:.25s;
}

.nav a:hover{
    background:var(--accent2);
    color:white;
}

/* CONTENIDO */
.main{
    margin-left:250px;
    padding:40px;
    animation:fade .6s ease;
}

/* CARD GRANDE */
.detalle-card{
    background:var(--card);
    border-radius:var(--radius);
    box-shadow:var(--shadow);
    overflow:hidden;
    display:grid;
    grid-template-columns: 400px 1fr;
    transition:.3s;
}

.detalle-img{
    background:#e5e7eb;
    position:relative;
}

.detalle-img img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.detalle-content{
    padding:36px;
}

.detalle-content h1{
    margin-top:0;
    color:var(--accent);
    font-size:2rem;
}

.detalle-content p{
    margin:8px 0;
    color:#111827;
}

.detalle-content .muted{
    color:var(--muted);
}

.badge{
    display:inline-block;
    background:var(--accent);
    color:white;
    padding:6px 14px;
    border-radius:999px;
    font-size:13px;
    margin-bottom:10px;
}

/* BOTONES */
.actions{
    margin-top:25px;
    display:flex;
    gap:12px;
    flex-wrap:wrap;
}

.btn{
    padding:12px 18px;
    border-radius:14px;
    text-decoration:none;
    font-weight:600;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    transition:.25s;
    border:none;
    cursor:pointer;
}

.btn-primary{
    background:var(--accent);
    color:white;
}

.btn-primary:hover{
    background:#162f6e;
}

.btn-outline{
    border:2px solid var(--accent);
    color:var(--accent);
    background:transparent;
}

.btn-outline:hover{
    background:var(--accent);
    color:white;
}

/* RESPONSIVE */
@media(max-width:900px){
    .nav{
        position:relative;
        width:100%;
        height:auto;
        flex-direction:row;
        justify-content:space-around;
    }

    .main{
        margin-left:0;
    }

    .detalle-card{
        grid-template-columns:1fr;
    }

    .detalle-img{
        height:260px;
    }
}

@keyframes fade{
    from{opacity:0; transform: translateY(20px)}
    to{opacity:1; transform: translateY(0)}
}
</style>
</head>

<body>

<!-- NAV VERTICAL -->
<div class="nav">
    <h2>Inmuebles</h2>
    <a href="{{ route('pagina.principal') }}">🏠 Inicio</a>
    <a href="{{ route('vista.arriendo') }}">📌 Arriendo</a>
    <a href="{{ route('vista.venta') }}">💰 Venta</a>
    <a href="{{ route('vista.inmobiliarias') }}">🏢 Inmobiliarias</a>
</div>

<!-- CONTENIDO PRINCIPAL -->
<div class="main">

    <div class="detalle-card">

        <div class="detalle-img">
            <img 
                src="{{ $inmobiliaria->imagen 
                    ? asset('storage/' . $inmobiliaria->imagen) 
                    : asset('img/default.png') }}" 
                alt="Imagen inmobiliaria">
        </div>

        <div class="detalle-content">

            <span class="badge">Inmobiliaria</span>

            <h1>{{ $inmobiliaria->nombreEmpresa }}</h1>

            <p class="muted"><strong>Representante:</strong> {{ $inmobiliaria->nombre }}</p>
            <p><strong>Correo:</strong> {{ $inmobiliaria->email }}</p>
            <p><strong>Teléfono:</strong> {{ $inmobiliaria->telefono }}</p>
            <p><strong>Dirección:</strong> {{ $inmobiliaria->direccion ?? 'No registrada' }}</p>
            <p><strong>Descripción:</strong> {{ $inmobiliaria->descripcion ?? 'Sin descripción' }}</p>

            <div class="actions">
                <a href="https://wa.me/57{{ $inmobiliaria->telefono }}" target="_blank" class="btn btn-primary">
                    💬 Contactar por WhatsApp
                </a>

                <a href="{{ route('vista.inmobiliarias') }}" class="btn btn-outline">
                    ← Volver
                </a>
            </div>

        </div>

    </div>

</div>

</body>
</html>
