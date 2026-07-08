<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Inmuebles en Arriendo | Premium</title>

    <style>
        /* ==========================================================================
           VARIABLES GLOBALES Y TEMAS
           ========================================================================== */
        :root {
            /* Paleta Light */
            --bg-main: #F4F7FE;
            --bg-card: #ffffff;
            --bg-nav: #98FB98; /* ✅ VERDE CLARO SOLICITADO */
            --text-main: #1E293B;
            --text-muted: #64748B;
            --accent: #10B981;
            --accent-hover: #059669;
            --btn-login: #0F172A; /* ✅ AZUL OSCURO/NEGRO SOLICITADO */
            --btn-login-hover: #020617;
            --border-color: rgba(226, 232, 240, 0.8);
            
            /* UI Elements */
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-card: 0 14px 28px rgba(0,0,0,0.02), 0 10px 10px rgba(0,0,0,0.01);
            --shadow-card-hover: 0 20px 40px rgba(0,0,0,0.08), 0 15px 15px rgba(0,0,0,0.05);
            --glass-bg: rgba(255, 255, 255, 0.7);
            --glass-border: rgba(255, 255, 255, 0.5);
            
            /* Status */
            --success: #10B981;
            --danger: #EF4444;
            --warning: #F59E0B;
            
            /* Extras */
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 20px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        [data-theme="dark"] {
            /* Paleta Dark */
            --bg-main: #0B1120;
            --bg-card: #1E293B;
            --bg-nav: #064E3B; /* Verde adaptado a dark mode para no encandilar */
            --text-main: #F8FAFC;
            --text-muted: #94A3B8;
            --accent: #34D399;
            --accent-hover: #10B981;
            --btn-login: #38BDF8; /* Azul más vibrante en dark mode */
            --btn-login-hover: #0EA5E9;
            --border-color: rgba(51, 65, 85, 0.8);
            
            /* UI Elements Dark */
            --shadow-card: 0 14px 28px rgba(0,0,0,0.4), 0 10px 10px rgba(0,0,0,0.2);
            --shadow-card-hover: 0 20px 40px rgba(0,0,0,0.6), 0 15px 15px rgba(0,0,0,0.4);
            --glass-bg: rgba(30, 41, 59, 0.7);
            --glass-border: rgba(255, 255, 255, 0.05);
        }

        /* ==========================================================================
           RESET Y BASE
           ========================================================================== */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--bg-main);
            color: var(--text-main);
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            line-height: 1.6;
            transition: background-color 0.4s ease, color 0.4s ease;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* Scrollbar Premium */
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: var(--bg-main); }
        ::-webkit-scrollbar-thumb { background: var(--text-muted); border-radius: 10px; border: 2px solid var(--bg-main); }
        ::-webkit-scrollbar-thumb:hover { background: var(--accent); }

        /* ==========================================================================
           NAVBAR (HEADER)
           ========================================================================== */
        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 40px;
            background: var(--bg-nav);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: var(--shadow-md);
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: var(--transition);
        }

        .nav .left {
            display: flex;
            align-items: center;
            gap: 32px;
        }

        .nav .left a {
            color: #064E3B; /* Verde muy oscuro para contraste sobre el verde claro */
            font-family: 'Nunito', sans-serif;
            font-weight: 800;
            font-size: 1.1rem;
            text-decoration: none;
            position: relative;
            padding: 8px 4px;
            transition: var(--transition);
        }

        [data-theme="dark"] .nav .left a {
            color: #ECFDF5;
        }

        .nav .left a::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0%;
            height: 3px;
            background: currentColor;
            border-radius: 4px;
            transition: var(--transition);
            transform: translateX(-50%);
        }

        .nav .left a:hover::after, .nav .left a.active::after {
            width: 100%;
        }

        .nav .left a:hover {
            transform: translateY(-2px);
            opacity: 0.8;
        }

        .nav .right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        /* ==========================================================================
           BOTONES GLOBALES
           ========================================================================== */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: var(--radius-md);
            border: none;
            cursor: pointer;
            font-weight: 700;
            font-family: inherit;
            font-size: 0.95rem;
            transition: var(--transition);
            text-decoration: none;
        }

        .btn:active { transform: scale(0.97); }

        .btn-ghost {
            background: transparent;
            color: var(--text-main);
            border: 1px solid var(--border-color);
        }

        .btn-ghost:hover {
            background: var(--bg-card);
            border-color: var(--accent);
            color: var(--accent);
        }

        .btn-primary {
            background: var(--accent);
            color: #fff;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-primary:hover {
            background: var(--accent-hover);
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
            transform: translateY(-2px);
        }

        .btn-login {
            background: var(--btn-login);
            color: white;
            padding: 10px 24px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .btn-login:hover {
            background: var(--btn-login-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.25);
            color: white;
        }

        #toggleTheme {
            width: 42px;
            height: 42px;
            padding: 0;
            border-radius: 50%;
            font-size: 1.2rem;
        }

        /* ==========================================================================
           LAYOUT Y HERO
           ========================================================================== */
        .container {
            max-width: 1440px;
            margin: 0 auto;
            padding: 40px 24px;
        }

        .page-header {
            margin-bottom: 40px;
            position: relative;
            padding-bottom: 20px;
        }

        h1 {
            font-family: 'Nunito', sans-serif;
            font-size: 3rem;
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: -0.5px;
            animation: slideDown 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        h1 span {
            color: var(--accent);
            position: relative;
            display: inline-block;
        }

        h1 span::after {
            content: '';
            position: absolute;
            bottom: 4px;
            left: 0;
            width: 100%;
            height: 8px;
            background: var(--accent);
            opacity: 0.2;
            border-radius: 4px;
        }

        /* ==========================================================================
           ZONA PRINCIPAL (FILTROS + GRID)
           ========================================================================== */
        .main-content {
            display: flex;
            gap: 32px;
            align-items: flex-start;
        }

        /* Sidebar Filtros */
        .filters-wrapper {
            width: 300px;
            flex-shrink: 0;
            position: sticky;
            top: 100px; /* Offset for navbar */
        }

        .filters {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 24px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-card);
            border: 1px solid var(--glass-border);
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .filter-group label {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            pointer-events: none;
        }

        .filters input, .filters select {
            width: 100%;
            padding: 12px 14px 12px 40px;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
            background: var(--bg-card);
            color: var(--text-main);
            font-family: inherit;
            font-size: 0.95rem;
            transition: var(--transition);
            appearance: none; /* Removes native select styling partially */
        }

        .filters select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-size: 16px;
            padding-right: 40px;
        }

        [data-theme="dark"] .filters select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        }

        .price-range {
            display: flex;
            gap: 12px;
        }

        .price-range .input-wrapper { flex: 1; }
        .price-range input { padding-left: 28px; }
        .price-range i { left: 10px; font-size: 0.85rem; }

        .filters input:focus, .filters select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
            background: var(--bg-card);
        }

        .filter-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 10px;
        }

        #toggleFilters {
            display: none; /* Solo visible en móvil */
            margin-bottom: 20px;
            width: 100%;
        }

        /* ==========================================================================
           GRID Y TARJETAS (CARDS)
           ========================================================================== */
        .list-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 32px;
            flex: 1;
        }

        .card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-card);
            border: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            position: relative;
            transition: var(--transition);
            animation: fadeIn 0.8s ease backwards;
        }

        /* Stagger animation based on child index */
        .card:nth-child(1) { animation-delay: 0.1s; }
        .card:nth-child(2) { animation-delay: 0.2s; }
        .card:nth-child(3) { animation-delay: 0.3s; }
        .card:nth-child(4) { animation-delay: 0.4s; }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-card-hover);
            border-color: var(--accent);
        }

        .card-img-wrapper {
            position: relative;
            width: 100%;
            height: 240px;
            overflow: hidden;
        }

        .card-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .card:hover .card-img-wrapper img {
            transform: scale(1.08);
        }

        /* Overlay Gradiente */
        .card-img-wrapper::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.5) 100%);
            pointer-events: none;
        }

        /* Botones Flotantes en Imagen */
        .action-btns {
            position: absolute;
            top: 16px;
            left: 16px;
            right: 16px;
            display: flex;
            justify-content: space-between;
            z-index: 2;
        }

        .icon-btn {
            background: rgba(255, 255, 255, 0.9);
            color: var(--text-main);
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            transition: var(--transition);
            font-size: 1.1rem;
        }

        [data-theme="dark"] .icon-btn {
            background: rgba(15, 23, 42, 0.8);
            color: white;
        }

        .icon-btn:hover {
            transform: scale(1.15) rotate(5deg);
        }

        .fav:hover { color: var(--danger); }
        .open-modal:hover { color: var(--accent); }

        .badge-type {
            position: absolute;
            bottom: 16px;
            left: 16px;
            background: var(--accent);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            z-index: 2;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        .card-body {
            padding: 24px;
            display: flex;
            flex-direction: column;
            flex: 1;
            gap: 12px;
        }

        .card h3 {
            margin: 0;
            color: var(--text-main);
            font-size: 1.35rem;
            font-family: 'Nunito', sans-serif;
            font-weight: 800;
            line-height: 1.3;
        }

        .card-location {
            color: var(--text-muted);
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .card-location i { color: var(--accent); }

        .card-footer {
            margin-top: auto;
            padding-top: 16px;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .price {
            font-weight: 800;
            color: var(--accent);
            font-size: 1.4rem;
            font-family: 'Nunito', sans-serif;
            display: flex;
            flex-direction: column;
            line-height: 1;
        }

        .price span {
            font-size: 0.75rem;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            margin-top: 4px;
        }

        /* ==========================================================================
           ESTADOS VACÍOS Y PAGINACIÓN
           ========================================================================== */
        .empty {
            text-align: center;
            padding: 80px 20px;
            background: var(--glass-bg);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-card);
            border: 1px dashed var(--border-color);
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
            font-size: 1.2rem;
            color: var(--text-muted);
        }

        .empty i {
            font-size: 4rem;
            color: var(--border-color);
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 40px;
            width: 100%;
        }

        .pagination nav > div > span, .pagination nav > div > a {
            padding: 10px 16px;
            background: var(--bg-card);
            border-radius: var(--radius-sm);
            border: 1px solid var(--border-color);
            text-decoration: none;
            font-size: 0.95rem;
            color: var(--text-main);
            transition: var(--transition);
            font-weight: 600;
            margin: 0 4px;
        }

        .pagination nav > div > a:hover {
            background: var(--accent);
            color: white;
            border-color: var(--accent);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2);
        }

        .pagination nav .bg-indigo-500 {
            background: var(--accent) !important;
            color: white !important;
            border-color: var(--accent) !important;
        }

        .pagination nav div:first-child, .pagination nav div:last-child { display: none !important; }

        /* ==========================================================================
           MODAL ULTRA PREMIUM
           ========================================================================== */
        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            padding: 20px;
            animation: fadeIn 0.3s ease;
        }

        .modal {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            width: 100%;
            max-width: 900px;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            border: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            animation: slideUp 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @media(min-width: 768px) {
            .modal { flex-direction: row; } /* Split view in desktop */
        }

        .modal-close {
            position: absolute;
            right: 16px;
            top: 16px;
            background: rgba(0,0,0,0.5);
            color: white;
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            font-size: 16px;
            cursor: pointer;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .modal-close:hover {
            background: var(--danger);
            transform: rotate(90deg);
        }

        .modal-img-container {
            position: relative;
            flex: 1;
            min-height: 300px;
            background: #000;
        }

        .modal-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .modal-info-container {
            padding: 32px;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .modal-info-container h3 {
            font-size: 1.8rem;
            font-family: 'Nunito', sans-serif;
            color: var(--text-main);
            line-height: 1.2;
            margin-bottom: 8px;
        }

        .modal-detail-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
        }
        
        .modal-detail-item:last-child { border: none; }

        .modal-detail-item i {
            color: var(--accent);
            font-size: 1.2rem;
            margin-top: 2px;
        }

        .modal-detail-text strong {
            display: block;
            color: var(--text-main);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .modal-detail-text span {
            color: var(--text-muted);
            font-size: 1.05rem;
        }

        .zoom-btn {
            position: absolute;
            bottom: 16px;
            left: 16px;
            background: rgba(255,255,255,0.9);
            color: #000;
            padding: 8px 16px;
            border-radius: 20px;
            border: none;
            cursor: pointer;
            font-weight: 700;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .zoom-btn:hover {
            background: var(--accent);
            color: white;
        }

        .zoom-modal {
            position: relative;
            max-width: 95vw;
            max-height: 95vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .zoom-full {
            max-width: 95vw;
            max-height: 95vh;
            object-fit: contain;
            border-radius: var(--radius-sm);
            box-shadow: 0 0 40px rgba(0,0,0,0.5);
            animation: zoomIn 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        /* ==========================================================================
           ANIMACIONES
           ========================================================================== */
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slideDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes zoomIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }

        /* ==========================================================================
           RESPONSIVE DESIGN
           ========================================================================== */
        @media(max-width: 1024px) {
            .main-content { flex-direction: column; }
            .filters-wrapper { width: 100%; position: static; }
            .filters { flex-direction: row; flex-wrap: wrap; align-items: flex-end;}
            .filter-group { flex: 1; min-width: 200px; }
            .filter-actions { flex-direction: row; width: 100%; justify-content: flex-end; }
        }

        @media(max-width: 768px) {
            .nav { padding: 12px 20px; flex-direction: column; gap: 16px; }
            .nav .left { flex-wrap: wrap; justify-content: center; gap: 16px; }
            
            #toggleFilters { display: flex; justify-content: center; }
            .filters-wrapper { display: none; } /* Oculto por defecto en móvil */
            .filters { flex-direction: column; }
            .filter-group { width: 100%; }
            
            h1 { font-size: 2.2rem; text-align: center; margin-bottom: 20px; }
            
            .list-grid { grid-template-columns: 1fr; }
            .modal { flex-direction: column; }
            .modal-img-container { min-height: 250px; }
        }
    </style>
</head>
<body data-theme="{{ request()->cookie('theme','light') }}">

<nav class="nav">
    <div class="left">
        <a href="{{ url('/') }}"><i class="fa-solid fa-house"></i> Inicio</a>
        <a href="{{ route('vista.arriendo') }}" class="active"><i class="fa-solid fa-key"></i> Arriendo</a>
        <a href="{{ route('vista.venta') }}"><i class="fa-solid fa-tag"></i> Venta</a>
        <a href="{{ route('vista.inmobiliarias') }}"><i class="fa-solid fa-building-user"></i> Inmobiliarias</a>
    </div>
    <div class="right">
        <button id="toggleTheme" class="btn btn-ghost" title="Cambiar tema">
            <i class="fa-solid fa-circle-half-stroke"></i>
        </button>
        <a href="{{ route('login') }}" class="btn btn-login"><i class="fa-solid fa-user-lock"></i> Iniciar sesión</a>
    </div>
</nav>

<div class="container">
    <div class="page-header">
        <h1>Explora Inmuebles en <span>Arriendo</span></h1>
        <p style="color: var(--text-muted); font-size: 1.1rem; margin-top: 8px;">Encuentra el lugar perfecto para tu próximo capítulo.</p>
    </div>

    <button id="toggleFilters" class="btn btn-ghost"><i class="fa-solid fa-sliders"></i> Mostrar / Ocultar Filtros</button>

    <div class="main-content">
        <aside class="filters-wrapper">
            <form id="filterForm" method="GET" class="filters" action="{{ route('vista.arriendo') }}">
                
                <div class="filter-group">
                    <label>Búsqueda libre</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="search" name="q" placeholder="Ej. Casa con piscina..." value="{{ request('q') }}">
                    </div>
                </div>

                <div class="filter-group">
                    <label>Tipo de Inmueble</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-building"></i>
                        <select name="tipo">
                            <option value="">Todos los tipos</option>
                            <option value="Casa" {{ request('tipo')=='Casa'?'selected':'' }}>Casa</option>
                            <option value="Apartamento" {{ request('tipo')=='Apartamento'?'selected':'' }}>Apartamento</option>
                            <option value="Lote" {{ request('tipo')=='Lote'?'selected':'' }}>Lote</option>
                            <option value="Local comercial" {{ request('tipo')=='Local comercial'?'selected':'' }}>Local comercial</option>
                        </select>
                    </div>
                </div>

                <div class="filter-group">
                    <label>Ubicación</label>
                    <div class="input-wrapper" style="margin-bottom: 12px;">
                        <i class="fa-solid fa-map-location-dot"></i>
                        <select name="municipio" id="municipio">
                            <option value="">Seleccione Municipio</option>
                            @foreach($municipios as $m)
                                <option value="{{ $m->id }}" {{ request('municipio')==$m->id?'selected':'' }}>{{ $m->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-location-crosshairs"></i>
                        <select name="barrio" id="barrio">
                            <option value="">Seleccione Barrio</option>
                            @foreach($barrios as $b)
                                @if(request('municipio') == $b->idMunicipio)
                                    <option value="{{ $b->id }}" {{ request('barrio')==$b->id?'selected':'' }}>{{ $b->nombre }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="filter-group">
                    <label>Rango de Precio</label>
                    <div class="price-range">
                        <div class="input-wrapper">
                            <i class="fa-solid fa-dollar-sign"></i>
                            <input type="number" name="min" placeholder="Mínimo" value="{{ request('min') }}">
                        </div>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-dollar-sign"></i>
                            <input type="number" name="max" placeholder="Máximo" value="{{ request('max') }}">
                        </div>
                    </div>
                </div>

                <div class="filter-actions">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-filter"></i> Aplicar Filtros</button>
                    <a href="{{ route('vista.arriendo') }}" class="btn btn-ghost"><i class="fa-solid fa-rotate-right"></i> Limpiar</a>
                </div>
            </form>
        </aside>

        <main style="flex: 1;">
            @if($inmuebles->isEmpty())
                <div class="empty">
                    <i class="fa-regular fa-folder-open"></i>
                    <h2>No se encontraron resultados</h2>
                    <p>Intenta ajustar tus filtros de búsqueda para encontrar lo que necesitas.</p>
                    <a href="{{ route('vista.arriendo') }}" class="btn btn-primary" style="margin-top: 16px;">Ver todo el catálogo</a>
                </div>
            @else
                <div id="listing" class="list-grid">
                    @foreach($inmuebles as $item)
                        @php $img = optional($item->imagens->first())->ruta; @endphp
                        <article class="card">
                            <div class="card-img-wrapper">
                                <img src="{{ $img ? asset('storage/'.$img) : asset('img/no-image.jpg') }}" alt="Imagen inmueble">
                                <span class="badge-type">{{ $item->tipo ?? 'Arriendo' }}</span>
                                <div class="action-btns">
                                    <button class="icon-btn open-modal" data-img="{{ $img ? asset('storage/'.$img) : asset('img/no-image.jpg') }}" title="Ver imagen">
                                        <i class="fa-solid fa-expand"></i>
                                    </button>
                                    <button class="icon-btn fav" data-id="{{ $item->id }}" title="Guardar favorito">
                                        <i class="fa-regular fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <h3>{{ $item->titulo }}</h3>
                                
                                <div class="card-location">
                                    <i class="fa-solid fa-map-pin"></i> 
                                    <span>{{ $item->direccion }}</span>
                                </div>
                                
                                <div class="card-location" style="margin-top: -6px;">
                                    <i class="fa-solid fa-city" style="color: var(--text-muted); font-size: 0.8rem;"></i>
                                    <span style="font-size: 0.85rem; color: var(--text-muted);">
                                        {{ $item->barrio->nombre ?? 'Barrio N/A' }} • {{ $item->barrio->municipio->nombre ?? 'Municipio N/A' }}
                                    </span>
                                </div>

                                <div class="card-footer">
                                    <div class="price">
                                        ${{ number_format($item->precio,0,',','.') }}
                                        <span>Mensualidad</span>
                                    </div>
                                    <a href="#" class="btn btn-ghost" onclick="event.preventDefault(); mostrarDetalles({{ $item->id }});">
                                        Detalles <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="pagination">
                    {{ $inmuebles->withQueryString()->links() }}
                </div>
            @endif
        </main>
    </div>
</div>

<div id="modalRoot" style="display:none;"></div>

<script>
    /* ==========================================================================
       LÓGICA DEL TEMA (LIGHT/DARK)
       ========================================================================== */
    const body = document.body;
    const themeBtn = document.getElementById('toggleTheme');
    const themeIcon = themeBtn.querySelector('i');

    function updateThemeIcon(theme) {
        if(theme === 'dark') {
            themeIcon.classList.remove('fa-circle-half-stroke');
            themeIcon.classList.add('fa-sun');
        } else {
            themeIcon.classList.remove('fa-sun');
            themeIcon.classList.add('fa-moon');
        }
    }

    (function initTheme(){
        const match = document.cookie.split('; ').find(r => r.startsWith('theme='));
        const theme = match ? match.split('=')[1] : (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        body.setAttribute('data-theme', theme);
        updateThemeIcon(theme);
    })();

    themeBtn.onclick = () => {
        const isDark = body.getAttribute('data-theme') === 'dark';
        const newTheme = isDark ? 'light' : 'dark';
        body.setAttribute('data-theme', newTheme);
        updateThemeIcon(newTheme);
        document.cookie = "theme="+newTheme+"; path=/; max-age=" + 60*60*24*365;
    };

    /* ==========================================================================
       LÓGICA RESPONSIVE FILTROS
       ========================================================================== */
    const toggleFiltersBtn = document.getElementById('toggleFilters');
    const filtersWrapper = document.querySelector('.filters-wrapper');
    
    if(toggleFiltersBtn && filtersWrapper) {
        toggleFiltersBtn.onclick = () => {
            if(window.getComputedStyle(filtersWrapper).display === 'none'){
                filtersWrapper.style.display = 'block';
                filtersWrapper.style.animation = 'fadeIn 0.3s ease forwards';
            } else {
                filtersWrapper.style.display = 'none';
            }
        };
    }

    /* ==========================================================================
       LÓGICA DE MODALES
       ========================================================================== */
    const modalRoot = document.getElementById('modalRoot');

    // Escuchar clics globales para abrir modal básico de imagen o cerrar
    document.addEventListener('click', (e) => {
        const openBtn = e.target.closest('.open-modal');
        if(openBtn) {
            const src = openBtn.getAttribute('data-img') || '';
            abrirModalImagen(src);
            return;
        }

        if(e.target.classList.contains('modal-backdrop') || e.target.closest('.modal-close')) {
            cerrarModal();
        }
    });

    // Cerrar con Escape
    document.addEventListener('keydown', (e) => {
        if(e.key === 'Escape' && modalRoot.style.display === 'block') cerrarModal();
    });

    function cerrarModal() {
        const backdrop = modalRoot.querySelector('.modal-backdrop');
        if(backdrop) {
            backdrop.style.animation = 'fadeIn 0.2s ease reverse forwards';
            setTimeout(() => {
                modalRoot.innerHTML = '';
                modalRoot.style.display = 'none';
                document.body.style.overflow = 'auto'; // Restaurar scroll
            }, 200);
        } else {
            modalRoot.innerHTML = '';
            modalRoot.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    }

    function abrirModalImagen(src) {
        document.body.style.overflow = 'hidden'; // Evitar scroll fondo
        modalRoot.innerHTML = `
            <div class="modal-backdrop">
                <div class="zoom-modal">
                    <button class="modal-close" title="Cerrar"><i class="fa-solid fa-xmark"></i></button>
                    <img src="${src}" class="zoom-full" alt="Zoom Inmueble">
                </div>
            </div>
        `;
        modalRoot.style.display = 'block';
    }

    // Modal Completo de Detalles
    async function mostrarDetalles(id) {
        try {
            document.body.style.overflow = 'hidden';
            modalRoot.innerHTML = `
                <div class="modal-backdrop">
                    <div class="modal" style="display:flex; justify-content:center; align-items:center; min-height: 200px;">
                        <i class="fa-solid fa-circle-notch fa-spin" style="font-size: 2rem; color: var(--accent);"></i>
                    </div>
                </div>
            `;
            modalRoot.style.display = "block";

            const res = await fetch(`/inmueble/${id}/detalles`);
            const data = await res.json();
            
            const src = data.imagenes?.length ? (data.imagenes[0].url_imagen || '/storage/'+data.imagenes[0].ruta) : '{{ asset("img/no-image.jpg") }}';
            
            const formatter = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP', maximumFractionDigits: 0 });
            
            modalRoot.innerHTML = `
                <div class="modal-backdrop">
                    <div class="modal">
                        <button class="modal-close" title="Cerrar"><i class="fa-solid fa-xmark"></i></button>
                        
                        <div class="modal-img-container">
                            <img src="${src}" class="modal-img" alt="Foto principal">
                            <button class="zoom-btn" onclick="abrirModalImagen('${src}')">
                                <i class="fa-solid fa-magnifying-glass-plus"></i> Ampliar foto
                            </button>
                        </div>
                        
                        <div class="modal-info-container">
                            <h3>${data.titulo}</h3>
                            
                            <div class="modal-detail-item">
                                <i class="fa-solid fa-location-dot"></i>
                                <div class="modal-detail-text">
                                    <strong>Dirección Exacta</strong>
                                    <span>${data.direccion}</span>
                                </div>
                            </div>
                            
                            <div class="modal-detail-item">
                                <i class="fa-solid fa-city"></i>
                                <div class="modal-detail-text">
                                    <strong>Ubicación</strong>
                                    <span>${data?.barrio?.nombre || 'N/A'} • ${data?.barrio?.municipio?.nombre || 'N/A'}</span>
                                </div>
                            </div>

                            <div class="modal-detail-item">
                                <i class="fa-solid fa-user-tie"></i>
                                <div class="modal-detail-text">
                                    <strong>Anunciante</strong>
                                    <span>${data.usuario?.nombre || 'Usuario verificado'}</span>
                                </div>
                            </div>

                            <div class="modal-detail-item" style="margin-top: auto;">
                                <i class="fa-solid fa-tag" style="font-size: 1.5rem;"></i>
                                <div class="modal-detail-text">
                                    <strong>Valor Mensual</strong>
                                    <span style="font-size: 1.6rem; font-weight: 800; color: var(--accent);">${formatter.format(data.precio || 0)}</span>
                                </div>
                            </div>
                            
                            <button class="btn btn-primary" style="width: 100%; margin-top: 10px; padding: 14px;">
                                <i class="fa-brands fa-whatsapp"></i> Contactar ahora
                            </button>
                        </div>
                    </div>
                </div>
            `;
        } catch(e) { 
            console.error(e);
            cerrarModal();
            alert("Error al cargar los detalles del inmueble.");
        }
    }

    /* ==========================================================================
       LÓGICA SELECT DEPENDIENTE (MUNICIPIO -> BARRIO)
       ========================================================================== */
    const municipioSelect = document.getElementById('municipio');
    if(municipioSelect) {
        municipioSelect.addEventListener('change', function() {
            const mid = this.value;
            const barrio = document.getElementById('barrio');
            barrio.innerHTML = '<option value="">Seleccione Barrio</option>';
            
            // Los datos provienen del Blade rendering
            const data = @json($barrios);
            
            data.forEach(b => {
                if(String(b.idMunicipio) === String(mid)){
                    barrio.innerHTML += `<option value="${b.id}">${b.nombre}</option>`;
                }
            });
            
            // Pequeña animación visual para indicar que el select se actualizó
            barrio.style.animation = 'fadeIn 0.5s ease';
            setTimeout(() => { barrio.style.animation = ''; }, 500);
        });
    }

    /* ==========================================================================
       LÓGICA MICRO-INTERACCIÓN FAVORITOS
       ========================================================================== */
    document.querySelectorAll('.fav').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const icon = this.querySelector('i');
            
            if(icon.classList.contains('fa-regular')) {
                icon.classList.remove('fa-regular');
                icon.classList.add('fa-solid');
                icon.style.color = 'var(--danger)';
                // Aquí iría tu fetch real para guardar en BDD
            } else {
                icon.classList.remove('fa-solid');
                icon.classList.add('fa-regular');
                icon.style.color = 'inherit';
                // Aquí iría tu fetch real para borrar de BDD
            }
            
            // Efecto pop
            this.style.transform = 'scale(1.3)';
            setTimeout(() => { this.style.transform = ''; }, 200);
        });
    });
</script>

</body>
</html>