<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Inmobiliarias</title>
    <style>
    /* --- Botón de inicio de sesión --- */
    .btn-login {
        position: absolute;
        top: 60px; 
        right: 80px;
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(8px);
        color: #333;
        font-weight: 600;
        padding: 10px 25px;
        border-radius: 40px;
        text-decoration: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
        z-index: 15; 
    }

    .btn-login:hover {
        background: #007bff;
        color: white;
        box-shadow: 0 5px 20px rgba(0, 123, 255, 0.3);
    }

    body {
        margin: 0;
        font-family: "Poppins", sans-serif;
        background-color: #fff;
    }

    /* --- Hero principal --- */
    .hero {
        background: url("{{ asset('img/Casa.jpg') }}") center top / cover no-repeat;
        height: 92vh; /* antes 100vh — la bajamos un poco */
        position: relative;
        color: white;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        margin-bottom: -50px; /* antes -100vh — reduce espacio blanco */
    }
    .hero::before {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.55);
        z-index: 1;
    }
    .hero-content {
        position: relative;
        z-index: 2;
        margin-top: -60px;
        pointer-events: auto;
    }

    /* --- Navegación --- */
    .nav-custom {
        position: absolute;
        top: 40px;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(8px);
        border-radius: 40px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
        padding: 10px 40px;
        display: flex;
        justify-content: center;
        gap: 50px;
        font-size: 1.1rem;
        z-index: 10;
    }

    .nav-custom a {
        color: #333;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.3s;
    }

    .nav-custom a:hover {
        color: #007bff;
    }

    /* --- Barra de búsqueda --- */
    .search-box {
        background: #fff;
        border-radius: 50px;
        padding: 15px 25px;
        display: flex;
        align-items: center;
        gap: 15px;
        max-width: 850px;
        margin: 50px auto 0;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .search-box:hover {
        transform: scale(1.02);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
    }

    .search-box select,
    .search-box input {
        border: none;
        outline: none;
        font-size: 1rem;
        padding: 12px 18px;
        border-radius: 30px;
        background: #f8f8f8;
        flex: 1;
    }

    .search-box select {
        flex: 0.4;
    }

    .search-box button {
        background: #007bff;
        border: none;
        color: white;
        padding: 12px 25px;
        border-radius: 30px;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .search-box button:hover {
        background: #0056b3;
    }

    h1 {
        font-size: 2.8rem;
        margin-bottom: 15px;
    }

    /* --- Footer --- */
    /* --- Footer Moderno --- */
    footer {
    width: 100%;
    background: #ffffff;
    color: #333;
    font-size: 0.9rem;
    border-top: 1px solid rgba(0, 0, 0, 0.08);
    padding: 40px 80px 15px;
    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
    }

    .footer-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 40px;
        align-items: start;
        margin-bottom: 25px;
    }

    .footer-col h4 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #000;
        margin-bottom: 15px;
    }

    .footer-col p {
        color: #555;
        line-height: 1.6;
    }

    .footer-col ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-col ul li {
        margin-bottom: 8px;
        color: #555;
    }

    .footer-col ul li a {
        color: #007bff;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer-col ul li a:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    .social-icons a {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 35px;
        height: 35px;
        background: #f5f5f5;
        border-radius: 50%;
        color: #333;
        font-size: 1.1rem;
        margin-right: 10px;
        transition: all 0.3s ease;
    }

    .social-icons a:hover {
        background: #007bff;
        color: #fff;
        transform: translateY(-2px);
    }

    .footer-bottom {
        text-align: center;
        font-size: 0.85rem;
        color: #777;
        padding-top: 15px;
        border-top: 1px solid rgba(0, 0, 0, 0.08);
    }

    </style>
</head>
<body>

    <!-- Barra de navegación -->
    <nav class="nav-custom">
        <a href="#">Arriendo</a>
        <a href="#">Venta</a>
        <a href="#">Inmobiliarias</a>
    </nav>

    <!-- Botón de inicio de sesión -->
    <a href="#" class="btn-login">Iniciar sesión</a>

    <!-- Sección principal -->
    <section class="hero">
        <div class="hero-content">
            <h1 class="fw-bold display-5">Lo mejor de buscar es encontrar</h1>
            <div class="search-box">
                <select>
                    <option>Casa</option>
                    <option>Apartamento</option>
                    <option>Lote</option>
                    <option>Oficina</option>
                </select>
                <input type="text" placeholder="Busca por ubicación o palabra clave">
                <button><i class="fas fa-search"></i> Buscar</button>
            </div>
        </div>
    </section>

    <!-- Footer -->
<footer>
    <div class="footer-container">
        <div class="footer-col">
            <h4>Inmobiliarias</h4>
            <p>Conectamos personas y empresas con las mejores oportunidades inmobiliarias en tu ciudad.</p>
        </div>

        <div class="footer-col">
            <h4>Enlaces</h4>
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Arriendo</a></li>
                <li><a href="#">Venta</a></li>
                <li><a href="#">Inmobiliarias</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Contacto</h4>
            <ul>
                <li>📍 +57 322 217 5412</li>
                <li>📞 +57 313 341 8457</li>
                <li>📧 inmobiraSA@gmail.com</li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Síguenos</h4>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>© 2025 Inmobira. Todos los derechos reservados.</p>
    </div>
</footer>

<script src="https://kit.fontawesome.com/a2e0a6e6a5.js" crossorigin="anonymous"></script>
<script>
(function(){
    const hero = document.querySelector('.hero');
    if(!hero) return;

    // porcentaje actual (0 - 100)
    let pos = 0;
    // cuanto se desplaza por "tick" (ajusta si quieres más/menos sensibilidad)
    const STEP = 4;

    // inicializa posición
    hero.style.backgroundPosition = `center ${pos}%`;

    // rueda del mouse — bloqueamos el scroll del documento cuando estamos sobre el hero
    hero.addEventListener('wheel', function(e){
        e.preventDefault(); // evita scroll de la página
        pos += (e.deltaY > 0) ? STEP : -STEP;
        pos = Math.max(0, Math.min(100, pos));
        hero.style.backgroundPosition = `center ${pos}%`;
    }, { passive: false });

    // soporte táctil — para móviles: arrastrar verticalmente
    let startY = null;
    hero.addEventListener('touchstart', function(e){
        startY = e.touches[0].clientY;
    }, { passive: true });

    hero.addEventListener('touchmove', function(e){
        if(startY === null) return;
        const currentY = e.touches[0].clientY;
        const diff = startY - currentY;
        // solo si el movimiento es significativo
        if(Math.abs(diff) > 8){
        pos += (diff > 0) ? STEP : -STEP;
        pos = Math.max(0, Math.min(100, pos));
        hero.style.backgroundPosition = `center ${pos}%`;
        startY = currentY;
        }
        e.preventDefault();
    }, { passive: false });

    // opcional: permitir control por teclas flecha arriba/abajo
    window.addEventListener('keydown', function(e){
        if(e.key === 'ArrowDown'){ pos = Math.min(100, pos + STEP); hero.style.backgroundPosition = `center ${pos}%`; }
        if(e.key === 'ArrowUp'){ pos = Math.max(0, pos - STEP); hero.style.backgroundPosition = `center ${pos}%`; }
    });

})();
</script>

</body>
</html>