@extends('layout.app')

@section('titulo', 'Dashboard')

@section('content')
@php
    use App\Models\Usuario;
    use App\Models\Inmueble;
    use App\Models\Municipio;
    use App\Models\Barrio;
    use Illuminate\Support\Facades\Auth;

    $totalUsuarios = Usuario::count();
    $totalInmuebles = Inmueble::count();
    $inmueblesVenta = Inmueble::where('tipoOferta', 'venta')->count();
    $inmueblesArriendo = Inmueble::where('tipoOferta', 'arriendo')->count();
    $totalMunicipios = Municipio::count();
    $totalBarrios = Barrio::count();
    $ultimosInmuebles = Inmueble::orderBy('fechaPublicacion', 'desc')->take(5)->get();
    $adminName = Auth::user()->nombre ?? 'Administrador';
@endphp

<div class="dashboard-wrapper container-fluid py-4">

    <!-- Header / Hero Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="hero-card p-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <span class="badge bg-white-soft text-white px-3 py-2 rounded-pill mb-2 fw-semibold">
                        <i class="fas fa-chart-line me-1"></i> Panel de Control
                    </span>
                    <h1 class="text-white fw-bold m-0 display-6">¡Hola de nuevo, {{ $adminName }}! 👋</h1>
                    <p class="text-white-50 m-0 mt-1">Aquí tienes un resumen del estado actual de la plataforma inmobiliaria.</p>
                </div>
                <div>
                    <span class="badge bg-white text-dark px-3 py-2 rounded-3 shadow-sm fw-bold">
                        <i class="far fa-calendar-alt text-primary me-2"></i>{{ now()->locale('es')->isoFormat('D [de] MMMM, YYYY') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- KPI Metric Cards principales -->
    <div class="row g-4 mb-4">
        <!-- Usuarios -->
        <div class="col-xl-3 col-md-6">
            <a href="{{ route('usuario.index') }}" class="text-decoration-none">
                <div class="metric-card metric-indigo">
                    <div class="metric-card-body">
                        <div class="metric-icon-box">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="metric-data">
                            <span class="metric-title">Usuarios Registrados</span>
                            <h2 class="metric-value">{{ number_format($totalUsuarios) }}</h2>
                        </div>
                    </div>
                    <div class="metric-footer">
                        <span>Gestionar usuarios</span>
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Inmuebles -->
        <div class="col-xl-3 col-md-6">
            <a href="{{ route('inmuebles.index') }}" class="text-decoration-none">
                <div class="metric-card metric-emerald">
                    <div class="metric-card-body">
                        <div class="metric-icon-box">
                            <i class="fas fa-city"></i>
                        </div>
                        <div class="metric-data">
                            <span class="metric-title">Total Inmuebles</span>
                            <h2 class="metric-value">{{ number_format($totalInmuebles) }}</h2>
                        </div>
                    </div>
                    <div class="metric-footer">
                        <span>Ver catálogo completo</span>
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </a>
        </div>

        <!-- Inmuebles en Venta -->
        <div class="col-xl-3 col-md-6">
            <a href="{{ route('inmuebles.index') }}" class="text-decoration-none">
                <div class="metric-card metric-amber">
                    <div class="metric-card-body">
                        <div class="metric-icon-box">
                            <i class="fas fa-tag"></i>
                        </div>
                        <div class="metric-data">
                            <span class="metric-title">Inmuebles en Venta</span>
                            <h2 class="metric-value">{{ number_format($inmueblesVenta) }}</h2>
                        </div>
                    </div>
                    <div class="metric-footer">
                        <span>Ver en venta</span>
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </a>
        </div>

        <!-- Inmuebles en Arriendo -->
        <div class="col-xl-3 col-md-6">
            <a href="{{ route('inmuebles.index') }}" class="text-decoration-none">
                <div class="metric-card metric-rose">
                    <div class="metric-card-body">
                        <div class="metric-icon-box">
                            <i class="fas fa-key"></i>
                        </div>
                        <div class="metric-data">
                            <span class="metric-title">Inmuebles en Arriendo</span>
                            <h2 class="metric-value">{{ number_format($inmueblesArriendo) }}</h2>
                        </div>
                    </div>
                    <div class="metric-footer">
                        <span>Ver en arriendo</span>
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Cobertura Territorial (Municipios / Barrios) -->
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <a href="{{ route('municipios.index') }}" class="text-decoration-none">
                <div class="territory-card">
                    <div class="territory-icon bg-soft-primary text-primary">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <div class="flex-grow-1">
                        <span class="territory-label">Municipios Registrados</span>
                        <h3 class="territory-value">{{ number_format($totalMunicipios) }}</h3>
                    </div>
                    <div class="territory-action">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6">
            <a href="{{ route('barrios.index') }}" class="text-decoration-none">
                <div class="territory-card">
                    <div class="territory-icon bg-soft-info text-info">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="flex-grow-1">
                        <span class="territory-label">Barrios Registrados</span>
                        <h3 class="territory-value">{{ number_format($totalBarrios) }}</h3>
                    </div>
                    <div class="territory-action">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Tabla de Últimos Inmuebles -->
    <div class="row">
        <div class="col-12">
            <div class="card premium-card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <div class="header-icon-box">
                            <i class="fas fa-history text-primary"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0 text-dark">Últimos inmuebles publicados</h5>
                            <small class="text-muted">Mostrando las publicaciones más recientes</small>
                        </div>
                    </div>
                    <a href="{{ route('inmuebles.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold">
                        Ver todos
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle custom-table mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">Título</th>
                                    <th>Tipo de oferta</th>
                                    <th>Precio</th>
                                    <th class="pe-4 text-end">Fecha de publicación</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($ultimosInmuebles as $inmueble)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="property-avatar">
                                                    <i class="fas fa-home text-muted"></i>
                                                </div>
                                                <span class="fw-bold text-dark">{{ $inmueble->titulo }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            @if(strtolower($inmueble->tipoOferta) === 'venta')
                                                <span class="status-badge status-venta">
                                                    <i class="fas fa-tag me-1"></i> {{ ucfirst($inmueble->tipoOferta) }}
                                                </span>
                                            @else
                                                <span class="status-badge status-arriendo">
                                                    <i class="fas fa-key me-1"></i> {{ ucfirst($inmueble->tipoOferta) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="fw-bold text-dark">
                                            ${{ number_format($inmueble->precio, 0, ',', '.') }}
                                        </td>
                                        <td class="pe-4 text-end text-muted">
                                            <i class="far fa-clock me-1"></i> {{ $inmueble->fechaPublicacion }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted">
                                            <div class="empty-state">
                                                <i class="fas fa-folder-open display-4 text-light-gray mb-3"></i>
                                                <p class="mb-0 fw-medium">No hay inmuebles publicados aún.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    /* Estilos Premium del Dashboard */
    :root {
        --dash-bg: #f4f6f9;
        --card-radius: 16px;
    }

    body {
        background-color: var(--dash-bg) !important;
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
    }

    /* Hero Card Header */
    .hero-card {
        background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        border-radius: var(--card-radius);
        box-shadow: 0 10px 30px rgba(30, 41, 59, 0.15);
    }

    .bg-white-soft {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(5px);
    }

    /* Metric Cards (KPIs) */
    .metric-card {
        border-radius: var(--card-radius);
        padding: 1.5rem;
        color: #fff;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 8px 20px rgba(0,0,0,0.06);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 160px;
    }

    .metric-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 28px rgba(0,0,0,0.12);
    }

    .metric-indigo { background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%); }
    .metric-emerald { background: linear-gradient(135deg, #10b981 0%, #047857 100%); }
    .metric-amber { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); }
    .metric-rose { background: linear-gradient(135deg, #f43f5e 0%, #be123c 100%); }

    .metric-card-body {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
    }

    .metric-icon-box {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        backdrop-filter: blur(4px);
    }

    .metric-data {
        text-align: right;
    }

    .metric-title {
        font-size: 0.875rem;
        font-weight: 500;
        opacity: 0.9;
        display: block;
    }

    .metric-value {
        font-size: 2rem;
        font-weight: 800;
        margin: 0;
        line-height: 1.2;
    }

    .metric-footer {
        border-top: 1px solid rgba(255, 255, 255, 0.15);
        padding-top: 0.75rem;
        margin-top: 1rem;
        font-size: 0.8rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: space-between;
        opacity: 0.9;
    }

    /* Territory Cards */
    .territory-card {
        background: #ffffff;
        border-radius: var(--card-radius);
        padding: 1.25rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.25rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        border: 1px solid rgba(226, 232, 240, 0.8);
        transition: transform 0.25s ease, border-color 0.25s ease;
    }

    .territory-card:hover {
        transform: translateY(-3px);
        border-color: #cbd5e1;
        box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    }

    .territory-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .bg-soft-primary { background-color: #eff6ff; }
    .bg-soft-info { background-color: #f0fdf4; }

    .territory-label {
        font-size: 0.875rem;
        color: #64748b;
        font-weight: 600;
    }

    .territory-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }

    .territory-action {
        color: #94a3b8;
        font-size: 1rem;
    }

    /* Table Section */
    .premium-card {
        border-radius: var(--card-radius) !important;
        overflow: hidden;
        border: 1px solid rgba(226, 232, 240, 0.8) !important;
    }

    .header-icon-box {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: #eff6ff;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .custom-table thead th {
        background-color: #f8fafc;
        color: #475569;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 700;
        padding-top: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .custom-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .custom-table tbody tr:hover {
        background-color: #f8fafc;
    }

    .custom-table td {
        padding: 1rem 0.75rem;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.9rem;
    }

    .property-avatar {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Status Badges */
    .status-badge {
        padding: 0.35em 0.8em;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
    }

    .status-venta {
        background-color: #fef3c7;
        color: #92400e;
    }

    .status-arriendo {
        background-color: #ffe4e6;
        color: #9f1239;
    }

    .text-light-gray { color: #cbd5e1; }
</style>
@endsection