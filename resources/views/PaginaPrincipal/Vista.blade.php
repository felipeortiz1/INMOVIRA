<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Inmobiliarias</title>
    <style>
/* ===== Estilos Generales ===== */
body {
    margin: 0;
    font-family: "Poppins", sans-serif;
    background-color: #fff;
    color: #222;
    scroll-behavior: smooth;
}

/* ===== Navbar ===== */
.nav-custom {
    position: absolute;
    top: 35px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(10px);
    border-radius: 50px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    padding: 12px 45px;
    display: flex;
    justify-content: center;
    gap: 60px;
    font-size: 1.1rem;
    z-index: 10;
    transition: all 0.3s ease;
}

.nav-custom:hover {
    background: rgba(255, 255, 255, 0.95);
    transform: translateX(-50%) scale(1.02);
}

.nav-custom a {
    color: #333;
    font-weight: 600;
    text-decoration: none;
    position: relative;
}

.nav-custom a::after {
    content: "";
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 0;
    height: 2px;
    background: #007bff;
    transition: width 0.3s ease;
}

.nav-custom a:hover::after {
    width: 100%;
}

.nav-custom a:hover {
    color: #007bff;
}

/* ===== Botón de inicio de sesión ===== */
.btn-login {
    position: absolute;
    top: 55px;
    right: 90px;
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: #fff;
    font-weight: 600;
    padding: 10px 28px;
    border-radius: 50px;
    text-decoration: none;
    box-shadow: 0 3px 15px rgba(0, 123, 255, 0.4);
    transition: all 0.3s ease;
    z-index: 15;
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(0, 123, 255, 0.5);
}

/* ===== Hero ===== */
.hero {
    background: url("{{ asset('img/Casa.jpg') }}") center center / cover no-repeat;
    height: 100vh;
    position: relative;
    color: white;
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.hero::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.55);
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 2;
    max-width: 850px;
    padding: 0 15px;
    animation: fadeIn 1.5s ease-in-out;
}

.hero-content h1 {
    font-size: 3rem;
    margin-bottom: 25px;
    font-weight: 700;
    text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

/* ===== Barra de búsqueda ===== */
.search-box {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 50px;
    padding: 15px 25px;
    display: flex;
    align-items: center;
    gap: 15px;
    max-width: 850px;
    margin: 30px auto 0;
    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.search-box:hover {
    transform: scale(1.02);
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.25);
}

.search-box select,
.search-box input {
    border: none;
    outline: none;
    font-size: 1rem;
    padding: 12px 18px;
    border-radius: 30px;
    background: #f3f6f9;
    flex: 1;
    color: #333;
}

.search-box select {
    flex: 0.4;
}

.search-box button {
    background: linear-gradient(135deg, #007bff, #0056b3);
    border: none;
    color: white;
    padding: 12px 28px;
    border-radius: 30px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s;
}

.search-box button:hover {
    background: #0048a3;
    transform: translateY(-2px);
}

/* ===== Footer ===== */
footer {
    background: #f8f9fa;
    color: #333;
    font-size: 0.95rem;
    padding: 60px 80px 25px;
    box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.06);
    border-top: 3px solid #007bff;
}

.footer-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
    gap: 40px;
    align-items: flex-start;
    margin-bottom: 35px;
}

.footer-col h4 {
    font-size: 1.2rem;
    font-weight: 700;
    color: #007bff;
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
    margin-bottom: 10px;
    color: #444;
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

/* ===== Redes Sociales ===== */
.social-icons a {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    width: 38px;
    height: 38px;
    background: #ffffff;
    border-radius: 50%;
    color: #007bff;
    font-size: 1.2rem;
    margin-right: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.social-icons a:hover {
    background: #007bff;
    color: #fff;
    transform: translateY(-3px);
}

/* ===== Footer Inferior ===== */
.footer-bottom {
    text-align: center;
    font-size: 0.85rem;
    color: #777;
    padding-top: 20px;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
}

/* ===== Animaciones ===== */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

</head>
<body>

    <!-- Barra de navegación -->
    <nav class="nav-custom">
        <a href="{{ route('vista.arriendo') }}">Arriendo</a>
        <a href="{{ route('vista.venta') }}">Venta</a>
        <a href="{{ route('vista.inmobiliarias') }}">Inmobiliarias</a>

    </nav>

    <!-- Botón de inicio de sesión -->
    <a href="{{ route('login') }}" class="btn-login">Iniciar sesión</a>

    <!-- Sección principal -->
    <section class="hero">
        <div class="hero-content">
            <h1 class="fw-bold display-5">Lo mejor de buscar es encontrar</h1>

            <!-- FORMULARIO CORREGIDO -->
            <form action="{{ route('buscador.inmuebles') }}" method="GET" class="search-box">

                <!-- Filtro por tipo de inmueble -->
                <select name="tipo">
                    <option value="">Tipo de inmueble</option>
                    <option value="Casa" {{ request('tipo') == 'Casa' ? 'selected' : '' }}>Casa</option>
                    <option value="Apartamento" {{ request('tipo') == 'Apartamento' ? 'selected' : '' }}>Apartamento</option>
                    <option value="Lote" {{ request('tipo') == 'Lote' ? 'selected' : '' }}>Lote</option>
                    <option value="Oficina" {{ request('tipo') == 'Oficina' ? 'selected' : '' }}>Oficina</option>
                </select>

                <!-- Palabras clave -->
                <input 
                    type="text" 
                    name="barrio" 
                    placeholder="Buscar por municipio, nombre..."
                    value="{{ request('barrio') }}"
                >


                <!-- Botón -->
                <button type="submit">
                    <i class="fas fa-search"></i> Buscar
                </button>
            </form>

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
                <a href=""><i class="fab fa-facebook-f"></i></a>
                <a href=""><i class="fab fa-instagram"></i></a>
                <a href=""><i class="fab fa-twitter"></i></a>
                <a href=""><i class="fab fa-linkedin-in"></i></a>
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

    let pos = 0;
    const STEP = 4;

    hero.style.backgroundPosition = `center ${pos}%`;

    hero.addEventListener('wheel', function(e){
        e.preventDefault();
        pos += (e.deltaY > 0) ? STEP : -STEP;
        pos = Math.max(0, Math.min(100, pos));
        hero.style.backgroundPosition = `center ${pos}%`;
    }, { passive: false });

    let startY = null;
    hero.addEventListener('touchstart', function(e){
        startY = e.touches[0].clientY;
    }, { passive: true });

    hero.addEventListener('touchmove', function(e){
        if(startY === null) return;
        const currentY = e.touches[0].clientY;
        const diff = startY - currentY;

        if(Math.abs(diff) > 8){
            pos += (diff > 0) ? STEP : -STEP;
            pos = Math.max(0, Math.min(100, pos));
            hero.style.backgroundPosition = `center ${pos}%`;
            startY = currentY;
        }
        e.preventDefault();
    }, { passive: false });

    window.addEventListener('keydown', function(e){
        if(e.key === 'ArrowDown'){ pos = Math.min(100, pos + STEP); hero.style.backgroundPosition = `center ${pos}%`; }
        if(e.key === 'ArrowUp'){ pos = Math.max(0, pos - STEP); hero.style.backgroundPosition = `center ${pos}%`; }
    });

})();
</script>

</body>
</html>
