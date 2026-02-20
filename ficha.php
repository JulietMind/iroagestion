<?php include 'header.php'; ?>

<style>
/* Asegúrate de tener estos estilos si no estaban */
.detail-hero { position: relative; height: 50vh; overflow: hidden; margin-bottom: 40px; }
.detail-hero img { width: 100%; height: 100%; object-fit: cover; }
.detail-hero-overlay { position: absolute; bottom: 0; left: 0; width: 100%; background: linear-gradient(to top, rgba(15, 23, 42, 1), transparent); padding: 60px 0 20px; }
.detail-title { font-size: 3rem; color: white; margin: 0; }
.detail-location { font-size: 1.2rem; color: var(--primary); margin-top: 10px; }
.info-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; background: var(--bg-card); padding: 30px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.05); margin-bottom: 40px; }
.info-item h3 { font-size: 0.9rem; color: var(--text-muted); text-transform: uppercase; margin-bottom: 5px; }
.info-item p { font-size: 1.5rem; color: white; font-weight: 700; }
.info-item.gold p { color: var(--primary); }
.detail-desc { background: var(--bg-card); padding: 40px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.05); line-height: 1.8; font-size: 1.1rem; color: #cbd5e1; }
</style>

<div class="detail-hero">
<img id="detail-image" src="" alt="Detalle Inmueble">
<div class="detail-hero-overlay">
<div class="container">
<h1 id="detail-title" class="detail-title">Cargando...</h1>
<div class="detail-location">
<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
<span id="detail-location-text">...</span>
</div>
</div>
</div>
</div>

<div class="container" id="detail-container">
<!-- Métricas -->
<div class="info-grid">
<div class="info-item gold">
<h3>Rentabilidad Esperada</h3>
<p id="detail-profit">...</p>
</div>
<div class="info-item">
<h3>Duración</h3>
<p id="detail-duration">...</p>
</div>
<div class="info-item">
<h3>Inversión Mínima</h3>
<p id="detail-min">...</p>
</div>
</div>

<!-- Barra de Progreso -->
<!-- <div style="max-width: 600px; margin-bottom: 50px;">
<div style="display: flex; justify-content: space-between; color: var(--text-muted); margin-bottom: 10px;">
<span>Fondos Recaudados</span>
<span id="detail-funded">...</span>
</div>
<div style="height: 10px; background: rgba(255,255,255,0.1); border-radius: 5px; overflow: hidden;">
<div id="detail-progress" style="height: 100%; background: var(--primary); width: 0%; transition: width 1s;"></div>
</div>
</div> -->

<!-- Descripción -->
<div id="detail-desc" class="detail-desc">
<!-- Se rellena con JS -->
</div>

<div style="text-align: center; margin-top: 40px;">
<a href="javascript:history.back()" class="btn btn-outline" style="margin-left: 15px;">Volver</a>
</div>
</div>

<?php include 'footer.php'; ?>

<!-- SCRIPT MODIFICADO: CARGA INDEPENDIENTE Y RÁPIDA -->
<script>
document.addEventListener('DOMContentLoaded', async () => {
    // Llamamos directamente a la función que pide SOLO este piso
    await app.fetchPropertyDetail();
});
</script>

</body>
</html>
