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

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Hola de nuevo, es un gusto tenerte aqui</h1>
            </div>
        </div>
    </div>
</section>

<section class="content">
<div class="container-fluid">

    <!-- Estadísticas principales -->
    <div class="row">
        <!-- Usuarios -->
        <div class="col-lg-3 col-6">
            <a href="{{ route('usuario.index') }}" class="text-decoration-none">
                <div class="small-box bg-info hoverable-card">
                    <div class="inner text-white">
                        <h3>{{ $totalUsuarios }}</h3>
                        <p>Usuarios registrados</p>
                    </div>
                    <div class="icon"><i class="fas fa-users"></i></div>
                </div>
            </a>
        </div>

        <!-- Inmuebles -->
        <div class="col-lg-3 col-6">
            <a href="{{ route('inmuebles.index') }}" class="text-decoration-none">
                <div class="small-box bg-success hoverable-card">
                    <div class="inner text-white">
                        <h3>{{ $totalInmuebles }}</h3>
                        <p>Total inmuebles</p>
                    </div>
                    <div class="icon"><i class="fas fa-building"></i></div>
                </div>
            </a>
        </div>

        <!-- Inmuebles en venta -->
        <div class="col-lg-3 col-6">
            <a href="{{ route('inmuebles.index') }}" class="text-decoration-none">
                <div class="small-box bg-warning hoverable-card">
                    <div class="inner text-dark">
                        <h3>{{ $inmueblesVenta }}</h3>
                        <p>Inmuebles en venta</p>
                    </div>
                    <div class="icon"><i class="fas fa-dollar-sign"></i></div>
                </div>
            </a>
        </div>

        <!-- Inmuebles en arriendo -->
        <div class="col-lg-3 col-6">
            <a href="{{ route('inmuebles.index') }}" class="text-decoration-none">
                <div class="small-box bg-danger hoverable-card">
                    <div class="inner text-white">
                        <h3>{{ $inmueblesArriendo }}</h3>
                        <p>Inmuebles en arriendo</p>
                    </div>
                    <div class="icon"><i class="fas fa-key"></i></div>
                </div>
            </a>
        </div>
    </div>

    <!-- Municipios y Barrios -->
    <div class="row mt-4">
        <!-- Municipios -->
        <div class="col-lg-6 col-12">
            <a href="{{ route('municipios.index') }}" class="text-decoration-none">
                <div class="info-box shadow-sm hoverable-card" style="border-radius: 10px;">
                    <span class="info-box-icon bg-primary"><i class="fas fa-map-marked-alt"></i></span>
                    <div class="info-box-content text-dark">
                        <span class="info-box-text">Municipios registrados</span>
                        <span class="info-box-number h4">{{ $totalMunicipios }}</span>
                    </div>
                </div>
            </a>
        </div>

        <!-- Barrios -->
        <div class="col-lg-6 col-12">
            <a href="{{ route('barrios.index') }}" class="text-decoration-none">
                <div class="info-box shadow-sm hoverable-card" style="border-radius: 10px;">
                    <span class="info-box-icon bg-info"><i class="fas fa-city"></i></span>
                    <div class="info-box-content text-dark">
                        <span class="info-box-text">Barrios registrados</span>
                        <span class="info-box-number h4">{{ $totalBarrios }}</span>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Últimos inmuebles -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-clock"></i> Últimos inmuebles publicados</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Tipo oferta</th>
                                <th>Precio</th>
                                <th>Fecha publicación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ultimosInmuebles as $inmueble)
                                <tr>
                                    <td>{{ $inmueble->titulo }}</td>
                                    <td>{{ ucfirst($inmueble->tipoOferta) }}</td>
                                    <td>${{ number_format($inmueble->precio, 0, ',', '.') }}</td>
                                    <td>{{ $inmueble->fechaPublicacion }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No hay inmuebles publicados aún.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
</section>

<style>
    body {
        background: linear-gradient(180deg, #f8f9fa 0%, #e9ecef 100%);
    }

    h1 {
        font-weight: 700;
        color: #343a40;
        letter-spacing: 0.5px;
    }

    /* === Cards Principales === */
    .small-box {
        border-radius: 15px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .small-box .inner h3 {
        font-size: 2.2rem;
        font-weight: 700;
    }

    .small-box .inner p {
        font-size: 1rem;
        font-weight: 500;
        opacity: 0.9;
    }

    .small-box .icon {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 3.5rem;
        opacity: 0.15;
        transition: opacity 0.3s ease;
    }

    .small-box:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .small-box:hover .icon {
        opacity: 0.3;
    }

    /* === Info Boxes === */
    .info-box {
        display: flex;
        align-items: center;
        border-radius: 12px;
        padding: 10px;
        background: white;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .info-box:hover {
        transform: translateY(-4px);
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.15);
    }

    .info-box-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        border-radius: 12px;
        width: 70px;
        height: 70px;
        color: white;
    }

    .info-box-content {
        margin-left: 15px;
    }

    .info-box-text {
        font-weight: 600;
        font-size: 1rem;
        color: #495057;
    }

    .info-box-number {
        font-size: 1.6rem;
        font-weight: 700;
        color: #212529;
    }

    /* === Tabla === */
    .card {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
    }

    .card-header {
        border-bottom: none;
        font-weight: 600;
        font-size: 1.1rem;
        letter-spacing: 0.3px;
    }

    .table thead th {
        background-color: #f8f9fa;
        color: #495057;
        border-bottom: 2px solid #dee2e6;
    }

    .table tbody tr:hover {
        background-color: #f1f3f5;
        transition: background 0.2s ease;
    }

    .table td {
        vertical-align: middle;
    }

    /* === Efectos globales === */
    a.text-decoration-none {
        text-decoration: none !important;
    }

    .hoverable-card {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        cursor: pointer;
    }

    .hoverable-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.2);
    }
</style>


@endsection
