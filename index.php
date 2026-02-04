<?php include 'header.php'; ?>
<script src="backend.js"></script>

<main>
<!-- HERO SECTION MEJORADO -->
<section class="hero-pro">
<div class="container">
<div class="hero-content">
<!-- Texto Izquierda -->
<div class="hero-text">
<h1>Inversión Inmobiliaria <span style="color:var(--primary)">Inteligente</span></h1>
<p>Gestiona tus activos con seguridad y rentabilidad en una plataforma diseñada para el inversor moderno.</p>
<div class="hero-data" style="display: flex; gap: 15px;">
<a href="oportunidades.php" class="btn">Ver Oportunidades</a>
<a href="sobre-nosotros.php" class="btn btn-outline">Saber Más</a>
</div>

<!-- Métricas Rápidas Debajo del Texto -->
<div class="hero-data" style="display: flex; gap: 50px; margin-top: 60px; padding-top: 30px; border-top: 1px solid rgba(255,255,255,0.05);">
<div>
<div style="font-size: 2.2rem; font-weight: 800; color: white;">€45M+</div>
<div style="font-size: 0.85rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-top: 5px;">Activos Gestionados</div>
</div>
<div>
<div style="font-size: 2.2rem; font-weight: 800; color: white;">12%</div>
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
<h2 style="font-size: 2.5rem; font-family: 'Playfair Display', serif; color: white; margin-top: 10px;">Proyectos Destacados</h2>
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
<p style="color: var(--text-muted); max-width: 600px; margin: 0 auto;">En Iroa Gestión simplificamos el acceso a la renta patrimonial mediante un proceso riguroso y transparente.</p>
</div>

<div class="process-grid" style="counter-reset: step-counter;">
<!-- Paso 1 -->
<div class="process-step">
<div class="step-icon">1</div>
<h3 class="step-title">Selección Rigurosa</h3>
<p class="step-desc">Analizamos más de 300 activos inmobiliarios anualmente para encontrar oportunidades con el mejor potencial de plusvalía y seguridad legal.</p>
</div>

<!-- Paso 2 -->
<div class="process-step">
<div class="step-icon">2</div>
<h3 class="step-title">Tokenización y Gestión</h3>
<p class="step-desc">Digitalizamos la propiedad mediante contratos inteligentes, permitiéndote diversificar tu capital desde 500€ sin fricción.</p>
</div>

<!-- Paso 3 -->
<div class="process-step">
<div class="step-icon">3</div>
<h3 class="step-title">Rentabilidad Segura</h3>
<p class="step-desc">Obtén rendimientos pasivos trimestrales y la plusvalía del activo al finalizar el periodo de inversión de forma garantizada.</p>
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
<p style="color: var(--text-muted); font-size: 1.1rem; margin-bottom: 30px;">Hable con nuestros asesores de patrimonio y diseñe tu estrategia personalizada.</p>

<form action="mailto:info@iroagestion.com" method="post" enctype="text/plain">
<!-- Formulario visual de contacto -->
<input type="text" name="subject" class="cta-input" placeholder="Asunto (Opcional)" style="display:none;"> <!-- Oculto para prefillar el asunto -->
<input type="email" required class="cta-input" placeholder="Tu correo electrónico" name="body">
<button type="submit" class="btn btn-primary" style="width: 100%; font-size: 1.1rem;">Solicitar Asesoramiento</button>
</form>

<p style="font-size: 0.9rem; color: var(--text-muted); margin-top: 20px;">
O contáctanos directamente: <a href="mailto:info@iroagestion.com" style="color: white; text-decoration: underline;">info@iroagestion.com</a>
</p>
</div>
</div>
</section>

</main>


<?php include 'footer.php'; ?>
