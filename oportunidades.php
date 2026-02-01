<?php include 'header.php'; ?>

<style>
    /* --- ESTILOS PRO FINANCIEROS --- */

    /* 1. Contenedor de la Grilla */
    .catalog-container {
        padding: 60px 0;
        background: var(--bg-body);
        min-height: 80vh;
    }

    .page-header {
        margin-bottom: 40px;
        border-bottom: 1px solid rgba(255,255,255,0.05);
        padding-bottom: 20px;
    }
    .page-header h2 {
        font-family: 'Playfair Display', serif; color: white; font-size: 2.5rem; margin: 0;
    }

    /* 2. La Tarjeta Pro (Project Card) */
    .project-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
        gap: 30px;
    }

    .project-card {
        background: var(--bg-card);
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.05);
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0,0,0,0.2);
        display: flex;
        flex-direction: column;
    }

    .project-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.4);
        border-color: rgba(212, 175, 55, 0.3);
    }

    /* 3. Imagen y Badge */
    .card-image-wrapper {
        position: relative;
        height: 240px;
        overflow: hidden;
    }
    .card-image-wrapper img {
        width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;
    }
    .project-card:hover .card-image-wrapper img { transform: scale(1.05); }

    .card-badge {
        position: absolute; top: 15px; left: 15px;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(8px);
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--primary);
        border: 1px solid rgba(255,255,255,0.1);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* 4. Cuerpo de la tarjeta */
    .card-body { padding: 25px; flex-grow: 1; display: flex; flex-direction: column; }

    .project-title {
        font-size: 1.4rem; font-weight: 700; color: white; margin: 0 0 10px 0;
        line-height: 1.3; font-family: 'Inter', sans-serif;
    }

    .project-location {
        display: flex; align-items: center; gap: 6px; color: var(--text-muted);
        font-size: 0.9rem; margin-bottom: 20px;
    }

    /* 5. Rejilla de Métricas Financieras */
    .metrics-grid {
        display: grid; grid-template-columns: 1fr 1fr 1fr;
        background: rgba(0,0,0,0.2);
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid rgba(255,255,255,0.03);
    }

    .metric { text-align: center; border-right: 1px solid rgba(255,255,255,0.05); }
    .metric:last-child { border-right: none; }

    .metric-label {
        display: block; font-size: 0.7rem; color: var(--text-muted);
        text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;
    }
    .metric-value {
        display: block; font-size: 1.1rem; font-weight: 700; color: white;
    }
    .metric-value.gold { color: var(--primary); } /* Resaltar rentabilidad */

    /* 6. Barra de Progreso Avanzada */
    .progress-section { margin-top: auto; }
    .progress-header {
        display: flex; justify-content: space-between; font-size: 0.85rem;
        margin-bottom: 8px; color: var(--text-muted);
    }
    .progress-track {
        width: 100%; height: 6px; background: rgba(255,255,255,0.1);
        border-radius: 4px; overflow: hidden;
    }
    .progress-fill {
        height: 100%; background: linear-gradient(90deg, var(--primary), #FCD34D);
        border-radius: 4px; position: relative;
    }
    .progress-fill::after {
        content: ''; position: absolute; top: 0; right: 0; bottom: 0;
        width: 2px; background: white; opacity: 0.5;
    }

    /* 7. Botón */
    .card-btn {
        margin-top: 20px; width: 100%;
        background: linear-gradient(135deg, var(--primary), #b5952f);
        color: #000; font-weight: 700; border: none; padding: 12px;
        border-radius: 8px; cursor: pointer; transition: 0.3s;
        display: flex; justify-content: center; align-items: center; gap: 8px;
    }
    .card-btn:hover { box-shadow: 0 0 20px rgba(212, 175, 55, 0.3); }
</style>

<main class="container catalog-container">
    <div class="page-header">
        <h2>Oportunidades de Inversión</h2>
    </div>

    <!-- Aquí se renderizarán las nuevas tarjetas -->
    <div id="featured-grid" class="project-grid"></div>
</main>

<!-- footer -->
<?php include 'footer.php'; ?>

<!-- SCRIPT ESPECIAL PARA SUBPÁGINAS -->
<!-- Indicamos a backend.js qué página estamos cargando -->
<script>
window.currentSlug = 'oportunidades';
</script>

<script src="backend.js"></script>
</body>
</html>
