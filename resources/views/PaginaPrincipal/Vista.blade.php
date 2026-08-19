<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Inmobiliarias | Ultra Premium Minimal</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" > 
    <style>       
        /* =========================================
           VARIABLES GLOBALES - MINIMALISMO PREMIUM
           ========================================= */
        :root {
            /* Paleta Monocromática con Acento Sofisticado */
            --primary: #000000;
            --primary-hover: #333333;
            --accent: #0055FF; /* Azul eléctrico muy limpio para acentos */
            --dark-bg: #0A0A0A;
            --dark-surface: #121212;
            --light-bg: #F8F9FA;
            --white: #FFFFFF;
            --text-main: #1A1A1A;
            --text-muted: #666666;
            --border-light: #E5E5E5;
            
            /* Sombras Editoriales sutiles */
            --shadow-sm: 0 4px 12px rgba(0, 0, 0, 0.03);
            --shadow-md: 0 12px 32px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 24px 48px rgba(0, 0, 0, 0.08);
            
            /* Transiciones Fluidas (Apple-esque) */
            --transition-fast: 0.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            --transition-smooth: 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        /* =========================================
           RESET & ESTILOS BASE
           ========================================= */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        ::selection {
            background: var(--text-main);
            color: var(--white);
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--white);
        }

        ::-webkit-scrollbar-thumb {
            background: #CCCCCC;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #999999;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--white);
            color: var(--text-main);
            scroll-behavior: smooth;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
            color: var(--text-main);
            line-height: 1.1;
            letter-spacing: -0.03em;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* =========================================
           PRELOADER MINIMALISTA
           ========================================= */
        .preloader {
            position: fixed;
            inset: 0;
            background: var(--white);
            z-index: 99999;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            transition: opacity 0.6s ease, visibility 0.6s ease;
        }
        .loader-logo {
            font-size: 2rem;
            color: var(--text-main);
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            margin-bottom: 20px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .loader-logo span { color: var(--accent); }
        .progress-bar {
            width: 150px;
            height: 2px;
            background: var(--border-light);
            overflow: hidden;
            position: relative;
        }
        .progress-bar::after {
            content: '';
            position: absolute;
            top: 0; left: 0; height: 100%;
            width: 50%;
            background: var(--primary);
            animation: loading 1.5s cubic-bezier(0.16, 1, 0.3, 1) infinite;
        }

        /* =========================================
           NAVBAR FLOTANTE INVISIBLE/BLANCO
           ========================================= */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            transition: var(--transition-smooth);
            background: transparent;
            padding: 20px 0;
        }

        header.scrolled {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 15px 0;
            border-bottom: 1px solid var(--border-light);
            box-shadow: var(--shadow-sm);
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 40px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .logo {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--white);
            display: flex;
            align-items: center;
            gap: 10px;
            transition: var(--transition-smooth);
            text-transform: uppercase;
            letter-spacing: -0.02em;
        }
        header.scrolled .logo { color: var(--primary); }
        .logo span { color: var(--white); transition: var(--transition-smooth); }
        header.scrolled .logo span { color: var(--primary); }
        .logo i { color: var(--accent); }

        .nav-links {
            display: flex;
            gap: 40px;
            align-items: center;
        }

        .nav-links a {
            font-weight: 500;
            color: var(--white);
            font-size: 0.95rem;
            position: relative;
            transition: var(--transition-fast);
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.9;
        }
        header.scrolled .nav-links a { color: var(--text-main); }
        
        .nav-links a::before {
            content: "";
            position: absolute;
            bottom: -6px; left: 0;
            width: 0; height: 1px;
            background: var(--white);
            transition: var(--transition-smooth);
        }
        header.scrolled .nav-links a::before { background: var(--primary); }
        .nav-links a:hover::before { width: 100%; }
        .nav-links a:hover { opacity: 1; }

        .btn-login {
            background: var(--white);
            color: var(--primary) !important;
            font-weight: 600;
            padding: 12px 28px;
            border-radius: 4px;
            transition: var(--transition-smooth);
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        header.scrolled .btn-login {
            background: var(--primary);
            color: var(--white) !important;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* =========================================
           HERO SECTION (Editorial & Minimalista)
           ========================================= */
        .hero {
            position: relative;
            height: 100vh;
            min-height: 800px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: var(--dark-bg);
        }

        .hero-bg {
            position: absolute;
            inset: -5%;
            width: 110%;
            height: 110%;
            background: url("{{ asset('img/Casa.jpg') }}") center center / cover no-repeat;
            z-index: 1;
        }

        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.7) 100%);
            z-index: 2;
        }

        .hero-content {
            position: relative;
            z-index: 10;
            text-align: center;
            width: 100%;
            max-width: 1100px;
            padding: 0 20px;
            margin-top: 40px;
        }

        /* La etiqueta "Plataforma Líder" - Limpia y sutil */
        .badge-premium {
            font-family: 'Inter', sans-serif;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            color: var(--white);
            padding: 8px 18px;
            border-radius: 50px; 
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 20px;
            display: inline-flex;
            align-items: center;
            border: 1px solid rgba(255, 255, 255, 0.15);
            animation: fadeInDown 1s ease;
        }

        /* El título principal - Sencillo, contundente y moderno */
        .hero h1 {
            font-family: 'Inter', sans-serif;
            color: var(--white);
            font-size: 5rem;
            font-weight: 800; /* Grueso para dar peso sin necesitar adornos */
            line-height: 1.1;
            margin-bottom: 30px;
            letter-spacing: -0.04em; /* Juntar un poco las letras da un look muy Tech/Premium */
            animation: fadeInUp 1s ease 0.2s both;
        }

        /* La palabra animada - Exactamente igual al resto del título */
        .typing-container {
            display: inline-block;
            position: relative;
        }
        
        .typing-text {
            font-family: 'Inter', sans-serif;
            font-style: normal; /* Sin cursivas */
            font-weight: 800;
            color: var(--white); /* Mantenemos el blanco puro */
            position: relative;
        }
        
        /* El cursor parpadeante */
        .typing-text::after {
            content: '|';
            position: absolute;
            right: -15px;
            color: var(--white); /* Cursor en blanco para no romper la armonía monocromática */
            font-weight: 300;
            animation: blink 0.8s infinite;
        }

        .hero p {
            color: rgba(255,255,255,0.8);
            font-size: 1.2rem;
            font-weight: 300;
            margin-bottom: 60px;
            max-width: 600px;
            margin-inline: auto;
            animation: fadeInUp 1s ease 0.4s both;
            line-height: 1.6;
            letter-spacing: 0.5px;
        }

        .search-wrapper {
            animation: fadeInUp 1s ease 0.6s both;
            position: relative;
            z-index: 15;
            max-width: 900px;
            margin: 0 auto;
        }

        .search-box {
            background: var(--white);
            border-radius: 8px;
            padding: 10px;
            display: flex;
            align-items: center;
            box-shadow: var(--shadow-lg);
            transition: var(--transition-smooth);
        }

        .multi-select {
            position: relative;
            flex: 1;
            padding: 20px 25px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: var(--transition-fast);
        }
        .multi-select i { color: var(--text-muted); font-size: 1.1rem; }
        .multi-select-display {
            font-weight: 500;
            color: var(--text-main);
            user-select: none;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 1rem;
        }

        .multi-select-options {
            display: none;
            position: absolute;
            top: calc(100% + 10px);
            left: 0;
            width: 100%;
            min-width: 250px;
            background: var(--white);
            border-radius: 8px;
            padding: 10px;
            box-shadow: var(--shadow-lg);
            z-index: 100;
            border: 1px solid var(--border-light);
            grid-template-columns: 1fr;
            gap: 4px;
            animation: scaleIn 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .multi-option {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: var(--transition-fast);
            font-weight: 500;
            color: var(--text-main);
            font-size: 0.95rem;
        }
        .multi-option:hover {
            background: var(--light-bg);
        }
        .multi-option input[type="checkbox"] {
            appearance: none;
            width: 18px; height: 18px;
            border: 1px solid var(--border-light);
            border-radius: 3px;
            cursor: pointer;
            position: relative;
            transition: var(--transition-fast);
        }
        .multi-option input[type="checkbox"]:checked {
            background: var(--primary);
            border-color: var(--primary);
        }
        .multi-option input[type="checkbox"]:checked::after {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            color: white;
            font-size: 10px;
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
        }

        .search-divider { width: 1px; height: 40px; background: var(--border-light); }

        .input-group {
            flex: 1.5;
            display: flex;
            align-items: center;
            padding: 0 25px;
            gap: 15px;
        }
        .input-group i { color: var(--text-muted); font-size: 1.1rem; }
        .search-box input[type="text"] {
            border: none; outline: none;
            background: transparent;
            font-size: 1rem;
            width: 100%;
            color: var(--text-main);
            font-family: inherit;
            font-weight: 400;
        }
        .search-box input::placeholder { color: #A0A0A0; font-weight: 300; }

        .btn-search {
            background: var(--primary);
            border: none; color: var(--white);
            padding: 20px 40px;
            border-radius: 4px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition-fast);
            display: flex; align-items: center; gap: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .btn-search:hover {
            background: var(--primary-hover);
        }

        /* Se removieron las olas SVG para mantener el minimalismo puro */
        .wave-bottom { display: none; }

        /* =========================================
           SECCIONES COMUNES
           ========================================= */
        .section-padding { padding: 140px 20px; position: relative; }
        .container { max-width: 1200px; margin: 0 auto; }
        
        .section-header {
            text-align: center;
            margin-bottom: 80px;
            position: relative;
        }
        .section-header h2 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 25px;
        }
        .section-header p {
            color: var(--text-muted);
            font-size: 1.1rem;
            max-width: 500px;
            margin: 0 auto;
            line-height: 1.6;
            font-weight: 300;
        }

        .reveal { opacity: 0; transform: translateY(30px); transition: 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
        .reveal.active { opacity: 1; transform: translateY(0); }

        /* =========================================
           ESTADÍSTICAS (Grid Limpio)
           ========================================= */
        .stats-wrapper {
            position: relative;
            z-index: 20;
            background: var(--white);
            padding: 80px 20px 0;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            border-top: 1px solid var(--border-light);
            border-bottom: 1px solid var(--border-light);
        }
        .stat-item {
            text-align: center;
            border-right: 1px solid var(--border-light);
            padding: 50px 20px;
        }
        .stat-item:last-child { border-right: none; }
        .stat-item h3 {
            font-size: 4rem; 
            color: var(--primary);
            font-weight: 300; 
            margin-bottom: 10px;
            font-family: 'Outfit', sans-serif;
            letter-spacing: -2px;
        }
        .stat-item p { 
            color: var(--text-muted); 
            font-weight: 500; 
            text-transform: uppercase; 
            letter-spacing: 2px; 
            font-size: 0.75rem;
        }

        /* =========================================
           PROMESA DE VALOR (Tarjetas Ultra Clean)
           ========================================= */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
            perspective: 1000px;
        }
        .feature-box {
            background: var(--white);
            padding: 60px 40px;
            text-align: left; /* Alineación izquierda para toque editorial */
            border: 1px solid var(--border-light);
            transition: var(--transition-smooth);
            transform-style: preserve-3d;
            position: relative;
        }
        .feature-box:hover {
            box-shadow: var(--shadow-md);
            border-color: transparent;
        }
        .feature-icon-wrapper {
            width: 60px; height: 60px;
            background: var(--light-bg);
            border-radius: 50%;
            display: flex; justify-content: center; align-items: center;
            margin-bottom: 30px;
            transition: var(--transition-smooth);
        }
        .feature-box:hover .feature-icon-wrapper { 
            background: var(--primary);
        }
        .feature-box:hover .feature-icon-wrapper i {
            color: var(--white);
        }
        .feature-icon-wrapper i { 
            font-size: 1.5rem; 
            color: var(--primary); 
            transition: var(--transition-fast);
        }
        .feature-box h3 { 
            font-size: 1.5rem; 
            margin-bottom: 15px; 
            font-weight: 600;
        }
        .feature-box p { 
            color: var(--text-muted); 
            line-height: 1.6; 
            font-size: 1rem; 
            font-weight: 300;
        }

        /* =========================================
           TESTIMONIOS (Luz y Espacio)
           ========================================= */
        .testimonials-section {
            background: var(--light-bg);
            position: relative;
        }
        
        .reviews-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
        }
        .review-card {
            background: var(--white);
            padding: 50px 40px;
            border: 1px solid var(--border-light);
            transition: var(--transition-smooth);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .review-card:hover { 
            transform: translateY(-5px); 
            box-shadow: var(--shadow-sm); 
        }
        .stars { color: var(--primary); margin-bottom: 25px; font-size: 0.9rem; letter-spacing: 2px; }
        .review-text { 
            font-size: 1.1rem; 
            line-height: 1.7; 
            margin-bottom: 40px; 
            font-weight: 300; 
            color: var(--text-main); 
        }
        .user-info { display: flex; align-items: center; gap: 15px; }
        .user-avatar { width: 50px; height: 50px; border-radius: 50%; object-fit: cover; }
        .user-details h4 { color: var(--text-main); margin: 0; font-size: 1rem; font-weight: 600; }
        .user-details p { color: var(--text-muted); margin: 0; font-size: 0.85rem; font-weight: 400; }

        /* =========================================
           CTA FINAL BANNER (Alto Contraste)
           ========================================= */
        .cta-banner {
            max-width: 1200px;
            margin: 0 auto 100px;
            background: var(--primary);
            padding: 100px 40px;
            text-align: center;
            color: var(--white);
            position: relative;
            z-index: 10;
        }
        .cta-banner h2 { color: var(--white); font-size: 3.5rem; margin-bottom: 25px; font-weight: 800; }
        .cta-banner p { font-size: 1.1rem; margin-bottom: 40px; font-weight: 300; opacity: 0.8; max-width: 500px; margin-inline: auto; }
        .btn-light {
            background: var(--white);
            color: var(--primary);
            padding: 20px 50px;
            border-radius: 4px;
            font-size: 0.95rem;
            font-weight: 600;
            display: inline-block;
            transition: var(--transition-fast);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .btn-light:hover { 
            background: var(--border-light); 
        }

        /* =========================================
           FOOTER MINIMALISTA
           ========================================= */
        footer {
            background: var(--dark-bg);
            color: var(--white);
            padding: 100px 0 0;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 60px;
            padding: 0 40px 80px;
            max-width: 1400px;
            margin: 0 auto;
        }
        .footer-col h4 {
            color: var(--white);
            font-size: 1rem;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 500;
        }
        .footer-col p { color: #888888; line-height: 1.8; margin-bottom: 30px; font-size: 0.95rem; font-weight: 300; max-width: 300px; }
        
        .footer-links { list-style: none; }
        .footer-links li { margin-bottom: 15px; }
        .footer-links a {
            color: #888888; transition: var(--transition-fast);
            font-size: 0.95rem; font-weight: 300;
        }
        .footer-links a:hover { color: var(--white); }

        .social-icons { display: flex; gap: 20px; }
        .social-icons a {
            color: var(--white); font-size: 1.1rem;
            transition: var(--transition-fast);
            opacity: 0.6;
        }
        .social-icons a:hover {
            opacity: 1;
        }
        
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.05);
            text-align: center;
            padding: 30px 0;
            color: #666666;
            font-size: 0.85rem;
            font-weight: 300;
            letter-spacing: 1px;
        }

        /* Botón Flotante Top */
        .back-to-top {
            position: fixed;
            bottom: 40px; right: 40px;
            width: 45px; height: 45px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex; justify-content: center; align-items: center;
            font-size: 1rem;
            cursor: pointer;
            box-shadow: var(--shadow-md);
            opacity: 0; visibility: hidden;
            transition: var(--transition-fast);
            z-index: 1000;
        }
        .back-to-top.show { opacity: 1; visibility: visible; }
        .back-to-top:hover { transform: translateY(-3px); background: var(--primary-hover); }

        /* =========================================
           ANIMACIONES KEYFRAMES
           ========================================= */
        @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes scaleIn { from { opacity: 0; transform: scale(0.98); } to { opacity: 1; transform: scale(1); } }
        @keyframes blink { 0%, 100% { opacity: 1; } 50% { opacity: 0; } }
        @keyframes loading { 0% { left: -50%; } 100% { left: 100%; } }

        /* =========================================
           MEDIA QUERIES
           ========================================= */
        @media (max-width: 1200px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); border: none; }
            .stat-item { border-right: none; border-bottom: 1px solid var(--border-light); padding: 40px 20px; }
            .features-grid, .reviews-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 992px) {
            .hero h1 { font-size: 4rem; }
            .search-box { flex-direction: column; padding: 20px; border-radius: 8px; }
            .search-divider { display: none; }
            .multi-select, .input-group, .btn-search { width: 100%; padding: 15px; }
            .footer-grid { grid-template-columns: repeat(2, 1fr); gap: 50px; }
        }
        @media (max-width: 768px) {
            .nav-links { display: none; }
            .hero h1 { font-size: 3rem; }
            .section-header h2 { font-size: 2.5rem; }
            .features-grid, .reviews-grid { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr; }
            .cta-banner { padding: 60px 20px; }
            .cta-banner h2 { font-size: 2.5rem; }
        }
    </style>
