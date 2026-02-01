<?php include 'header.php'; ?>

<main class="container" style="padding: 60px 20px;">
    <h1 id="page-title" style="color: var(--primary); font-family: 'Playfair Display', serif;">Cargando...</h1>
    <div id="page-content" style="background: var(--bg-card); padding: 40px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.05); line-height: 1.8; color: var(--text-main);"></div>
</main>

<!-- footer -->
<?php include 'footer.php'; ?>

<!-- SCRIPT ESPECIAL PARA SUBPÁGINAS -->
<!-- Indicamos a backend.js qué página estamos cargando -->
<script>
    window.currentSlug = 'sobre-nosotros';
</script>

<script src="backend.js"></script>
</body>
</html>
