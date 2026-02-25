<?php
include 'header.php';
?>

<!-- Contenedor Principal -->
<div class="container" style="padding-top: 40px; padding-bottom: 60px;">
<div id="detail-container">

<!-- Título y Ubicación -->
<div style="text-align: center; margin-bottom: 40px;">
<span style="background: #d4af37; color: black; padding: 5px 15px; border-radius: 20px; font-size: 0.8rem; font-weight: bold; text-transform: uppercase;">
Propiedad en Curso
</span>
<h1 id="detail-title" style="font-family: 'Playfair Display', serif; font-size: 2.5rem; color: white; margin: 15px 0;">Cargando...</h1>
<p id="detail-location-text" style="color: #94a3b8; font-size: 1.1rem; display: flex; align-items: center; justify-content: center; gap: 8px;">
<!-- Icono y texto de ubicación -->
</p>
</div>

<!-- Grid: Imagen y Datos -->
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">

<!-- Columna Izquierda: Imagen Grande -->
<div>
<img id="detail-image" src="" alt="Detalle Propiedad" style="width: 100%; border-radius: 16px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5);">
</div>

<!-- Columna Derecha: Métricas -->
<div style="background: rgba(30, 41, 59, 0.5); padding: 30px; border-radius: 16px; border: 1px solid rgba(255,255,255,0.1); height: fit-content;">

<h3 style="color: #d4af37; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 10px; margin-top: 0;">Ficha Técnica</h3>

<div style="display: flex; flex-direction: column; gap: 20px;">

<!-- Rentabilidad -->
<div>
<span style="color: #94a3b8; font-size: 0.9rem; display: block;">Rentabilidad Esperada</span>
<span id="detail-profit" style="color: white; font-size: 1.2rem; font-weight: bold;">-</span>
</div>

<!-- Duración -->
<div>
<span style="color: #94a3b8; font-size: 0.9rem; display: block;">Duración</span>
<span id="detail-duration" style="color: white; font-size: 1.2rem; font-weight: bold;">-</span>
</div>

<!-- Min Inversión -->
<div>
<span style="color: #94a3b8; font-size: 0.9rem; display: block;">Inversión Mínima</span>
<span id="detail-min" style="color: white; font-size: 1.2rem; font-weight: bold;">-</span>
</div>

</div>
</div>
</div>

<!-- Descripción -->
<div style="margin-top: 40px;">
<h3 style="color: #d4af37; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 10px;">Descripción del Proyecto</h3>
<div id="detail-desc" style="color: #cbd5e1; line-height: 1.8; font-size: 1.1rem; margin-top: 15px;">
Cargando descripción...
</div>
</div>

</div>
</div>

<!-- Script de funcionalidad -->
<script>
// Forzamos la carga de los detalles
document.addEventListener('DOMContentLoaded', () => {
    if (typeof app !== 'undefined') {
        app.fetchBlogDetail();
    }
});
</script>

<?php include 'footer.php'; ?>
