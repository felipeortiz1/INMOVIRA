@extends('adminlte::page')

@section('title', $title ?? 'Dashboard')

@section('content_header')
    <h1>@yield('page-title', 'Panel de Administrador')</h1>
@stop

@section('content')
    <div class="container-fluid mt-2">
        @yield('content')
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin-custom.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> 
    @stack('styles')

    {{-- Corrección de altura para la barra lateral con Bootstrap 5 --}}
    <style>
        html, body, .wrapper {
            min-height: 100vh !important;
            height: auto !important;
        }
        .main-sidebar {
            min-height: 100% !important;
        }
        .content-wrapper {
            min-height: 100vh !important;
        }
    </style>
@stop

@section('js')
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $(function() {
                $(document).Toasts('create', {
                    class: 'bg-danger',
                    title: 'Error',
                    body: "{{ session('error') }}",
                    autohide: true,
                    delay: 5000
                }).show();
            });
        });
    </script>
    @endif
@stop