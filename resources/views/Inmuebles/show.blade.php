<div>
    <h4 class="fw-bold">{{ $inmueble->titulo }}</h4>
    <p><strong>Dirección:</strong> {{ $inmueble->direccion }}</p>
    <p><strong>Usuario:</strong> {{ $inmueble->usuario->nombre ?? 'N/A' }}</p>
    <p><strong>Tipo:</strong> {{ $inmueble->tipoInmueble->nombre ?? 'N/A' }}</p>
    <p><strong>Barrio:</strong> {{ $inmueble->barrio->nombre ?? 'N/A' }}</p>
    <p><strong>Precio:</strong> ${{ number_format($inmueble->precio ?? 0, 0, ',', '.') }}</p>
    <p><strong>Área:</strong> {{ $inmueble->area }} m²</p>
    <p><strong>Descripción:</strong></p>
    <div class="bg-light p-2 rounded mb-2">{{ $inmueble->descripcion }}</div>

    @if($inmueble->imagenes->isNotEmpty())
    <div id="carouselExampleIndicators{{ $inmueble->id_inmueble }}" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($inmueble->imagenes as $k => $img)
            <div class="carousel-item {{ $k == 0 ? 'active' : '' }}">
                <img src="{{ asset('storage/' . $img->url_imagen) }}" class="d-block w-100" style="height:420px; object-fit:cover;">
            </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators{{ $inmueble->id_inmueble }}" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators{{ $inmueble->id_inmueble }}" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>
    @else
    <div class="text-muted">No hay imágenes.</div>
    @endif
</div>