<?php include 'header.php'; ?>
<script src="backend.js"></script>

<!-- HERO SECTION PRO -->
<section class="hero-pro">
<div class="hero-bg"></div>
<div class="hero-pattern"></div>
<div class="hero-glow"></div>

<div class="container">
<div class="hero-content">
<!-- Texto -->
<div class="hero-text">
<h1>Inversión Inmobiliaria <span style="color:var(--primary)">Inteligente</span></h1>
<p>Gestiona tus activos con seguridad y rentabilidad en una plataforma diseñada para el inversor moderno.</p>
<div style="display: flex; gap: 15px;">
<a href="oportunidades.php" class="btn">Ver Oportunidades</a>
<a href="sobre-nosotros.php" class="btn btn-outline">Saber Más</a>
</div>

<!-- Métricas rápidas -->
<div style="display: flex; gap: 40px; margin-top: 50px; padding-top: 30px; border-top: 1px solid rgba(255,255,255,0.05);">
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

<!-- Visual -->
<div class="hero-card-visual">
<div class="hero-card-deco"></div>
<!-- Imagen de fondo estilo arquitectura abstracta -->
<img src="https://picsum.photos/seed/building9/600/700" alt="Edificio Moderno" class="hero-img">

<!-- Tarjeta flotante sobre la imagen -->
<div style="position: absolute; bottom: -30px; left: -30px; background: rgba(30, 41, 59, 0.9); backdrop-filter: blur(10px); padding: 20px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.1); width: 200px; z-index: 3; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
<div style="display: flex; align-items: center; gap: 10px;">
<div style="width: 40px; height: 40px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: black;">✓</div>
<div>
<div style="font-size: 0.7rem; color: var(--text-muted);">ESTADO</div>
<div style="font-weight: bold; color: white;">Activo</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>

<!-- SECCIÓN DESTACADOS (Simplificada y elegante) -->
<section style="padding: 80px 0; background: #0b1120;">
<div class="container">
<div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 40px;">
<div>
<h2 style="color: white; font-family: 'Playfair Display', serif; font-size: 2rem; margin: 0;">Oportunidades Recientes</h2>
<p style="color: var(--text-muted); margin-top: 10px;">Seleccionadas por nuestros expertos</p>
</div>
<a href="oportunidades.php" style="color: var(--primary); font-weight: 600;">Ver todo el catálogo &rarr;</a>
</div>
<!-- Grid cargado por JS -->
<div id="featured-grid" class="project-grid"></div>
</div>
</section>

<?php include 'footer.php'; ?>
