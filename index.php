<?php include 'header.php'; ?>
<script src="backend.js"></script>

<?php include 'header.php'; ?>
<script src="backend.js"></script>

<main>
<!-- HERO SECTION PRO -->
<section class="hero-pro">
<div class="hero-bg"></div>
<div class="hero-pattern"></div>
<div class="hero-glow"></div>

<div class="container">
<div class="hero-content">
<div class="hero-text">
<h1>Inversión Inmobiliaria <span style="color:var(--primary)">Inteligente</span></h1>
<p>Gestiona tus activos con seguridad y rentabilidad en una plataforma diseñada para el inversor moderno.</p>
<div style="display: flex; gap: 15px;">
<a href="oportunidades.php" class="btn">Ver Oportunidades</a>
<a href="sobre-nosotros.php" class="btn btn-outline">Saber Más</a>
</div>

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

<div class="hero-card-visual">
<div class="hero-card-deco"></div>
<img src="https://picsum.photos/seed/building9/600/700" alt="Edificio Moderno" class="hero-img">

<div class="stat-card">
<div style="background: rgba(212, 175, 55, 0.2); padding: 12px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--primary);">
<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
</div>
<div>
<div style="font-size: 0.85rem; color: var(--text-muted);">ESTADO</div>
<div style="font-size: 1.25rem; font-weight: 700; color: white;">Activo</div>
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

<!-- SECCIÓN NUEVA: METODOLOGÍA (SEO) -->
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
<div class="step-icon">
<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 21l-6-6m2-5l7-7 3-3a5 5 0 0 1-7-7 3-3a5 5 0 0 1 7 7 3-3a5 5 0 0 1 7 7 3-3a5 5 0 0 1 7 7 3-3a5 5 0 0 1 7 7 3-3a5 5 0 0 1 7 7 3-3a5 5 0 0 1 7 7 3-3a5 5 0 0 1 7 7 3-3a5 5 0 0 1 7 7z"/></svg>
</div>
<h3 class="step-title">Selección Rigurosa</h3>
<p class="step-desc">Analizamos más de 300 activos inmobiliarios anualmente para encontrar oportunidades con el mejor potencial de plusvalía y seguridad legal.</p>
</div>

<!-- Paso 2 -->
<div class="process-step">
<div class="step-icon">
<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10v-5a4 4 0 0 0-8-0v-5a4 4 0 0 1 8-0v5c0 5.178 4 10 10 10z"/></svg>
</div>
<h3 class="step-title">Tokenización y Gestión</h3>
<p class="step-desc">Digitalizamos la propiedad mediante contratos inteligentes, permitiéndote diversificar tu capital desde 500€ sin fricción.</p>
</div>

<!-- Paso 3 -->
<div class="process-step">
<div class="step-icon">
<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
</div>
<h3 class="step-title">Rentabilidad Segura</h3>
<p class="step-desc">Obtén rendimientos pasivos trimestrales y la plusvalía del activo al finalizar el periodo de inversión de forma garantizada.</p>
</div>
</div>
</div>
</section>

<!-- SECCIÓN NUEVA: CTA CONTACTO -->
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

<?php include 'footer.php'; ?>
