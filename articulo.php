<?php include 'header.php'; ?>

<style>
.article-header { text-align: center; max-width: 800px; margin: 40px auto; }
.article-header h1 { font-size: 2.5rem; color: white; margin-bottom: 10px; }
.article-date { color: var(--primary); font-weight: bold; display: block; margin-bottom: 20px; }
.article-content {
    max-width: 800px; margin: 0 auto; padding: 40px;
    background: var(--bg-card); border-radius: 12px;
    border: 1px solid rgba(255,255,255,0.05);
    color: #e2e8f0; line-height: 1.8; font-size: 1.1rem;
}
</style>

<main class="container" style="padding-top: 40px;">
<div class="article-header">
<span id="article-date" class="article-date">...</span>
<h1 id="article-title">Cargando...</h1>
</div>

<div id="article-body" class="article-content">
<!-- El contenido dinámico ira aquí -->
</div>

<div style="text-align: center; margin: 40px 0;">
<a href="blog.php" class="btn btn-outline">← Volver al Blog</a>
</div>
</main>

<!-- footer -->
<?php include 'footer.php'; ?>

<!-- SCRIPT ESPECIAL PARA SUBPÁGINAS -->
<!-- Indicamos a backend.js qué página estamos cargando -->
<script>
window.currentSlug = 'sobre-nosotros';
</script>

<script src="backend.js"></script>
<script>
document.addEventListener('DOMContentLoaded', async () => {
    // 1. Intentamos cargar lo que hay
    app.init();

    // 2. Si no hay datos (vacío), forzamos la regeneración de ejemplos
    if (app.data.properties.length === 0) {
        console.log("Sin datos, generando ejemplos...");
        app.seedDefaults();
        app.save();
    }

    // 3. Cargamos la ficha
    app.loadPropertyDetail();
});
</script>
</body>
</html>
