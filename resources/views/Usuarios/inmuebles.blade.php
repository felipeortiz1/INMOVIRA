@extends('layout.app')

@section('titulo', 'Inmuebles del usuario')

@section('content')

<style>

/* ===========================
   FONDO GENERAL
============================ */
body{
    background: radial-gradient(circle at top, #dbe7ff, #f8faff);
}

/* ===========================
   CARD PRINCIPAL
============================ */
.container-fluid .card {
    border-radius: 28px;
    border: none;
    background: rgba(255,255,255,0.92);
    backdrop-filter: blur(10px);
    box-shadow: 0 25px 80px rgba(0,0,0,0.12);
}

/* ===========================
   HEADER
============================ */
.card-header{
    border-radius: 28px 28px 0 0 !important;
    background: linear-gradient(135deg, #1e40af, #0f3aa2);
    padding: 26px 32px;
}

/* ===========================
   USUARIO
============================ */
.user-card{
    background: linear-gradient(145deg, #eef3ff, #ffffff);
    border-radius: 24px;
    padding: 35px;
    box-shadow: inset 0 0 18px rgba(0,0,0,0.05);
}

.user-img{
    border: 6px solid #fff;
    box-shadow: 0 12px 45px rgba(0,0,0,0.35);
    transition: .6s ease;
}

.user-img:hover{
    transform: scale(1.15) rotate(4deg);
}

/* ===========================
   TARJETA INMUEBLE
============================ */
.inmueble-card{
    border-radius: 28px;
    border:none;
    overflow:hidden;
    background: #fff;
    box-shadow: 0 18px 55px rgba(0,0,0,0.15);
    transition: .65s cubic-bezier(.23,1,.32,1);
    display:flex;
    flex-direction:column;
    min-height: 590px;
}

.inmueble-card:hover{
    transform: translateY(-16px) scale(1.025);
    box-shadow: 0 35px 90px rgba(0,0,0,0.25);
}

/* ===========================
   ZONA IMAGEN (80%)
============================ */
.inmueble-img-zone{
    position: relative;
    height: 80%;
    min-height: 390px;
    overflow: hidden;
}

.inmueble-img{
    width:100%;
    height:100%;
    object-fit:cover;
    transition: transform .9s ease, filter .6s ease;
}

.inmueble-card:hover .inmueble-img{
    transform: scale(1.2);
    filter: brightness(1.2) contrast(1.05);
}

/* Overlay cinematográfico */
.img-overlay{
    position:absolute;
    inset:0;
    background: linear-gradient(0deg, rgba(0,0,0,0.85), rgba(0,0,0,0.15), transparent);
}

/* Titulo sobre imagen */
.img-title{
    position:absolute;
    bottom:25px;
    left:25px;
    right:25px;
    color:white;
    z-index:5;
    font-size:23px;
    font-weight:800;
    text-shadow:0 8px 25px rgba(0,0,0,.75);
}

/* ===========================
   CUERPO (20%)
============================ */
.inmueble-body{
    height:20%;
    padding:22px;
    background:linear-gradient(145deg,#ffffff,#f0f5ff);
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    gap:10px;
}

/* Precio gigante */
.precio{
    font-size:28px;
    font-weight:900;
    background: linear-gradient(90deg,#1d4ed8,#22c55e);
    -webkit-background-clip:text;
    -webkit-text-fill-color: transparent;
}

/* Badges */
.badge-tipo{
    background:linear-gradient(135deg,#22c55e,#15803d);
    padding:7px 16px;
    border-radius:999px;
    font-size:11px;
    letter-spacing:1px;
}

.badge-estado{
    background:linear-gradient(135deg,#3b82f6,#1d4ed8);
    padding:7px 16px;
    border-radius:999px;
    font-size:11px;
}

/* Grid datos */
.data-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:12px;
}

.data-box{
    background:#ffffff;
    border-radius:16px;
    padding:8px 6px;
    text-align:center;
    font-size:13px;
    box-shadow:inset 0 0 8px rgba(0,0,0,0.05);
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    gap:3px;
}

.data-box i{
    font-size:18px;
    color:#1d4ed8;
}

.data-label{
    font-size:11px;
    color:#444;
    font-weight:600;
}

/* Separador elegante */
.line{
    height:3px;
    background:linear-gradient(90deg,#2563eb,#22c55e);
    border-radius:100px;
}

/* ===========================
   ALERTA
============================ */
.alert{
    border-radius:22px;
    background:linear-gradient(135deg,#fff7ed,#ffedd5);
}

</style>

<div class="container-fluid">

    <div class="card">

        <div class="card-header text-white d-flex justify-content-between align-items-center">

            <h4 class="mb-0">
                <i class="bi bi-buildings"></i>
                Inmuebles de {{ $usuario->nombreEmpresa ?? $usuario->nombre }}
            </h4>

            <a href="{{ route('usuario.index') }}" class="btn btn-light shadow rounded-pill px-4">
                <i class="bi bi-arrow-left-circle"></i> Volver
            </a>

        </div>

        <div class="card-body">

            <!-- DATOS DE USUARIO -->
            <div class="row user-card mb-5 align-items-center">
                <div class="col-md-3 text-center">
                    @if($usuario->imagen)
                        <img src="{{ asset('storage/'.$usuario->imagen) }}" 
                             class="img-fluid rounded-circle user-img"
                             style="width:140px;height:140px;">
                    @else
                        <img src="{{ asset('img/user.png') }}"
                             class="img-fluid rounded-circle user-img"
                             style="width:140px;height:140px;">
                    @endif
                </div>

                <div class="col-md-9">
                    <h3 class="fw-bold mb-3">{{ $usuario->nombreEmpresa ?? $usuario->nombre }}</h3>
                    <p><i class="bi bi-envelope-fill text-primary"></i> {{ $usuario->email }}</p>
                    <p><i class="bi bi-telephone-fill text-success"></i> {{ $usuario->telefono ?? 'N/A' }}</p>
                    <p><i class="bi bi-geo-alt-fill text-danger"></i> {{ $usuario->direccion ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="line mb-5"></div>

            <div class="row">

                @forelse($usuario->inmuebles as $inmueble)

                <div class="col-xl-4 col-md-6 mb-5">
                    <div class="inmueble-card">

                        <!-- IMAGEN -->
                        <div class="inmueble-img-zone">

                            @if($inmueble->imagens->isNotEmpty())
                                <img src="{{ asset('storage/'.$inmueble->imagens->first()->ruta) }}"
                                    class="inmueble-img">
                            @else
                                <img src="{{ asset('img/no-image.png') }}"
                                    class="inmueble-img">
                            @endif

                            <div class="img-overlay"></div>

                            <div class="img-title">
                                {{ $inmueble->titulo }}
                            </div>

                        </div>

                        <!-- INFO -->
                        <div class="inmueble-body">

                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge text-white badge-tipo">
                                    {{ strtoupper($inmueble->tipoOferta) }}
                                </span>

                                <span class="badge text-white badge-estado">
                                    {{ ucfirst($inmueble->estadoPublicacion) }}
                                </span>
                            </div>

                            <p class="small text-muted">
                                {{ $inmueble->direccion }},
                                {{ $inmueble->barrio->nombre ?? 'N/A' }},
                                {{ optional($inmueble->barrio->municipio)->nombre ?? 'N/A' }}
                            </p>

                            <div class="precio">
                                ${{ number_format($inmueble->precio, 0, ',', '.') }}
                            </div>

                            <div class="data-grid mt-2">

                                <div class="data-box">
                                    <i class="bi bi-door-open-fill"></i>
                                    <span class="data-label">Habitaciones</span>
                                    <strong>{{ $inmueble->nHabitaciones ?? 0 }}</strong>
                                </div>

                                <div class="data-box">
                                    <i class="bi bi-droplet-fill"></i>
                                    <span class="data-label">Baños</span>
                                    <strong>{{ $inmueble->nBaños ?? 0 }}</strong>
                                </div>

                                <div class="data-box">
                                    <i class="bi bi-car-front-fill"></i>
                                    <span class="data-label">Parqueaderos</span>
                                    <strong>{{ $inmueble->nParqueaderos ?? 0 }}</strong>
                                </div>

                                <div class="data-box">
                                    <i class="bi bi-rulers"></i>
                                    <span class="data-label">Área</span>
                                    <strong>{{ $inmueble->area ?? 'N/A' }} m²</strong>
                                </div>

                            </div>

                            </div>

                    </div>
                </div>

                @empty

                <div class="col-12">
                    <div class="alert text-center shadow p-5">
                        <i class="bi bi-info-circle fs-1"></i>
                        <br><br>
                        Este usuario aún no tiene inmuebles registrados.
                    </div>
                </div>

                @endforelse

            </div>

        </div>
    </div>

</div>

@endsection
