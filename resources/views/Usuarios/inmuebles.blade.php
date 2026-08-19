@extends('layout.app')

@section('titulo', 'Inmuebles del usuario')

@section('content')
<div class="container-fluid px-4 py-4 animate-fade">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">

        <!-- Card Header Principal -->
        <div class="card-header bg-gradient-dark text-white p-4 border-0">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="header-icon-box bg-primary text-white rounded-3 p-3 d-flex align-items-center justify-content-center">
                        <i class="fas fa-building fa-lg"></i>
                    </div>
                    <div>
                        <h4 class="mb-1 fw-bold text-white">Inmuebles de {{ $usuario->nombreEmpresa ?? $usuario->nombre }}</h4>
                        <p class="mb-0 text-white-50 fs-7">Catálogo de propiedades registradas por este usuario</p>
                    </div>
                </div>
                <a href="{{ route('usuario.index') }}" class="btn btn-outline-light rounded-pill px-4 py-2 fw-medium shadow-sm">
                    <i class="fas fa-arrow-left me-1"></i> Volver a Usuarios
                </a>
            </div>
        </div>

        <div class="card-body p-4">

            <!-- TARJETA PERFIL DE USUARIO (HERO BANNER) -->
            <div class="user-hero-card p-4 rounded-4 mb-5 border bg-light-subtle shadow-sm">
                <div class="row align-items-center g-4">
                    <div class="col-auto text-center">
                        <div class="position-relative d-inline-block">
                            @if($usuario->imagen)
                                <img src="{{ asset('storage/'.$usuario->imagen) }}"
                                     class="rounded-circle border border-3 border-white shadow-sm object-fit-cover"
                                     style="width: 110px; height: 110px;">
                            @else
                                <img src="{{ asset('img/user.png') }}"
                                     class="rounded-circle border border-3 border-white shadow-sm object-fit-cover"
                                     style="width: 110px; height: 110px;">
                            @endif
                        </div>
                    </div>

                    <div class="col">
                        <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                            <h3 class="fw-bold text-dark m-0">{{ $usuario->nombreEmpresa ?? $usuario->nombre }}</h3>
                            @if($usuario->tipoUsuario == 'inmobiliaria')
                                <span class="badge bg-emerald-soft text-emerald px-3 py-1 rounded-pill fw-bold fs-7">
                                    <i class="fas fa-building me-1"></i> Inmobiliaria
                                </span>
                            @else
                                <span class="badge bg-indigo-soft text-indigo px-3 py-1 rounded-pill fw-bold fs-7">
                                    <i class="fas fa-user me-1"></i> Persona
                                </span>
                            @endif
                        </div>

                        <div class="d-flex flex-wrap gap-3 text-secondary small mt-2">
                            <div><i class="far fa-envelope me-1 text-primary"></i> {{ $usuario->email }}</div>
                            <div><i class="fas fa-phone-alt me-1 text-success"></i> {{ $usuario->telefono ?? 'N/A' }}</div>
                            <div><i class="fas fa-location-dot me-1 text-danger"></i> {{ $usuario->direccion ?? 'N/A' }}</div>
                        </div>
                    </div>

                    <div class="col-md-auto text-md-end border-start-md ps-md-4">
                        <div class="p-3 bg-white rounded-3 border text-center">
                            <span class="d-block text-muted small fw-semibold">Total Inmuebles</span>
                            <span class="fs-3 fw-extrabold text-primary">{{ $usuario->inmuebles->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ENCABEZADO DE SECCIÓN -->
            <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
                <h5 class="fw-bold text-dark m-0">
                    <i class="fas fa-city text-primary me-2"></i>Propiedades Registradas
                </h5>
                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-semibold">
                    {{ $usuario->inmuebles->count() }} Inmueble(s) publicado(s)
                </span>
            </div>

            <!-- GRID DE INMUEBLES -->
            <div class="row g-4">
                @forelse($usuario->inmuebles as $inmueble)
                    <div class="col-xl-4 col-md-6">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden property-card">

                            <!-- Imagen y Badges en Overlay -->
                            <div class="position-relative overflow-hidden" style="height: 230px;">
                                @if($inmueble->imagens->isNotEmpty())
                                    <img src="{{ asset('storage/'.$inmueble->imagens->first()->ruta) }}"
                                         class="w-100 h-100 object-fit-cover property-img">
                                @else
                                    <img src="{{ asset('img/no-image.png') }}"
                                         class="w-100 h-100 object-fit-cover property-img">
                                @endif

                                <div class="property-overlay"></div>

                                <!-- Overlay Top Badges -->
                                <div class="position-absolute top-0 start-0 p-3 w-100 d-flex justify-content-between align-items-center z-2">
                                    @if(strtolower($inmueble->tipoOferta) === 'venta')
                                        <span class="badge bg-amber-soft text-amber px-3 py-2 rounded-pill fw-bold shadow-sm">
                                            <i class="fas fa-tag me-1"></i> {{ strtoupper($inmueble->tipoOferta) }}
                                        </span>
                                    @else
                                        <span class="badge bg-rose-soft text-rose px-3 py-2 rounded-pill fw-bold shadow-sm">
                                            <i class="fas fa-key me-1"></i> {{ strtoupper($inmueble->tipoOferta) }}
                                        </span>
                                    @endif

                                    <span class="badge bg-dark-soft text-white backdrop-blur px-3 py-2 rounded-pill fw-semibold shadow-sm border border-light-subtle">
                                        {{ ucfirst($inmueble->estadoPublicacion) }}
                                    </span>
                                </div>

                                <!-- Precio en la parte inferior de la imagen -->
                                <div class="position-absolute bottom-0 start-0 p-3 w-100 z-2">
                                    <h4 class="fw-extrabold text-white mb-0 drop-shadow">
                                        ${{ number_format($inmueble->precio, 0, ',', '.') }}
                                    </h4>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body p-4 d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="fw-bold text-dark mb-2 text-truncate" title="{{ $inmueble->titulo }}">
                                        {{ $inmueble->titulo }}
                                    </h5>

                                    <p class="text-muted small mb-3">
                                        <i class="fas fa-location-dot text-danger me-1"></i>
                                        {{ $inmueble->direccion }},
                                        {{ $inmueble->barrio->nombre ?? 'N/A' }},
                                        {{ optional($inmueble->barrio->municipio)->nombre ?? 'N/A' }}
                                    </p>
                                </div>

                                <!-- Especificaciones del Inmueble -->
                                <div class="spec-grid p-2 bg-light rounded-3 mt-3">
                                    <div class="row g-2 text-center">
                                        <div class="col-3 border-end">
                                            <div class="p-1">
                                                <i class="fas fa-bed text-primary d-block mb-1"></i>
                                                <span class="d-block fw-bold fs-7 text-dark">{{ $inmueble->nHabitaciones ?? 0 }}</span>
                                                <span class="text-muted fs-8">Hab.</span>
                                            </div>
                                        </div>

                                        <div class="col-3 border-end">
                                            <div class="p-1">
                                                <i class="fas fa-bath text-primary d-block mb-1"></i>
                                                <span class="d-block fw-bold fs-7 text-dark">{{ $inmueble->nBaños ?? 0 }}</span>
                                                <span class="text-muted fs-8">Baños</span>
                                            </div>
                                        </div>

                                        <div class="col-3 border-end">
                                            <div class="p-1">
                                                <i class="fas fa-car text-primary d-block mb-1"></i>
                                                <span class="d-block fw-bold fs-7 text-dark">{{ $inmueble->nParqueaderos ?? 0 }}</span>
                                                <span class="text-muted fs-8">Parq.</span>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="p-1">
                                                <i class="fas fa-ruler-combined text-primary d-block mb-1"></i>
                                                <span class="d-block fw-bold fs-7 text-dark">{{ $inmueble->area ?? 'N/A' }}</span>
                                                <span class="text-muted fs-8">m²</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5 p-4 rounded-4 bg-light border">
                            <div class="avatar-placeholder rounded-circle bg-white shadow-sm mx-auto mb-3 d-flex align-items-center justify-content-center text-muted" style="width: 70px; height: 70px;">
                                <i class="fas fa-folder-open fa-2x"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-1">Este usuario aún no tiene inmuebles registrados</h5>
                            <p class="text-muted mb-0">No se encontraron propiedades asociadas a esta cuenta en la base de datos.</p>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</div>

<!-- ESTILOS EXCLUSIVOS -->
<style>
    .bg-gradient-dark {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
    }

    .fs-7 { font-size: 0.8rem; }
    .fs-8 { font-size: 0.7rem; }
    .fw-extrabold { font-weight: 800; }

    .user-hero-card {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0 !important;
    }

    .property-card {
        border: 1px solid #e2e8f0 !important;
        transition: all 0.3s ease;
    }

    .property-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.08) !important;
    }

    .property-img {
        transition: transform 0.5s ease;
    }

    .property-card:hover .property-img {
        transform: scale(1.08);
    }

    .property-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0) 40%, rgba(0,0,0,0.85) 100%);
        z-index: 1;
    }

    .backdrop-blur {
        backdrop-filter: blur(8px);
    }

    .drop-shadow {
        text-shadow: 0 2px 8px rgba(0,0,0,0.7);
    }

    /* Soft Badges */
    .bg-amber-soft { background-color: #fef3c7; }
    .text-amber { color: #b45309; }
    .bg-rose-soft { background-color: #ffe4e6; }
    .text-rose { color: #be123c; }
    .bg-emerald-soft { background-color: #dcfce7; }
    .text-emerald { color: #15803d; }
    .bg-indigo-soft { background-color: #e0e7ff; }
    .text-indigo { color: #4338ca; }
    .bg-dark-soft { background-color: rgba(15, 23, 42, 0.65); }

    .animate-fade {
        animation: fadeIn 0.4s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(8px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (min-width: 768px) {
        .border-start-md {
            border-left: 1px solid #e2e8f0 !important;
        }
    }
</style>
@endsection