<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Inmobiliarias | Ultra Premium</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* =========================================
           VARIABLES GLOBALES & TEMA ULTRA PREMIUM
           ========================================= */
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --secondary: #0ea5e9;
            --accent: #f59e0b;
            --dark-bg: #0f172a;
            --dark-surface: #1e293b;
            --light-bg: #f8fafc;
            --white: #ffffff;
            --text-main: #334155;
            --text-muted: #64748b;
            
            /* Glassmorphism Variables */
            --glass-bg: rgba(255, 255, 255, 0.7);
            --glass-border: rgba(255, 255, 255, 0.5);
            --glass-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
            
            /* Sombras Premium */
            --shadow-float: 0 20px 40px -10px rgba(37, 99, 235, 0.2);
            --shadow-card: 0 10px 30px -5px rgba(0, 0, 0, 0.08);
            --shadow-neon: 0 0 20px rgba(37, 99, 235, 0.4);
            
            /* Transiciones */
            --transition-fast: 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-smooth: 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            --transition-bounce: 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
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
            background: var(--primary);
            color: var(--white);
        }

        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: var(--light-bg);
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-main);
            scroll-behavior: smooth;
            overflow-x: hidden;
            position: relative;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
            color: var(--dark-bg);
            line-height: 1.2;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* =========================================
           PRELOADER ELEGANTE
           ========================================= */
        .preloader {
            position: fixed;
            inset: 0;
            background: var(--dark-bg);
            z-index: 99999;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            transition: opacity 0.6s ease, visibility 0.6s ease;
        }
        .loader-logo {
            font-size: 2.5rem;
            color: var(--white);
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            margin-bottom: 20px;
            letter-spacing: 2px;
            animation: pulse 1.5s infinite;
        }
        .loader-logo span { color: var(--primary); }
        .progress-bar {
            width: 200px;
            height: 4px;
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }
        .progress-bar::after {
            content: '';
            position: absolute;
            top: 0; left: 0; height: 100%;
            width: 50%;
            background: var(--primary);
            border-radius: 10px;
            animation: loading 1.5s ease-in-out infinite;
        }

        /* =========================================
           NAVBAR FLOTANTE GLASSMORPHISM
           ========================================= */
        header {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 95%;
            max-width: 1200px;
            z-index: 1000;
            transition: var(--transition-smooth);
            border-radius: 50px;
        }

        header.scrolled {
            top: 10px;
            background: var(--glass-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--glass-border);
            box-shadow: var(--glass-shadow);
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 10px;
            transition: var(--transition-fast);
        }
        .logo i { filter: drop-shadow(0 2px 4px rgba(37,99,235,0.3)); }
        header.scrolled .logo span { color: var(--dark-bg); }
        .logo span { color: var(--white); transition: var(--transition-smooth); }

        .nav-links {
            display: flex;
            gap: 35px;
            align-items: center;
        }

        .nav-links a {
            font-weight: 600;
            color: var(--white);
            font-size: 1.05rem;
            position: relative;
            transition: var(--transition-smooth);
        }
        header.scrolled .nav-links a { color: var(--text-main); }
        
        .nav-links a::before {
            content: "";
            position: absolute;
            bottom: -5px; left: 0;
            width: 0; height: 3px;
            background: var(--primary);
            border-radius: 5px;
            transition: var(--transition-smooth);
        }
        .nav-links a:hover::before { width: 100%; }
        .nav-links a:hover { color: var(--primary); }

        .btn-login {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: var(--white) !important;
            font-weight: 600;
            padding: 12px 28px;
            border-radius: 50px;
            box-shadow: var(--shadow-neon);
            transition: var(--transition-bounce);
            display: flex;
            align-items: center;
            gap: 8px;
            border: 1px solid rgba(255,255,255,0.2);
            position: relative;
            overflow: hidden;
        }
        .btn-login::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            transition: 0.5s;
        }
        .btn-login:hover::before { left: 100%; }
        .btn-login:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 15px 25px rgba(37, 99, 235, 0.4);
        }

        /* =========================================
           HERO SECTION (Efecto Parallax + Esferas 3D)
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

        /* Imagen de fondo con parallax */
        .hero-bg {
            position: absolute;
            inset: -5%; /* Margen para parallax */
            width: 110%;
            height: 110%;
            background: url("{{ asset('img/Casa.jpg') }}") center center / cover no-repeat;
            z-index: 1;
            opacity: 0.6;
        }

        /* Overlay Gradiente Complejo */
        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.9) 0%, rgba(15, 23, 42, 0.4) 100%);
            z-index: 2;
        }

        /* Orbes brillantes animados */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: 2;
            animation: floatOrb 10s infinite alternate ease-in-out;
        }
        .orb-1 {
            width: 300px; height: 300px;
            background: var(--primary);
            top: 20%; left: 15%;
            opacity: 0.4;
        }
        .orb-2 {
            width: 400px; height: 400px;
            background: var(--secondary);
            bottom: 10%; right: 10%;
            opacity: 0.3;
            animation-delay: -5s;
        }

        .hero-content {
            position: relative;
            z-index: 10;
            text-align: center;
            width: 100%;
            max-width: 1000px;
            padding: 0 20px;
            margin-top: -50px;
        }

        .badge-premium {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            color: var(--secondary);
            padding: 8px 25px;
            border-radius: 50px;
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 30px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border: 1px solid rgba(255,255,255,0.15);
            animation: fadeInDown 1s ease;
        }
        .badge-premium i { color: var(--accent); }

        .hero h1 {
            color: var(--white);
            font-size: 4.8rem;
            font-weight: 900;
            margin-bottom: 25px;
            text-shadow: 0 10px 30px rgba(0,0,0,0.5);
            animation: fadeInUp 1s ease 0.2s both;
        }

        /* Efecto de Escritura (Typing) */
        .typing-container {
            display: inline-block;
            position: relative;
        }
        .typing-text {
            color: var(--accent);
            text-shadow: 0 0 20px rgba(245, 158, 11, 0.4);
            position: relative;
        }
        .typing-text::after {
            content: '|';
            position: absolute;
            right: -15px;
            color: var(--white);
            animation: blink 0.8s infinite;
        }

        .hero p {
            color: #cbd5e1;
            font-size: 1.3rem;
            font-weight: 400;
            margin-bottom: 50px;
            max-width: 700px;
            margin-inline: auto;
            animation: fadeInUp 1s ease 0.4s both;
            line-height: 1.6;
        }

        /* =========================================
           BUSCADOR MAESTRO (Glassmorphism Interactivo)
           ========================================= */
        .search-wrapper {
            animation: fadeInUp 1s ease 0.6s both;
            position: relative;
            z-index: 15;
        }

        .search-box {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border-radius: 60px;
            padding: 12px;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 30px 60px rgba(0,0,0,0.4), inset 0 1px 0 rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.2);
            transition: var(--transition-smooth);
        }

        .search-box:focus-within {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 30px 60px rgba(0,0,0,0.5), 0 0 30px rgba(37,99,235,0.3);
            transform: translateY(-2px);
        }

        /* Buscador Multi-select interactivo */
        .multi-select {
            position: relative;
            flex: 1.2;
            padding: 18px 25px;
            border-radius: 50px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 15px;
            background: rgba(255, 255, 255, 0.05);
            transition: var(--transition-smooth);
        }
        .multi-select:hover { background: rgba(255, 255, 255, 0.1); }
        .multi-select i { color: var(--secondary); font-size: 1.3rem; }
        .multi-select-display {
            font-weight: 600;
            color: var(--white);
            user-select: none;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 1.1rem;
        }

        /* Panel de Opciones Premium */
        .multi-select-options {
            display: none;
            position: absolute;
            top: calc(100% + 15px);
            left: 0;
            width: 100%;
            min-width: 280px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 15px;
            box-shadow: var(--shadow-float);
            z-index: 100;
            border: 1px solid rgba(255,255,255,0.5);
            grid-template-columns: 1fr;
            gap: 8px;
            animation: scaleIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .multi-option {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 14px 20px;
            border-radius: 16px;
            cursor: pointer;
            transition: var(--transition-fast);
            font-weight: 600;
            color: var(--text-main);
            background: transparent;
        }
        .multi-option:hover {
            background: var(--light-bg);
            color: var(--primary);
            transform: translateX(5px);
        }
        .multi-option input[type="checkbox"] {
            appearance: none;
            width: 22px; height: 22px;
            border: 2px solid #cbd5e1;
            border-radius: 6px;
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
            font-size: 12px;
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
        }

        .search-divider { width: 2px; height: 40px; background: rgba(255,255,255,0.2); }

        /* Input Texto */
        .input-group {
            flex: 2;
            display: flex;
            align-items: center;
            padding: 0 25px;
            gap: 15px;
        }
        .input-group i { color: var(--secondary); font-size: 1.3rem; }
        .search-box input[type="text"] {
            border: none; outline: none;
            background: transparent;
            font-size: 1.15rem;
            width: 100%;
            color: var(--white);
            font-family: inherit;
            font-weight: 500;
        }
        .search-box input::placeholder { color: rgba(255,255,255,0.6); }

        /* Botón Búsqueda */
        .btn-search {
            background: var(--primary);
            border: none; color: var(--white);
            padding: 18px 45px;
            border-radius: 50px;
            font-size: 1.15rem;
            font-weight: 700;
            cursor: pointer;
            transition: var(--transition-bounce);
            display: flex; align-items: center; gap: 12px;
            box-shadow: 0 10px 25px rgba(37,99,235,0.5);
            font-family: inherit;
        }
        .btn-search:hover {
            background: var(--primary-hover);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 15px 35px rgba(37,99,235,0.6);
        }

        /* Olas Separadoras SVG */
        .wave-bottom {
            position: absolute; bottom: -2px; left: 0;
            width: 100%; overflow: hidden; line-height: 0; z-index: 5;
        }
        .wave-bottom svg { display: block; width: calc(100% + 1.3px); height: 120px; }
        .wave-bottom .shape-fill { fill: var(--light-bg); }

        /* =========================================
           SECCIONES COMUNES
           ========================================= */
        .section-padding { padding: 120px 20px; position: relative; }
        .container { max-width: 1300px; margin: 0 auto; }
        
        .section-header {
            text-align: center;
            margin-bottom: 70px;
            position: relative;
        }
        .section-header h2 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 20px;
            position: relative;
            display: inline-block;
        }
        .section-header h2::after {
            content: '';
            position: absolute;
            bottom: -10px; left: 50%;
            transform: translateX(-50%);
            width: 80px; height: 4px;
            background: var(--primary);
            border-radius: 5px;
        }
        .section-header p {
            color: var(--text-muted);
            font-size: 1.15rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Clases para animación al scroll */
        .reveal { opacity: 0; transform: translateY(40px); transition: 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
        .reveal.active { opacity: 1; transform: translateY(0); }

        /* =========================================
           ESTADÍSTICAS FLOTANTES
           ========================================= */
        .stats-wrapper {
            position: relative;
            z-index: 20;
            margin-top: -70px;
            padding: 0 20px;
        }
        .stats-grid {
            background: var(--white);
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            border-radius: 30px;
            box-shadow: var(--shadow-float);
            padding: 40px;
            border: 1px solid #f1f5f9;
        }
        .stat-item {
            text-align: center;
            border-right: 2px dashed #e2e8f0;
            padding: 10px;
            transition: var(--transition-fast);
        }
        .stat-item:hover { transform: translateY(-5px); }
        .stat-item:last-child { border: none; }
        .stat-item h3 {
            font-size: 3rem; color: var(--primary);
            font-weight: 800; margin-bottom: 5px;
            font-family: 'Outfit', sans-serif;
        }
        .stat-item p { color: var(--text-muted); font-weight: 600; text-transform: uppercase; letter-spacing: 1px; font-size: 0.9rem;}

        /* =========================================
           PROPIEDADES DESTACADAS (Nueva Sección)
           ========================================= */
        .properties-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 40px;
        }
        .property-card {
            background: var(--white);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow-card);
            transition: var(--transition-smooth);
            border: 1px solid #f1f5f9;
            position: relative;
            cursor: pointer;
        }
        .property-card:hover {
            transform: translateY(-15px);
            box-shadow: var(--shadow-float);
        }
        .property-img {
            height: 250px;
            overflow: hidden;
            position: relative;
        }
        .property-img img {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }
        .property-card:hover .property-img img { transform: scale(1.1); }
        .property-badge {
            position: absolute;
            top: 20px; left: 20px;
            background: var(--primary);
            color: white;
            padding: 6px 15px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            z-index: 2;
        }
        .property-price {
            position: absolute;
            bottom: -20px; right: 20px;
            background: var(--white);
            color: var(--dark-bg);
            padding: 10px 25px;
            border-radius: 50px;
            font-size: 1.4rem;
            font-weight: 800;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            z-index: 2;
        }
        .property-content { padding: 35px 25px 25px; }
        .property-content h3 { font-size: 1.4rem; margin-bottom: 10px; }
        .property-location { color: var(--text-muted); margin-bottom: 20px; display: flex; align-items: center; gap: 8px; }
        .property-location i { color: var(--secondary); }
        .property-features {
            display: flex; justify-content: space-between;
            padding-top: 20px; border-top: 1px solid #f1f5f9;
        }
        .feature { display: flex; align-items: center; gap: 8px; color: var(--text-main); font-weight: 600; }
        .feature i { color: var(--primary); background: #eff6ff; padding: 10px; border-radius: 50%; }

        /* =========================================
           PROMESA DE VALOR (Tarjetas 3D Tilt)
           ========================================= */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 40px;
            perspective: 1000px;
        }
        .feature-box {
            background: var(--white);
            border-radius: 30px;
            padding: 50px 40px;
            text-align: center;
            box-shadow: var(--shadow-card);
            border: 1px solid #f1f5f9;
            transition: transform 0.1s ease, box-shadow 0.3s ease;
            transform-style: preserve-3d;
            position: relative;
        }
        .feature-box::before {
            content: '';
            position: absolute; inset: 0;
            border-radius: 30px;
            background: linear-gradient(135deg, rgba(37,99,235,0.05), transparent);
            z-index: 0;
        }
        .feature-box > * { position: relative; z-index: 1; transform: translateZ(30px); }
        .feature-icon-wrapper {
            width: 100px; height: 100px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 30%;
            display: flex; justify-content: center; align-items: center;
            margin: 0 auto 30px;
            box-shadow: var(--shadow-neon);
            transform: rotate(-10deg);
            transition: var(--transition-smooth);
        }
        .feature-box:hover .feature-icon-wrapper { transform: rotate(0deg) scale(1.1); }
        .feature-icon-wrapper i { font-size: 2.5rem; color: var(--white); }
        .feature-box h3 { font-size: 1.6rem; margin-bottom: 15px; }
        .feature-box p { color: var(--text-muted); line-height: 1.7; font-size: 1.05rem; }

        /* =========================================
           TESTIMONIOS
           ========================================= */
        .testimonials-section {
            background: var(--dark-bg);
            color: var(--white);
            position: relative;
            overflow: hidden;
        }
        .testimonials-section .section-header h2,
        .testimonials-section .section-header p { color: var(--white); }
        
        .reviews-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            position: relative;
            z-index: 2;
        }
        .review-card {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
            padding: 40px;
            border-radius: 24px;
            transition: var(--transition-smooth);
        }
        .review-card:hover { transform: translateY(-10px); background: rgba(255,255,255,0.08); }
        .stars { color: var(--accent); margin-bottom: 20px; font-size: 1.2rem; }
        .review-text { font-size: 1.1rem; line-height: 1.8; margin-bottom: 30px; font-style: italic; color: #cbd5e1; }
        .user-info { display: flex; align-items: center; gap: 15px; }
        .user-avatar { width: 60px; height: 60px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary); }
        .user-details h4 { color: var(--white); margin: 0; font-size: 1.1rem; }
        .user-details p { color: var(--secondary); margin: 0; font-size: 0.9rem; font-weight: 600; }

        /* =========================================
           CTA FINAL BANNER
           ========================================= */
        .cta-banner {
            max-width: 1200px;
            margin: -80px auto 100px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 40px;
            padding: 80px 40px;
            text-align: center;
            color: var(--white);
            position: relative;
            z-index: 10;
            box-shadow: 0 30px 60px rgba(37,99,235,0.3);
            overflow: hidden;
        }
        .cta-banner::before {
            content: ''; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 60%);
            animation: spin 15s linear infinite;
        }
        .cta-content { position: relative; z-index: 2; }
        .cta-banner h2 { color: var(--white); font-size: 3.5rem; margin-bottom: 20px; }
        .cta-banner p { font-size: 1.3rem; margin-bottom: 40px; opacity: 0.9; }
        .btn-light {
            background: var(--white);
            color: var(--primary);
            padding: 18px 50px;
            border-radius: 50px;
            font-size: 1.2rem;
            font-weight: 800;
            display: inline-block;
            transition: var(--transition-bounce);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .btn-light:hover { transform: scale(1.05); box-shadow: 0 15px 35px rgba(0,0,0,0.2); }

        /* =========================================
           FOOTER PREMIUM
           ========================================= */
        footer {
            background: var(--dark-surface);
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
            font-size: 1.4rem;
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 10px;
        }
        .footer-col h4::after {
            content: ""; position: absolute; left: 0; bottom: 0;
            width: 50px; height: 3px; background: var(--primary); border-radius: 3px;
        }
        .footer-col p { color: #94a3b8; line-height: 1.8; margin-bottom: 25px; font-size: 1.05rem; }
        
        .footer-links { list-style: none; }
        .footer-links li { margin-bottom: 15px; }
        .footer-links a {
            color: #94a3b8; transition: var(--transition-fast);
            display: flex; align-items: center; gap: 10px; font-size: 1.05rem;
        }
        .footer-links a::before {
            content: "\f105"; font-family: "Font Awesome 6 Free"; font-weight: 900;
            color: var(--primary); transition: var(--transition-fast);
        }
        .footer-links a:hover { color: var(--white); transform: translateX(8px); }

        .social-icons { display: flex; gap: 15px; }
        .social-icons a {
            width: 50px; height: 50px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: var(--white); font-size: 1.3rem;
            transition: var(--transition-bounce);
            border: 1px solid rgba(255,255,255,0.1);
        }
        .social-icons a:hover {
            background: var(--primary);
            transform: translateY(-8px);
            border-color: var(--primary);
            box-shadow: var(--shadow-neon);
        }
        
        .footer-bottom {
            background: #0b1120;
            text-align: center;
            padding: 30px 0;
            color: #64748b;
            font-size: 1rem;
            font-weight: 500;
        }

        /* Botón Flotante Top */
        .back-to-top {
            position: fixed;
            bottom: 30px; right: 30px;
            width: 50px; height: 50px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex; justify-content: center; align-items: center;
            font-size: 1.2rem;
            cursor: pointer;
            box-shadow: 0 10px 25px rgba(37,99,235,0.5);
            opacity: 0; visibility: hidden;
            transition: var(--transition-bounce);
            z-index: 1000;
        }
        .back-to-top.show { opacity: 1; visibility: visible; }
        .back-to-top:hover { transform: translateY(-5px); background: var(--primary-hover); }

        /* =========================================
           ANIMACIONES KEYFRAMES
           ========================================= */
        @keyframes fadeInDown { from { opacity: 0; transform: translateY(-30px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes scaleIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
        @keyframes floatOrb { 0% { transform: translate(0, 0) scale(1); } 100% { transform: translate(30px, -50px) scale(1.1); } }
        @keyframes blink { 0%, 100% { opacity: 1; } 50% { opacity: 0; } }
        @keyframes spin { 100% { transform: rotate(360deg); } }
        @keyframes pulse { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.05); } }
        @keyframes loading { 0% { left: -50%; } 100% { left: 100%; } }

        /* =========================================
           MEDIA QUERIES (Responsive Perfecto)
           ========================================= */
        @media (max-width: 1200px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 20px; padding: 30px; }
            .stat-item { border-right: none; border-bottom: 2px dashed #e2e8f0; padding-bottom: 20px; }
            .stat-item:nth-last-child(-n+2) { border-bottom: none; padding-bottom: 0; }
        }
        @media (max-width: 992px) {
            .hero h1 { font-size: 3.5rem; }
            .search-box { flex-direction: column; border-radius: 24px; padding: 25px; background: rgba(255,255,255,0.15); }
            .search-divider { display: none; }
            .multi-select, .input-group, .btn-search { width: 100%; border-radius: 12px; }
            .btn-search { justify-content: center; margin-top: 10px; }
            .footer-grid { grid-template-columns: repeat(2, 1fr); gap: 50px; }
            .cta-banner h2 { font-size: 2.5rem; }
        }
        @media (max-width: 768px) {
            .nav-links { display: none; /* Ideal para añadir menú hamburguesa */ }
            .hero h1 { font-size: 2.8rem; }
            .hero p { font-size: 1.1rem; }
            .section-header h2 { font-size: 2.3rem; }
            .footer-grid { grid-template-columns: 1fr; }
            .cta-banner { border-radius: 0; margin-top: 0; }
        }
    </style>
</head>

<body>

    <div class="preloader" id="preloader">
        <div class="loader-logo"><i class="fa-solid fa-house-chimney"></i> INMO<span>BIRA</span></div>
        <div class="progress-bar"></div>
    </div>

    <header id="header">
        <div class="nav-container">
            <a href="{{ route('pagina.principal') }}" class="logo">
                <i class="fa-solid fa-house-chimney"></i> <span>Inmobira</span>
            </a>
            
            <nav class="nav-links">
                <a href="{{ route('vista.arriendo') }}">Arriendo</a>
                <a href="{{ route('vista.venta') }}">Venta</a>
                <a href="{{ route('vista.inmobiliarias') }}">Inmobiliarias</a>
            </nav>

            <a href="{{ route('login') }}" class="btn-login">
                <i class="fa-regular fa-circle-user"></i> Acceder
            </a>
        </div>
    </header>

    <section class="hero" id="hero">
        <div class="hero-bg" id="hero-bg"></div>
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>

        <div class="hero-content">
            <span class="badge-premium"><i class="fa-solid fa-star"></i> Plataforma Líder 2026</span>
            <h1>Lo mejor de buscar es <br>
                <span class="typing-container">
                    <span class="typing-text" id="typing-text">encontrar</span>
                </span>
            </h1>
            <p>Descubre propiedades exclusivas con tecnología de vanguardia. La red inmobiliaria más avanzada y segura para tu próxima inversión.</p>

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
                        <i class="fa-solid fa-chevron-down" style="margin-left:auto; font-size:1rem; color:var(--white); transition: 0.3s;" id="select-arrow"></i>

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
                        Explorar <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="wave-bottom">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
            </svg>
        </div>
    </section>

    <div class="container stats-wrapper reveal">
        <div class="stats-grid">
            <div class="stat-item">
                <h3 class="counter" data-target="15000">0</h3>
                <p>Propiedades</p>
            </div>
            <div class="stat-item">
                <h3 class="counter" data-target="250">0</h3>
                <p>Agencias</p>
            </div>
            <div class="stat-item">
                <h3 class="counter" data-target="45">0</h3>
                <p>Ciudades</p>
            </div>
            <div class="stat-item">
                <h3 class="counter" data-target="99">0</h3>
                <p>% Satisfacción</p>
            </div>
        </div>
    </div>

    <section class="section-padding" style="background: var(--white);">
        <div class="container">
            <div class="section-header reveal">
                <h2>¿Por qué Inmobira?</h2>
                <p>Revolucionamos la forma en que buscas propiedades integrando tecnología, seguridad y asesoramiento humano en un solo lugar.</p>
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
                <p>Miles de familias y empresas ya han encontrado su lugar ideal gracias a nuestra red.</p>
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
                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i></div>
                    <p class="review-text">"Encontré un local comercial para mi nuevo negocio en menos de una semana. La interfaz es moderna, rápida y no tiene anuncios molestos."</p>
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
            <div class="cta-content">
                <h2>¿Listo para el siguiente paso?</h2>
                <p>Únete a la red y comienza a explorar miles de propiedades hoy mismo. Tu cuenta es 100% gratuita.</p>
                <a href="{{ route('login') }}" class="btn-light">Crear mi cuenta gratis</a>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-grid">
            <div class="footer-col">
                <a href="#" class="logo" style="color: var(--white); margin-bottom: 25px; display: inline-flex;">
                    <i class="fa-solid fa-house-chimney" style="color: var(--primary);"></i> Inmobira
                </a>
                <p>El estándar de oro en bienes raíces. Conectamos sueños con realidades mediante tecnología avanzada e innovación.</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/felipe_ortzzz" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.instagram.com/dreyan90" target="_blank"><i class="fab fa-instagram"></i></a>
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
                <ul class="footer-links" style="color: #94a3b8; font-size: 1.05rem; line-height: 2;">
                    <li><i class="fa-solid fa-building" style="color:var(--primary); margin-right:10px;"></i> Edificio Tech, Piso 8</li>
                    <li><i class="fa-brands fa-whatsapp" style="color:var(--primary); margin-right:10px;"></i> +57 322 217 5412</li>
                    <li><i class="fa-solid fa-phone" style="color:var(--primary); margin-right:10px;"></i> +57 313 341 8457</li>
                    <li><i class="fa-regular fa-envelope" style="color:var(--primary); margin-right:10px;"></i> soporte@inmobira.com</li>
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
            }, 800);

            // 2. Navbar efecto al hacer scroll
            const header = document.getElementById('header');
            const backToTop = document.getElementById('backToTop');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 80) {
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
            // Reemplazamos la lógica antigua que bloqueaba el scroll general, por una basada en desplazamiento Y
            const heroBg = document.getElementById('hero-bg');
            window.addEventListener('scroll', () => {
                const scrollPos = window.scrollY;
                if(scrollPos < 1000) {
                    heroBg.style.transform = `translateY(${scrollPos * 0.4}px)`;
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
                        // Activar contadores numéricos
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
            const words = ["encontrar.", "soñar.", "invertir.", "vivir."];
            let i = 0;
            let j = 0;
            let currentWord = "";
            let isDeleting = false;
            const typingElement = document.getElementById("typing-text");

            function typeEffect() {
                currentWord = words[i];
                if (isDeleting) {
                    typingElement.textContent = currentWord.substring(0, j - 1);
                    j--;
                } else {
                    typingElement.textContent = currentWord.substring(0, j + 1);
                    j++;
                }

                let typeSpeed = isDeleting ? 100 : 200;

                if (!isDeleting && j === currentWord.length) {
                    typeSpeed = 2000; // Pausa al final de la palabra
                    isDeleting = true;
                } else if (isDeleting && j === 0) {
                    isDeleting = false;
                    i++;
                    if (i === words.length) i = 0; // Reiniciar array
                    typeSpeed = 500;
                }
                setTimeout(typeEffect, typeSpeed);
            }
            setTimeout(typeEffect, 1500);

            // 7. Efecto Tilt 3D Vanilla JS para las tarjetas de Promesa de Valor
            const tiltCards = document.querySelectorAll('.tilt-card');
            tiltCards.forEach(card => {
                card.addEventListener('mousemove', (e) => {
                    const rect = card.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    
                    const rotateX = ((y - centerY) / centerY) * -10; // Max 10 deg
                    const rotateY = ((x - centerX) / centerX) * 10;
                    
                    card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;
                });

                card.addEventListener('mouseleave', () => {
                    card.style.transform = `perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)`;
                    card.style.transition = 'transform 0.5s ease';
                });
                
                card.addEventListener('mouseenter', () => {
                    card.style.transition = 'none'; // Quitar transición suave durante el hover
                });
            });

        });
    </script>
</body>
</html>