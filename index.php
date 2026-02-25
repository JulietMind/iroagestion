<?php include 'header.php'; ?>

<main>
<!-- HERO SECTION MEJORADO -->
<section class="hero-pro">
<div class="container">
<div class="hero-content">
<!-- Texto Izquierda -->
<div class="hero-text">
<h1>Inversión Inmobiliaria <span style="color:var(--primary)">Inteligente</span></h1>
<p>Invierte en activos con viabilidad y rentabilidad en una plataforma diseñada para el inversor moderno</p>
<div class="hero-data" style="gap: 15px;">
<a href="oportunidades.php" class="btn">Ver Oportunidades</a>
<a href="sobre-nosotros.php" class="btn btn-outline">Saber Más</a>
</div>

<!-- Métricas Rápidas Debajo del Texto -->
<div class="hero-data" style="display: flex; gap: 50px; margin-top: 60px; padding-top: 30px; border-top: 1px solid rgba(255,255,255,0.05);">
<div>
<div style="font-size: 2.2rem; font-weight: 800; color: white;">€5M+</div>
<div style="font-size: 0.85rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-top: 5px;">Activos Gestionados</div>
</div>
<div>
<div style="font-size: 2.2rem; font-weight: 800; color: white;">36%</div>
<div style="font-size: 0.85rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-top: 5px;">Rentabilidad Media</div>
</div>
</div>
</div>

<!-- Visual Derecha (Imagen y Tarjeta) -->
<!-- <div class="hero-visual">
<div class="hero-img-container">
<img src="https://picsum.photos/seed/buildingFinal/800/800" alt="Arquitectura Moderna" class="hero-img">
</div> -->

<!-- Tarjeta Flotante (Ahora está RELATIVA al visual, no absoluta a la página) -->
<!-- <div class="hero-card-visual">
<div class="hero-icon-circle">✓</div>
<div>
<div style="font-size: 0.8rem; color: var(--primary); font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Estado</div>
<div style="font-weight: bold; color: white; font-size: 1.1rem;">Activo</div>
</div>
</div>
</div>
</div>
</div>
</section>

<!-- SECCIÓN DESTACADOS -->
<section style="padding: 80px 0; background: #0b1120;">
<div class="container">
<div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 40px;">
<div>
<span style="color: var(--primary); font-weight: 700; letter-spacing: 1px; text-transform: uppercase;">Catálogo Selecto</span>
<h2 style="font-size: 2.5rem; font-family: 'Playfair Display', serif; color: white; margin-top: 10px;">Inversiones Finalizadas</h2>
</div>
<a href="oportunidades.php" style="font-weight: 600; color: white; display: flex; align-items: center; gap: 5px;">Ver todo el catálogo →</a>
</div>
<div id="featured-grid" class="project-grid"></div>
</div>
</section>

<!-- SECCIÓN METODOLOGÍA (SEO) -->
<section class="methodology-section">
<div class="container">
<div style="text-align: center; margin-bottom: 60px;">
<span style="color: var(--primary); font-weight: 700; text-transform: uppercase; letter-spacing: 1px; font-size: 0.9rem;">Como Invertir</span>
<h2 style="font-size: 2.5rem; font-family: 'Playfair Display', serif; color: white;">Metodología de Inversión</h2>
<p style="color: var(--text-muted); max-width: 600px; margin: 0 auto;">En Iroa Gestión facilitamos la inversión mediante un modelo estructurado y claro</p>
</div>

<div class="process-grid" style="counter-reset: step-counter;">
<!-- Paso 1 -->
<div class="process-step">
<div class="step-icon">1</div>
<h3 class="step-title">Selección Rigurosa</h3>
<p class="step-desc">Analizamos más de 300 activos inmobiliarios anualmente para encontrar oportunidades con el mejor potencial de rentabilidad y seguridad legal.</p>
</div>

<!-- Paso 2 -->
<div class="process-step">
<div class="step-icon">2</div>
<h3 class="step-title">Análisis y Gestión</h3>
<p class="step-desc">Analizamos antes de invertir y gestionamos para ganar.</p>
</div>

<!-- Paso 3 -->
<div class="process-step">
<div class="step-icon">3</div>
<h3 class="step-title">Rentabilidad superior a la media</h3>
<p class="step-desc">No buscamos lo estándar, buscamos lo que destaca con una estrategia enfocada en resultados superiores.</p>
</div>
</div>
</div>
</section>

<!-- SECCIÓN CTA CONTACTO -->
<section class="contact-cta">
<div class="cta-glow"></div>
<div class="cta-content">
<div class="cta-box">
<h2 style="font-size: 2.5rem; font-family: 'Playfair Display', serif; color: white; margin-bottom: 20px;">¿Listo para comenzar a invertir?</h2>
<p style="color: var(--text-muted); font-size: 1.1rem; margin-bottom: 30px;">Hable con nuestros asesores y diseñe su estrategia personalizada.</p>
<p style="font-size: 0.9rem; color: var(--text-muted); margin-top: 20px;">O puede contactarnos a través de</p> <p style="color: var(--text-muted); font-text: bold; font-size: 1.2rem; margin-bottom: 20px;">info@iroagestion.com</p>
</div>
</div>
</section>

</main>


<?php include 'footer.php'; ?>
