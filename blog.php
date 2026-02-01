<?php include 'header.php'; ?>

<style>
    .blog-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 30px; margin-top: 40px; }
    .post-card { background: var(--bg-card); border-radius: 16px; overflow: hidden; border: 1px solid rgba(255,255,255,0.05); transition: 0.3s; display: flex; flex-direction: column; }
    .post-card:hover { transform: translateY(-5px); }
    .post-img { width: 100%; height: 200px; object-fit: cover; }
    .card-body { padding: 25px; flex-grow: 1; display: flex; flex-direction: column; }
</style>

<main class="container" style="padding: 80px 20px;">
    <h1 style="color: var(--primary); font-family: 'Playfair Display', serif; text-align: center; margin-bottom: 10px;">Blog de Inversión</h1>
    <p style="text-align: center; color: var(--text-muted); max-width: 700px; margin: 0 auto 50px;">Análisis del mercado, noticias y consejos para tus inversiones.</p>

    <div id="blog-grid" class="blog-grid"></div>
</main>

<footer style="padding: 60px 0 20px; border-top: 1px solid rgba(255,255,255,0.05); text-align: center; color: var(--text-muted);">
    <div class="container"><p>&copy; 2023 Iroa Gestión.</p></div>
</footer>

<script src="backend.js"></script>
</body>
</html>
