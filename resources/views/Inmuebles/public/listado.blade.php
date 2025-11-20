@extends('layout.app')

@section('title', 'Inmuebles Publicados')

@section('content')
<div class="container py-4">

    <h2 class="mb-4 fw-bold text-center">
        {{ request()->is('arriendo') ? 'Inmuebles en Arriendo' : 'Inmuebles en Venta' }}
    </h2>

    <div class="row g-4">

        @forelse($inmuebles as $item)
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                @if($item->imagens && $item->imagens->count() > 0)
                    <img src="/storage/{{ $item->imagens->first()->ruta }}" class="card-img-top"
                        style="height:230px; object-fit:cover;">
                @else
                    <img src="{{ asset('img/noimage.jpg') }}" class="card-img-top"
                        style="height:230px; object-fit:cover;">
                @endif

                <div class="card-body">
                    <h5 class="card-title fw-bold">{{ $item->titulo }}</h5>
                    <p class="text-muted">{{ $item->direccion }}</p>
                    <p class="fw-bold text-primary fs-5">$ {{ number_format($item->precio) }}</p>
                </div>
            </div>
        </div>
        @empty

        <p class="text-center text-muted fs-5">No hay inmuebles publicados aún.</p>

        @endforelse

    </div>

</div>
@endsection
