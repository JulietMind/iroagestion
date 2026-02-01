<?php include 'header.php'; ?>
<script src="backend.js"></script>
<style>
.detail-hero { position: relative; height: 50vh; overflow: hidden; margin-bottom: 40px; }
.detail-hero img { width: 100%; height: 100%; object-fit: cover; }
.info-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px; }
.info-box { background: var(--bg-card); padding: 20px; border-radius: 12px; text-align: center; border: 1px solid rgba(255,255,255,0.05); }
</style>
<div class="detail-hero">
<img id="detail-image" src="" alt="Detalle">
<div style="position: absolute; bottom: 0; width: 100%; background: linear-gradient(to top, rgba(15,23,42,1), transparent); padding: 40px 0;">
<div class="container">
<h1 id="detail-title" style="color: white; font-family: 'Playfair Display', serif; margin: 0;">...</h1>
<div id="detail-location-text" style="color: var(--primary);">...</div>
</div>
</div>
</div>
<div class="container" id="detail-container">
<div class="info-grid">
<div class="info-box"><p style="color:var(--text-muted); margin:0;">Rentabilidad</p><h3 id="detail-profit" style="color:var(--primary); margin:10px 0;">...</h3></div>
<div class="info-box"><p style="color:var(--text-muted); margin:0;">Duración</p><h3 id="detail-duration" style="color:white; margin:10px 0;">...</h3></div>
<div class="info-box"><p style="color:var(--text-muted); margin:0;">Min. Inversión</p><h3 id="detail-min" style="color:white; margin:10px 0;">...</h3></div>
</div>
<div style="max-width: 600px; margin: 0 auto 40px;">
<div style="display:flex; justify-content:space-between; color:var(--text-muted); margin-bottom:5px;"><span>Fondos</span><span id="detail-funded">...</span></div>
<div style="height: 10px; background: rgba(255,255,255,0.1); border-radius: 5px; overflow: hidden;"><div id="detail-progress" style="height: 100%; background: var(--primary); width: 0%;"></div></div>
</div>
<div style="background: var(--bg-card); padding: 40px; border-radius: 12px; color: #e2e8f0; line-height: 1.8;">
<p id="detail-desc">Cargando descripción...</p>
</div>
</div>
<script>app.loadPropertyDetail();</script>
<?php include 'footer.php'; ?>
