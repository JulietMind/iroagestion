<?php include 'header.php'; ?>

<main>
    <!-- Hero Section -->
    <section class="hero" style="padding: 100px 0; text-align: center; position: relative; overflow: hidden;">
        <div style="background: radial-gradient(circle, rgba(212, 175, 55, 0.15) 0%, rgba(0,0,0,0) 70%); position: absolute; top: -20%; right: -10%; width: 600px; height: 600px; z-index: -1;"></div>
        <div class="container">
            <h1 style="font-size: 3.5rem; font-family: 'Playfair Display', serif; color: white; margin-bottom: 20px;">El Futuro de la Inversión Inmobiliaria es <span style="color: var(--primary);">Iroa Gestión</span></h1>
            <p style="font-size: 1.125rem; color: var(--text-muted); max-width: 700px; margin: 0 auto 30px;">Accede a oportunidades de inversión exclusivas en activos inmobiliarios de alto rendimiento con Iroa Gestión.</p>
            <div style="display: flex; gap: 15px; justify-content: center;">
                <a href="#oportunidades" class="btn">Ver Oportunidades</a>
                <a href="como-funciona.php" class="btn btn-outline">Saber Más</a>
            </div>
        </div>
    </section>

    <!-- Características -->
    <section class="section-padding" style="padding: 80px 0;">
        <div class="container">
            <div style="text-align: center; max-width: 700px; margin: 0 auto 60px auto;">
                <h2 style="font-size: 2.5rem; color: white; font-family: 'Playfair Display', serif;">¿Por qué elegir <span style="color: var(--primary);">Iroa Gestión</span>?</h2>
                <p style="color: var(--text-muted);">Transformamos la manera en que inviertes en ladrillos mediante tecnología blockchain y análisis de datos avanzado.</p>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
                <div style="background: var(--bg-card); padding: 40px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.05);">
                    <div style="font-size: 2rem; margin-bottom: 20px; color: var(--primary);">🛡️</div>
                    <h3 style="font-family: 'Inter', sans-serif; font-size: 1.25rem; color: white;">Seguridad Garantizada</h3>
                    <p style="color: var(--text-muted); font-size: 0.95rem; margin-top: 10px;">Todas las inversiones están respaldadas por activos reales y auditadas por terceros independientes.</p>
                </div>
                <div style="background: var(--bg-card); padding: 40px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.05);">
                    <div style="font-size: 2rem; margin-bottom: 20px; color: var(--primary);">⚡</div>
                    <h3 style="font-family: 'Inter', sans-serif; font-size: 1.25rem; color: white;">Liquidez Rápida</h3>
                    <p style="color: var(--text-muted); font-size: 0.95rem; margin-top: 10px;">Plataforma secundaria para comprar y vender participaciones, ofreciendo mayor liquidez que el brick tradicional.</p>
                </div>
                <div style="background: var(--bg-card); padding: 40px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.05);">
                    <div style="font-size: 2rem; margin-bottom: 20px; color: var(--primary);">💎</div>
                    <h3 style="font-family: 'Inter', sans-serif; font-size: 1.25rem; color: white;">Gestión Exclusiva</h3>
                    <p style="color: var(--text-muted); font-size: 0.95rem; margin-top: 10px;">Dividimos propiedades en tokens digitales, permitiéndote invertir desde 500€ con fraccionamiento exacto.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Estadísticas -->
    <section style="background: linear-gradient(rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.9)), url('https://picsum.photos/seed/office/1920/600'); background-size: cover; background-attachment: fixed; text-align: center; padding: 80px 0;">
        <div class="container">
            <div style="display: flex; justify-content: space-around; flex-wrap: wrap; gap: 40px;">
                <div>
                    <h3 style="font-size: 3rem; font-weight: 800; color: var(--primary); margin-bottom: 10px;">€45M+</h3>
                    <p style="color: white; font-size: 1.1rem;">Activos bajo gestión</p>
                </div>
                <div>
                    <h3 style="font-size: 3rem; font-weight: 800; color: var(--primary); margin-bottom: 10px;">2,500+</h3>
                    <p style="color: white; font-size: 1.1rem;">Inversores Activos</p>
                </div>
                <div>
                    <h3 style="font-size: 3rem; font-weight: 800; color: var(--primary); margin-bottom: 10px;">98%</h3>
                    <p style="color: white; font-size: 1.1rem;">Tasa de Satisfacción</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Oportunidades de Inversión (DINÁMICO CON NUEVO ESTILO) -->
    <section id="oportunidades" style="background: #0b1120; padding: 80px 0;">
        <div class="container">
            <div style="text-align: center; margin-bottom: 40px;">
                <h2 style="font-size: 2.5rem; color: white; font-family: 'Playfair Display', serif;">Oportunidades <span style="color: var(--primary);">Destacadas</span></h2>
                <p style="color: var(--text-muted);">Proyectos seleccionados rigurosamente por nuestro equipo de Iroa Gestión.</p>
            </div>

            <!-- Aquí se renderizan las tarjetas con el nuevo estilo Pro -->
            <div id="featured-grid" class="project-grid"></div>

            <div style="text-align: center; margin-top: 50px;">
                <a href="oportunidades.php" class="btn btn-outline">Ver Catálogo Completo</a>
            </div>
        </div>
    </section>
</main>

<!-- Footer -->
<?php include 'footer.php'; ?>


<script src="backend.js"></script>
</body>
</html>
