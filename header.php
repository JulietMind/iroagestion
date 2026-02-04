<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Iroa Gestión</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&family=Playfair+Display:ital,wght@0,600;1,600&display=swap" rel="stylesheet">
<style>
/* --- VARIABLES Y RESET --- */
:root { --bg-body: #0f172a; --primary: #d4af37; --bg-card: #1e293b; --text-main: #f1f5f9; --text-muted: #94a3b8; }
* { margin: 0; padding: 0; box-sizing: border-box; }
body { font-family: 'Inter', sans-serif; background: var(--bg-body); color: var(--text-main); margin: 0; padding-top: 80px; }
a { text-decoration: none; color: inherit; transition: 0.3s; }
ul { list-style: none; margin: 0; padding: 0; }
img { max-width: 100%; height: auto; display: block; object-fit: cover; }

/* --- HEADER GLOBAL --- */
header { position: fixed; top: 0; width: 100%; background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(10px); z-index: 1000; border-bottom: 1px solid rgba(255,255,255, 0.05); }
.container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
nav { display: flex; justify-content: space-between; align-items: center; height: 80px; }

/* Logo */
.logo { font-size: 1.5rem; font-weight: 800; color: white; display: flex; align-items: center; gap: 10px; }
.logo img { height: 50px; width: auto; }

/* Enlaces Desktop */
.nav-links { display: flex; gap: 30px; margin: 0; padding: 0; }
.nav-links a { color: var(--text-muted); font-weight: 500; cursor: pointer; }
.nav-links a:hover { color: var(--primary); }
.nav-links a.active { color: white; font-weight: 700; }

/* Botones Header */
.nav-actions { display: flex; gap: 15px; align-items: center; }
.btn { display: inline-block; padding: 10px 20px; border-radius: 50px; border: none; font-weight: 600; cursor: pointer; transition: 0.3s; background: var(--primary); color: #000; text-align: center; }
.btn:hover { box-shadow: 0 0 15px rgba(212, 175, 55, 0.4); }
.btn-outline { background: transparent; border: 2px solid var(--primary); color: var(--primary); }
.btn-outline:hover { background: var(--primary); color: black; }

/* --- BOTÓN MÓVIL (☰) --- */
.mobile-menu-btn {
    display: none; /* Oculto en escritorio por defecto */
    background: rgba(255, 255, 255, 0.1);
    color: white;
    font-size: 1.8rem;
    border: 1px solid rgba(255, 255, 255, 0.2);
    cursor: pointer;
    padding: 5px 12px;
    border-radius: 4px;
}

/* --- NAV MENÚS (Responsiva) --- */
/* Oculto el menú principal en móvil por defecto, pero cuando se activa se superpone encima de todo */
.nav-menu {
    display: none; /* Oculto por defecto en desktop y móvil */
    position: absolute;
    top: 80px; /* Justo debajo del header */
    left: 0;
    width: 100%;
    background: #0f172a; /* Fondo sólido oscuro para que el texto sea legible */
    border-bottom: 1px solid rgba(255,255,255,0.1);
    padding: 20px;
    z-index: 1001; /* Z-index muy alto para que tape encima del footer */
    box-shadow: 0 10px 30px rgba(0, 0,0,0.3);
    display: flex; /* Flex para icono y lista */
    flex-direction: column;
    animation: slideDown 0.4s ease-out;
}

/* Clase para mostrar el menú (se añade con JS) */
.nav-menu.active { display: flex; }

@keyframes slideDown {
    from { transform: translateY(-20px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

/* --- ESTILOS PRO HERO PRO --- */

/* 1. Container Hero Pro */
.hero-pro { position: relative; padding: 120px 0 80px; overflow: hidden; min-height: 90vh; display: flex; align-items: center; background: radial-gradient(circle at 70% 20%, rgba(212, 175, 55, 0.08) 0%, transparent 50%), linear-gradient(to bottom, #0f172a, #0b1120); }

/* 2. Contenido (Texto + Imagen) */
.hero-content {
    display: flex; /* LIMPIEZA: Usa Flexbox para controlar la disposición */
    flex-direction: row; /* Fila única por defecto: Texto a la izquierda, Imagen a la derecha */
    align-items: center;
    gap: 60px;
    position: relative;
    z-index: 10; /* Para el elemento decorativo (Globo) */
}

/* 3. Texto (Izquierda) */
.hero-text { text-align: center; z-index: 20; }
.hero-text h1 { font-size: 3.8rem; margin-bottom: 15px; background: linear-gradient(to right, #fff, #cbd5e1); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
.hero-text p { font-size: 1.2rem; color: var(--text-muted); margin-bottom: 30px; max-width: 600px; }
.hero-buttons { display: flex; gap: 15px; justify-content: center; }

/* 4. Imagen (Derecha) */
.hero-visual {
    position: relative;
    width: 100%;
    /* Max-width para evitar que la imagen ocupe el menú o el footer */
    max-width: 600px;
    height: auto;
    /* Asegúramos altura para que la imagen nunca se vea cortada */
    min-height: 400px;

    display: flex; justify-content: center;
    align-items: center; /* Centrar contenido interno (Imagen + Tarjeta) */
}

/* La imagen principal */
.hero-img-main {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Cubrir el contenedor */
    border-radius: 24px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    border: 1px solid rgba(255,255,255,0.08);
}

/* Elemento decorativo del fondo */
.hero-card-deco {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    border: 2px solid rgba(212, 175, 55, 0.2);
    border-radius: 24px;
    z-index: -1; /* Detrás de la imagen */
}

/* 5. Tarjeta Flotante (Hero Card Visual) */
.hero-card-visual {
    /* Relativo al contenedor visual */
    position: relative;
    z-index: 5; /* Encima del resto del cuerpo */

    width: 200px; /* Ancho fijo para el botón */
    min-height: 200px; /* Altura mínima para verse bien */
    background: rgba(30, 41, 59, 0.9);
    backdrop-filter: blur(12px);
    padding: 20px;
    border-radius: 50%;
    border: 1px solid rgba(255,255,255,0.1);

    display: flex; align-items: center; justify-content: center;
    gap: 20px;

    margin-bottom: 50px; /* Despegado visualmente del texto */
}

.stat-icon { width: 50px; height: 50px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: black; font-size: 1.5rem; }
.stat-info h4 { margin: 0; font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; }
.stat-info p { margin-top: 5px; font-weight: bold; color: white; font-size: 1.1rem; }

.hero-content .btn { width: 100%; margin-top: auto; }

/* --- RESPONSIVE (Media Queries) --- */
@media(max-width: 900px) {
    /* En pantallas pequeñas: apila la estructura para evitar descuadre */
    .hero-content {
        flex-direction: column; /* Pila texto sobre imagen */
        text-align: center;
        gap: 40px;
    }

    /* Ajustamos el visual (Imagen y Tarjeta) para móviles */
    .hero-visual {
        width: 300px; /* Reducimos tamaño en móvil */
        margin-top: 30px;
    }
    .hero-img-main {
        width: 100%;
        height: auto;
        max-height: 300px; /* Limitamos altura */
    }
    .hero-card-visual {
        width: 300px;
        height: 240px; /* Altura reducida para móvil */
        margin: 0 auto; /* Reset margin negativo del escritorio */
        position: relative;
    }

    /* Ajustamos la tarjeta flotante (Botón + Estadísticas) */
    .hero-card-visual {
        position: absolute;
        /* Posición relativa no debe afectar al centrado del padre visual */
        bottom: -20px;
        /* El JS lo centrará, no necesita CSS absoluto si el padre es flex centrado */
        max-width: 300px;
        z-index: 10;
    }
}
</style>
</head>

<body>

<header>
<div class="container">
<nav>
<!-- Logo -->
<a href="index.php" class="logo">
<img src="https://z-cdn-media.chatglm.cn/files/25712ad8-87b4-42f4-a0fe-89352f5b583f.jpg?auth_key=1868784953-eeade0e70eb94f768c345d3ef2e48c50-0-ec6c7371f7d633278686edf25fa96038" alt="Logo">
</a>

<!-- Enlaces (Desktop) -->
<ul id="main-nav" class="nav-links">
<li><a href="index.php">Inicio</a></li>
<li><a href="oportunidades.php">Oportunidades</a></li>
<li><a href="sobre-nosotros.php">Sobre Nosotros</a></li>
<li><a href="blog.php">Blog</a></li>
</ul>

<!-- Acciones -->
<div class="nav-actions">
<a href="#" style="color:white; margin-right:10px;">Iniciar Sesión</a>
<a href="gestion.php" class="btn">⚙️ Acceso Gestión</a>
<button class="mobile-menu-btn">☰</button>
</div>
</nav>
</div>

<!-- Menú Móvil (Oculto por defecto) -->
<div id="main-nav" class="nav-menu">
<div style="text-align: center; padding: 20px;">
<a href="index.php" style="color:white; font-size: 1.5rem; font-weight: 700;">Inicio</a><br>
<a href="oportunidades.php" style="color: #94a3b8; text-decoration: none; margin-bottom: 10px; display:block;">Oportunidades</a><br>
<a href="blog.php" style="color: #94a3b8; text-decoration: none; display:block;">Blog</a>
<br><a href="gestion.php" style="color: var(--primary); font-weight: 600; text-decoration: none; display: block;">Zona Admin</a>
</div>
</div>

<!-- Botón para cerrar el menú móvil -->
<button id="close-menu-btn" style="
position: fixed; top: 90px; left: 20px; z-index: 1002;
background: rgba(255, 0, 0, 0.2); color: white; border: 1px solid white;
padding: 5px 10px; border-radius: 20px; cursor: pointer; display: none; box-shadow: 0 4px 10px rgba(0,0,0,0.3);">
X
</button>
</header>

<main>
<!-- HERO SECTION PRO -->
<section class="hero-pro">
<div class="hero-bg"></div>
<div class="hero-content">
<!-- 1. Texto -->
<div class="hero-text">
<h1>Inversión Inmobiliaria <span style="color:var(--primary)">Inteligente</span></h1>
<p>Gestiona tus activos con seguridad y rentabilidad en una plataforma diseñada para el inversor moderno.</p>
<div class="hero-buttons">
<a href="oportunidades.php" class="btn">Ver Oportunidades</a>
<a href="sobre-nosotros.php" class="btn btn-outline">Saber Más</a>
</div>

<!-- Métricas Rápidas -->
<div style="display: flex; gap: 40px; margin-top: 60px; padding-top: 30px; border-top: 1px solid rgba(255,255,255,0.1);">
<div>
<div style="font-size: 2rem; font-weight: 800; color: white;">€45M+</div>
<div style="font-size: 0.9rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px;">Activos Gestionados</div>
</div>
<div>
<div style="font-size: 2rem; font-weight: 800; color: white;">12%</div>
<div style="font-size: 0.9rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px;">Rentabilidad Media</div>
</div>
</div>
</div>

<!-- 2. Imagen + Tarjeta (Derecha) -->
<div class="hero-visual">
<!-- Imagen Principal -->
<img src="https://picsum.photos/seed/building9/600/700" alt="Edificio Moderno" class="hero-img-main">

<!-- Tarjeta Flotante -->
<div class="hero-card-visual">
<div class="stat-card">
<div class="hero-icon-circle">✓</div>
<div class="stat-info">
<div style="font-size: 0.7rem; color: var(--text-muted);">ESTADO</div>
<div style="font-weight: bold; color: white;">Activo</div>
</div>
</div>
</div>
</div>
</div>
</section>
</main>

<!-- Script del Menú (Funcional) -->
<script src="backend.js"></script>
<script>
// Lógica para el menú móvil
const menuBtn = document.querySelector('.mobile-menu-btn');
const closeMenuBtn = document.getElementById('close-menu-btn');
const mainNav = document.getElementById('main-nav');

if (menuBtn && mainNav) {
    menuBtn.addEventListener('click', () => {
        // Toggle Clase .nav-menu
        mainNav.classList.toggle('active');
    });
}

if (closeMenuBtn && mainNav) {
    closeMenuBtn.addEventListener('click', () => {
        // Forzar cierre quitamos la clase
        mainNav.classList.remove('active');
    });
}
</script>
