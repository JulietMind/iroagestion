<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Iroa Gestión</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&family=Playfair+Display:ital,wght@0,600;1,600&display=swap" rel="stylesheet">
<style>
/* --- VARIABLES Y RESET --- */
:root { --bg-body: #0f172a; --bg-card: #1e293b; --primary: #d4af37; --text-main: #f1f5f9; --text-muted: #94a3b8; }
* { margin: 0; padding: 0; box-sizing: border-box; }
body { font-family: 'Inter', sans-serif; background: var(--bg-body); color: var(--text-main); margin: 0; padding-top: 80px; }
a { text-decoration: none; color: inherit; transition: 0.3s; }
ul { list-style: none; margin: 0; padding: 0; }

/* --- HEADER GLOBAL --- */
header { position: fixed; top: 0; width: 100%; background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(10px); z-index: 1000; border-bottom: 1px solid rgba(255,255,255,0.05); }
.container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
nav { display: flex; justify-content: space-between; align-items: center; height: 80px; }

/* Logo */
.logo { font-size: 1.5rem; font-weight: 800; color: white; display: flex; align-items: center; gap: 10px; }
.logo img { height: 50px; width: auto; }

/* ENLACES DE NAVEGACIÓN (Fusión de escritorio y móvil para evitar conflictos) */
.nav-links { display: flex; gap: 30px; margin: 0; padding: 0; }
.nav-links a { color: var(--text-muted); font-weight: 500; cursor: pointer; }
.nav-links a:hover { color: var(--primary); }

/* Botones del header (Login/Admin) */
.nav-actions { display: flex; gap: 15px; align-items: center; }

/* Botones globales */
.btn { display: inline-block; padding: 10px 20px; border-radius: 50px; border: none; font-weight: 600; cursor: pointer; transition: 0.3s; background: var(--primary); color: #000; text-align: center; }
.btn:hover { box-shadow: 0 0 15px rgba(212, 175, 55, 0.4); }
.btn-outline { background: transparent; border: 2px solid var(--primary); color: var(--primary); }
.btn-outline:hover { background: var(--primary); color: black; }

/* --- BOTÓN MÓVIL (☰) --- */
.mobile-menu-btn {
    display: none; /* Oculto en escritorio por defecto */
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.2);
    color: white;
    font-size: 1.8rem;
    cursor: pointer;
    padding: 5px 15px;
    border-radius: 4px;
    transition: 0.3s;
}
.mobile-menu-btn:hover { background: rgba(255,255,255,0.2); }

/* --- ESTILOS HERO PRO Y GENERALES --- */
.hero-pro { position: relative; padding: 140px 0 80px; overflow: hidden; min-height: 80vh; display: flex; align-items: center; background: radial-gradient(circle at 70% 20%, rgba(212, 175, 55, 0.08) 0%, transparent 50%), linear-gradient(to bottom, #0f172a, #0b1120); }
.hero-content { display: grid; grid-template-columns: 1fr 1fr; align-items: center; gap: 60px; position: relative; z-index: 2; }
.hero-text h1 { font-size: 3.8rem; line-height: 1.1; margin-bottom: 30px; font-weight: 800; background: linear-gradient(135deg, #fff, #cbd5e1); -webkit-background-clip: text; background-clip: text; color: transparent; }
.hero-text p { font-size: 1.25rem; color: var(--text-muted); margin-bottom: 40px; max-width: 550px; }
.hero-visual { position: relative; height: 500px; display: flex; align-items: center; justify-content: center; perspective: 1000px; }
.hero-img-main { width: 100%; height: 100%; object-fit: cover; border-radius: 24px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); border: 1px solid rgba(255,255,255,0.08); transform: translateY(0); transition: transform 0.5s ease; }
.hero-pro:hover .hero-img-main { transform: translateY(-10px); }
.hero-card-deco { position: absolute; top: -20px; right: -20px; width: 100%; height: 100%; border: 2px solid rgba(212, 175, 55, 0.2); border-radius: 24px; z-index: -1; }
.stat-card { position: absolute; bottom: 50px; left: -40px; background: rgba(30, 41, 59, 0.9); backdrop-filter: blur(12px); padding: 20px 30px; border-radius: 16px; border: 1px solid rgba(255,255,255,0.1); width: 200px; z-index: 3; box-shadow: 0 10px 30px rgba(0,0,0,0.3); animation: floatCard 4s ease-in-out infinite; }
@keyframes floatCard { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }

/* --- TARJETAS DE PROYECTOS --- */
.project-card { background: var(--bg-card); border-radius: 16px; overflow: hidden; border: 1px solid rgba(255,255,255,0.05); transition: 0.3s; display: flex; flex-direction: column; height: 100%; }
.project-card:hover { transform: scale(1.02); }
.card-image-wrapper { position: relative; height: 220px; overflow: hidden; }
.card-image-wrapper img { width: 100%; height: 100%; object-fit: cover; }
.card-badge { position: absolute; top: 15px; left: 15px; background: rgba(0,0,0,0.6); backdrop-filter: blur(8px); color: var(--primary); padding: 6px 12px; border-radius: 6px; font-size: 0.75rem; font-weight: 700; }
.card-body { padding: 25px; flex-grow: 1; display: flex; flex-direction: column; }
.project-title { font-size: 1.25rem; font-weight: 700; color: white; margin: 0 0 10px; }
.project-location { display: flex; align-items: center; gap: 6px; color: var(--text-muted); font-size: 0.85rem; margin-bottom: 20px; }
.metrics-grid { display: grid; grid-template-columns: 1fr 1fr 1fr; background: rgba(0,0,0,0.2); border-radius: 12px; padding: 15px; margin-bottom: 20px; border: 1px solid rgba(255,255,255,0.03); }
.metric { text-align: center; border-right: 1px solid rgba(255,255,255,0.05); }
.metric:last-child { border-right: none; }
.metric-label { display: block; font-size: 0.65rem; color: var(--text-muted); text-transform: uppercase; margin-bottom: 4px; }
.metric-value { display: block; font-size: 1rem; font-weight: 700; color: white; }
.metric-value.gold { color: var(--primary); }
.progress-section { margin-top: auto; }
.progress-header { display: flex; justify-content: space-between; font-size: 0.8rem; color: var(--text-muted); margin-bottom: 8px; }
.progress-track { width: 100%; height: 6px; background: rgba(255,255,255,0.1); border-radius: 4px; overflow: hidden; }
.progress-fill { height: 100%; background: linear-gradient(90deg, var(--primary), #FCD34D); width: 0%; }
.card-btn { margin-top: 20px; width: 100%; background: linear-gradient(135deg, var(--primary), #b5952f); color: #000; font-weight: 700; border: none; padding: 12px; border-radius: 8px; cursor: pointer; display: flex; justify-content: center; align-items: center; gap: 8px; }

/* --- SECCIONES DE CONTENIDO --- */
.section-padding { padding: 80px 0; }
.methodology-section { padding: 100px 0; background: linear-gradient(to bottom, #0b1120, #0f172a); }
.process-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-top: 50px; }
.process-step { position: relative; padding: 30px; border-top: 1px solid rgba(255,255,255,0.1); }
.process-step::before { content: '0' + counter(step-counter); position: absolute; top: -20px; left: 0; font-size: 3rem; font-weight: 800; color: rgba(212, 175, 55, 0.2); font-family: 'Playfair Display', serif; }
.step-title { font-size: 1.4rem; font-weight: 700; color: white; margin-bottom: 15px; margin-top: 10px; font-family: 'Inter', sans-serif; }
.step-desc { color: var(--text-muted); line-height: 1.7; }

/* --- CONTACT CTA --- */
.contact-cta { padding: 100px 0; position: relative; overflow: hidden; text-align: center; }
.cta-glow { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 600px; height: 600px; background: radial-gradient(circle, rgba(212, 175, 55, 0.15) 0%, transparent 70%); z-index: 0; }
.cta-content { position: relative; z-index: 1; max-width: 600px; margin: 0 auto; }
.cta-box { background: rgba(30, 41, 59, 0.6); backdrop-filter: blur(15px); padding: 50px; border-radius: 20px; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 20px 50px rgba(0,0,0,0.3); }
.cta-input { width: 100%; padding: 15px 20px; border-radius: 50px; border: 1px solid rgba(255,255,255,0.2); background: rgba(15, 23, 42, 0.8); color: white; margin-bottom: 15px; outline: none; transition: 0.3s; }
.cta-input:focus { border-color: var(--primary); box-shadow: 0 0 15px rgba(212, 175, 55, 0.2); }

/* --- FOOTER --- */
footer { padding: 60px 0 20px; border-top: 1px solid rgba(255,255,255,0.05); text-align: center; color: var(--text-muted); font-size: 0.9rem; background: #0b1120; }

/* --- RESPONSIVE (MÓVIL) --- */
@media(max-width: 900px) {
    .hero-content { grid-template-columns: 1fr; text-align: center; gap: 60px; }
    .hero-text h1 { font-size: 2.8rem; }
    .hero-actions { justify-content: center; }
    .hero-visual { height: 400px; margin-top: 40px; }

    /* MENÚ MÓVIL: Aseguramos que la lógica de escritorio no interfiera */
    .nav-links {
        display: none;
        position: absolute;
        top: 80px;
        left: 0;
        width: 100%;
        background: #0f172a;
        flex-direction: column;
        padding: 20px;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        z-index: 999;
        text-align: center;
    }

    /* Esta es la clase clave que hará aparecer el menú */
    .nav-links.active {
        display: flex !important;
        flex-direction: column;
    }

    /* Ocultar botones grandes */
    .nav-actions .btn { display: none; }

    /* Asegurar que el botón móvil esté presente */
    .mobile-menu-btn {
        display: block !important;
    }
}
</style>
</head>
<body>

<header>
<div class="container">
<nav>
<a href="index.php" class="logo">
<img src="https://z-cdn-media.chatglm.cn/files/25712ad8-87b4-42f4-a0fe-89352f5b583f.jpg?auth_key=1868784953-eeade0e70eb94f768c345d3ef2e48c50-0-ec6c7371f7d633278686edf25fa96038" alt="Logo">
</a>

<!-- ID IMPORTANTE: main-nav -->
<ul id="main-nav" class="nav-links">
<li><a href="index.php">Inicio</a></li>
<li><a href="oportunidades.php">Oportunidades</a></li>
<li><a href="sobre-nosotros.php">Sobre nosotros</a></li>
<li><a href="blog.php">Blog</a></li>
</ul>

<div class="nav-actions">
<a href="#" style="color:white; margin-right:10px;">Iniciar Sesión</a>
<a href="gestion.php" class="btn">⚙️ Acceso Gestión</a>
<!-- Este es el botón que hace falta -->
<button class="mobile-menu-btn">☰</button>
</div>
</nav>
</div>
</header>

<!-- Cargar JS aquí mismo para garantizar que funcione -->
<script src="backend.js"></script>

<!-- SCRIPT DE MENÚ AL FINAL DE BODY -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const menuBtn = document.querySelector('.mobile-menu-btn');
    const navList = document.getElementById('main-nav');

    // Si el botón no existe, el script fallará antes de intentar añadir evento
    if (menuBtn && navList) {
        menuBtn.addEventListener('click', () => {
            navList.classList.toggle('active');
            console.log("Menú pulsado. Clase actual:", navList.className);
        });
    } else {
        console.error("Error: No se encontró el botón o el menú.");
    }
});
</script>