</head>

<body>

    <div class="preloader" id="preloader">
        <div class="loader-logo">INMO<span>BIRA</span></div>
        <div class="progress-bar"></div>
    </div>

    <header id="header">
        <div class="nav-container">
            <a class="logo">
                <i class="fa-solid fa-house-chimney"></i> <span>Inmobira</span>
            </a>
            
            <nav class="nav-links">
                <a href="{{ route('vista.arriendo') }}">Arriendo</a>
                <a href="{{ route('vista.venta') }}">Venta</a>
                <a href="{{ route('vista.inmobiliarias') }}">Inmobiliarias</a>
            </nav>

            <a href="{{ route('login') }}" class="btn-login">
                Iniciar sesion
            </a>
        </div>
    </header>

    <section class="hero" id="hero">
        <div class="hero-bg" id="hero-bg"></div>

        <div class="hero-content">
            <span class="badge-premium">Plataforma Líder 2026</span>
            <h1 >Lo mejor de buscar es <br> 
                <span class="typing-container">
                    <span class="typing-text" id="typing-text">encontrar</span>
                </span>
            </h1>
            <p>Descubre propiedades exclusivas con una experiencia refinada. La red inmobiliaria más avanzada y segura para tu próxima inversión.</p>

            <div class="search-wrapper">
                <form action="{{ route('buscador.inmuebles') }}" method="GET" class="search-box">
                    
                    <div class="multi-select" id="multiSelect">
                        <i class="fa-solid fa-layer-group"></i>
                        <div class="multi-select-display" id="selectedTypes">
                            @php
                                $selected = request('tipos') ? implode(', ', request('tipos')) : 'Selecciona el tipo';
                            @endphp
                            {{ $selected }}
                        </div>
                        <i class="fa-solid fa-chevron-down" style="margin-left:auto; font-size:0.9rem; transition: 0.3s;" id="select-arrow"></i>

                        <div class="multi-select-options" id="multiOptions">
                            @foreach (['Casa', 'Apartamento', 'Local comercial', 'Lote'] as $tipo)
                                <label class="multi-option">
                                    <input type="checkbox" name="tipos[]" value="{{ $tipo }}"
                                        {{ request('tipos') && in_array($tipo, request('tipos')) ? 'checked' : '' }}>
                                    <span>{{ $tipo }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="search-divider"></div>

                    <div class="input-group">
                        <i class="fa-solid fa-location-dot"></i>
                        <input type="text" name="q" placeholder="Ciudad, barrio o zona..."
                            value="{{ request('q') }}">
                    </div>

                    <button type="submit" class="btn-search">
                        Explorar
                    </button>
                </form>
            </div>
        </div>

        <div class="wave-bottom"></div>
    </section>

    <section class="section-padding" style="background: var(--white);">
        <div class="container">
            <div class="section-header reveal">
                <h2>¿Por qué Inmobira?</h2>
                <p>Revolucionamos la forma en que buscas propiedades integrando diseño limpio, seguridad absoluta y asesoramiento experto.</p>
            </div>

            <div class="features-grid">
                <div class="feature-box reveal tilt-card">
                    <div class="feature-icon-wrapper"><i class="fa-solid fa-fingerprint"></i></div>
                    <h3>Seguridad Biométrica</h3>
                    <p>Agencias y propiedades 100% verificadas. Nuestro riguroso filtro evita fraudes y garantiza transacciones seguras.</p>
                </div>
                <div class="feature-box reveal tilt-card" style="transition-delay: 0.1s;">
                    <div class="feature-icon-wrapper"><i class="fa-solid fa-brain"></i></div>
                    <h3>IA de Búsqueda</h3>
                    <p>Nuestro algoritmo aprende de tus gustos y te sugiere las propiedades que realmente encajan con tu estilo de vida.</p>
                </div>
                <div class="feature-box reveal tilt-card" style="transition-delay: 0.2s;">
                    <div class="feature-icon-wrapper"><i class="fa-solid fa-headset"></i></div>
                    <h3>Concierge 24/7</h3>
                    <p>No estás solo. Un asesor experto te acompaña desde el primer clic hasta la entrega de tus nuevas llaves.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding testimonials-section">
        <div class="container">
            <div class="section-header reveal">
                <h2>Historias de Éxito</h2>
                <p>Miles de familias y empresas ya han encontrado su lugar ideal gracias a nuestra red curada.</p>
            </div>

            <div class="reviews-grid">
                <div class="review-card reveal">
                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                    <p class="review-text">"Nunca pensé que comprar mi primera casa sería tan fácil. La plataforma me filtró exactamente lo que quería y el trato de la agencia fue espectacular."</p>
                    <div class="user-info">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&auto=format&fit=facearea&facepad=2&w=150&q=80" alt="User" class="user-avatar">
                        <div class="user-details">
                            <h4>María Fernanda</h4>
                            <p>Propietaria de Casa</p>
                        </div>
                    </div>
                </div>
                <div class="review-card reveal" style="transition-delay: 0.1s;">
                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                    <p class="review-text">"Como inversor, valoro mucho el tiempo. Inmobira me da las métricas claras y propiedades reales. He cerrado 3 tratos este año usando la plataforma."</p>
                    <div class="user-info">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=facearea&facepad=2&w=150&q=80" alt="User" class="user-avatar">
                        <div class="user-details">
                            <h4>Carlos Restrepo</h4>
                            <p>Inversionista Inmobiliario</p>
                        </div>
                    </div>
                </div>
                <div class="review-card reveal" style="transition-delay: 0.2s;">
                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                    <p class="review-text">"Encontré un local comercial para mi nuevo negocio en menos de una semana. La interfaz es minimalista, rápida y sin distracciones."</p>
                    <div class="user-info">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=facearea&facepad=2&w=150&q=80" alt="User" class="user-avatar">
                        <div class="user-details">
                            <h4>Laura Gómez</h4>
                            <p>Emprendedora</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container reveal" style="position: relative; z-index: 30;">
        <div class="cta-banner">
            <h2>¿Listo para el siguiente paso?</h2>
            <p>Únete a la red y comienza a explorar miles de propiedades hoy mismo. Tu cuenta es completamente gratuita.</p>
            <a href="{{ route('login') }}" class="btn-light">Crear mi cuenta gratis</a>
        </div>
    </div>

    <footer>
        <div class="footer-grid">
            <div class="footer-col">
                <a href="#" class="logo" style="color: var(--white); margin-bottom: 25px; display: inline-flex;">
                    Inmobira
                </a>
                <p>El estándar de oro en bienes raíces. Conectamos sueños con realidades mediante diseño impecable y tecnología.</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/felipe_ortzzz" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <div class="footer-col">
                <h4>Descubrir</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('pagina.principal') }}">Inicio</a></li>
                    <li><a href="{{ route('vista.arriendo') }}">Casas en Arriendo</a></li>
                    <li><a href="{{ route('vista.venta') }}">Proyectos Nuevos</a></li>
                    <li><a href="{{ route('vista.inmobiliarias') }}">Directorio de Agencias</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Legal</h4>
                <ul class="footer-links">
                    <li><a href="#">Términos y Condiciones</a></li>
                    <li><a href="#">Política de Privacidad</a></li>
                    <li><a href="#">Manejo de Cookies</a></li>
                    <li><a href="#">Centro de Ayuda</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Contáctanos</h4>
                <ul class="footer-links" style="line-height: 2.2;">
                    <p>Edificio Tech, Piso 8</p>
                    <p>+57 322 217 5412</p>
                    <p>soporte@inmobira.com</p>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>© 2026 Inmobira S.A.S. Todos los derechos reservados. Diseñado con altos estándares de calidad.</p>
        </div>
    </footer>

    <div class="back-to-top" id="backToTop"><i class="fa-solid fa-arrow-up"></i></div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // 1. Quitar Preloader Elegantemente
            const preloader = document.getElementById('preloader');
            setTimeout(() => {
                preloader.style.opacity = '0';
                setTimeout(() => preloader.style.visibility = 'hidden', 600);
            }, 600);

            // 2. Navbar efecto al hacer scroll
            const header = document.getElementById('header');
            const backToTop = document.getElementById('backToTop');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    header.classList.add('scrolled');
                    backToTop.classList.add('show');
                } else {
                    header.classList.remove('scrolled');
                    backToTop.classList.remove('show');
                }
            });

            // Volver arriba
            backToTop.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            // 3. Efecto Parallax en el Background del Hero 
            const heroBg = document.getElementById('hero-bg');
            window.addEventListener('scroll', () => {
                const scrollPos = window.scrollY;
                if(scrollPos < 1000) {
                    heroBg.style.transform = `translateY(${scrollPos * 0.3}px)`;
                }
            });

            // 4. Lógica del Select Múltiple
            const display = document.getElementById("selectedTypes");
            const options = document.getElementById("multiOptions");
            const container = document.getElementById("multiSelect");
            const arrow = document.getElementById("select-arrow");

            container.addEventListener("click", (e) => {
                e.stopPropagation();
                const isGrid = options.style.display === "grid";
                options.style.display = isGrid ? "none" : "grid";
                arrow.style.transform = isGrid ? 'rotate(0deg)' : 'rotate(180deg)';
            });

            document.querySelectorAll('.multi-option input').forEach(chk => {
                chk.addEventListener("change", () => {
                    const selected = [...document.querySelectorAll('.multi-option input:checked')].map(x => x.value);
                    display.textContent = selected.length ? selected.join(", ") : "Selecciona el tipo";
                });
            });

            document.addEventListener("click", (e) => {
                if (!container.contains(e.target)) {
                    options.style.display = "none";
                    arrow.style.transform = 'rotate(0deg)';
                }
            });

            // 5. Scroll Reveal & Contadores
            const observerOptions = { threshold: 0.1, rootMargin: "0px 0px -50px 0px" };
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        if(entry.target.classList.contains('stats-wrapper')) {
                            runCounters(entry.target);
                        }
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

            function runCounters(parent) {
                const counters = parent.querySelectorAll('.counter');
                counters.forEach(counter => {
                    counter.innerText = '0';
                    const target = +counter.getAttribute('data-target');
                    const increment = target / 60; 
                    
                    const updateCounter = () => {
                        const c = +counter.innerText.replace(/\D/g, '');
                        if (c < target) {
                            counter.innerText = Math.ceil(c + increment).toLocaleString('es-CO');
                            setTimeout(updateCounter, 25);
                        } else {
                            counter.innerText = target.toLocaleString('es-CO') + (target > 50 ? '+' : '');
                        }
                    };
                    updateCounter();
                });
            }

            // 6. Efecto Typing Dinámico
            const words = ["encontrar."];
            let i = 0;
            let j = 0;
            let currentWord = "";
            let isDeleting = false;
            const typingElement = document.getElementById("typing-text");

            function typeEffect() {
                currentWord = words[i];
                    {
                        typingElement.textContent = currentWord.substring(0, j + 1);
                        j++;
                    }

                let typeSpeed = isDeleting ? 80 : 150;

                if (!isDeleting && j === currentWord.length) {
                    typeSpeed = 2000; 
                    isDeleting = true;
                } else if (isDeleting && j === 0) {
                    isDeleting = false;
                    i++;
                    if (i === words.length) i = 0; 
                    typeSpeed = 500;
                }
                setTimeout(typeEffect, typeSpeed);
            }
            setTimeout(typeEffect, 1500);

            // 7. Efecto Tilt 3D (Refinado para Minimalismo)
            const tiltCards = document.querySelectorAll('.tilt-card');
            tiltCards.forEach(card => {
                card.addEventListener('mousemove', (e) => {
                    const rect = card.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    
                    const rotateX = ((y - centerY) / centerY) * -4; // Reducido para mayor elegancia
                    const rotateY = ((x - centerX) / centerX) * 4;
                    
                    card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.01, 1.01, 1.01)`;
                });

                card.addEventListener('mouseleave', () => {
                    card.style.transform = `perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)`;
                    card.style.transition = 'transform 0.5s cubic-bezier(0.16, 1, 0.3, 1)';
                });
                
                card.addEventListener('mouseenter', () => {
                    card.style.transition = 'none'; 
                });
            });

        });
    </script>
</body>
</html>