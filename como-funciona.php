<?php include 'header.php'; ?>

<style>
    .steps-container { display: flex; gap: 20px; margin-top: 50px; flex-wrap: wrap; justify-content: center; }
    .step-card { flex: 1; min-width: 250px; background: var(--bg-card); padding: 30px; border-radius: 12px; text-align: center; border: 1px solid rgba(255,255,255,0.05); }
    .step-num { font-size: 3rem; font-weight: 800; color: var(--primary); opacity: 0.3; display: block; margin-bottom: 10px; }
</style>

<main class="container" style="padding: 80px 20px;">
    <h1 id="page-title" style="color: var(--primary); font-family: 'Playfair Display', serif; text-align: center;">Cargando...</h1>
    
    <div id="page-content" style="background: var(--bg-card); padding: 40px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.05); line-height: 1.8; max-width: 800px; margin: 30px auto; color: var(--text-main);"></div>

    <!-- Iconos visuales estáticos -->
    <div class="steps-container">
        <div class="step-card">
            <span class="step-num">1</span>
            <h3 style="color: white;">Registro</h3>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Crea tu cuenta de forma gratuita.</p>
        </div>
        <div class="step-card">
            <span class="step-num">2</span>
            <h3 style="color: white;">Selección</h3>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Elige el activo que prefieras.</p>
        </div>
        <div class="step-card">
            <span class="step-num">3</span>
            <h3 style="color: white;">Inversión</h3>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Invierte y empieza a ganar.</p>
        </div>
    </div>
</main>

<!-- footer -->
<?php include 'footer.php'; ?>

<!-- SCRIPT ESPECIAL PARA SUBPÁGINAS -->
<!-- Indicamos a backend.js qué página estamos cargando -->
<script>
window.currentSlug = 'como-funciona';
</script>

<script src="backend.js"></script>
</body>
</html>
