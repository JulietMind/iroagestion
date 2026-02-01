<?php
session_start();
 $error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    if ($user === 'admin' && $pass === 'Iroagestion') {
        $_SESSION['is_admin'] = true;
        header("Location: gestion.php");
        exit;
    } else {
        $error_message = "Usuario o contraseña incorrectos.";
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Control | Iroa</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root { --bg-body: #0f172a; --bg-card: #1e293b; --primary: #d4af37; --text-main: #f1f5f9; --text-muted: #94a3b8; --danger: #ef4444; }
        body { font-family: 'Inter', sans-serif; background: var(--bg-body); color: var(--text-main); margin: 0; }
        .container { max-width: 1100px; margin: 0 auto; padding: 20px; }

        /* Login Screen */
        #login-screen { display: flex; justify-content: center; align-items: center; height: 100vh; flex-direction: column; }
        .login-box { background: var(--bg-card); padding: 40px; border-radius: 12px; border: 1px solid var(--primary); width: 100%; max-width: 400px; text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        .login-input { width: 100%; padding: 12px; margin: 10px 0; border-radius: 6px; border: 1px solid rgba(255,255,255,0.2); background: rgba(0,0,0,0.3); color: white; box-sizing: border-box; }
        .login-btn { width: 100%; padding: 12px; background: var(--primary); border: none; color: black; font-weight: bold; border-radius: 6px; cursor: pointer; margin-top: 10px; }
        .error-msg { color: var(--danger); font-size: 0.9rem; margin-bottom: 15px; }

        /* Admin Panel */
        .admin-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 20px; }
        .admin-tabs { display: flex; gap: 10px; margin-bottom: 20px; }
        .tab-btn { padding: 10px 20px; border: none; background: rgba(255,255,255,0.05); color: var(--text-muted); cursor: pointer; border-radius: 4px; }
        .tab-btn.active { background: var(--primary); color: black; font-weight: bold; }

        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; color: var(--text-muted); }
        .form-input { width: 100%; padding: 10px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.2); background: rgba(0,0,0,0.3); color: white; }
        textarea { width: 100%; padding: 10px; height: 150px; border-radius: 6px; background: rgba(0,0,0,0.3); color: white; border: 1px solid rgba(255,255,255,0.2); }

        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid rgba(255,255,255,0.1); }
        th { color: var(--primary); }
        td img { width: 50px; height: 35px; object-fit: cover; border-radius: 4px; }

        .btn-del { background: var(--danger); color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; }
        .hidden { display: none; }
    </style>
</head>
<body>

    <?php if (!isset($_SESSION['is_admin'])): ?>
        <div id="login-screen">
            <div class="login-box">
                <h2>Iroa Gestión</h2>
                <p style="color: var(--text-muted); margin-bottom: 20px;">Acceso Restringido</p>
                <?php if ($error_message): ?><div class="error-msg"><?php echo $error_message; ?></div><?php endif; ?>
                <form method="POST">
                    <input type="text" name="username" class="login-input" placeholder="Usuario" required>
                    <input type="password" name="password" class="login-input" placeholder="Contraseña" required>
                    <button type="submit" class="login-btn">Entrar al Backend</button>
                </form>
                <p style="margin-top: 20px; font-size: 0.8rem;"><a href="index.php" style="color: var(--text-muted);">← Volver a la web</a></p>
            </div>
        </div>
    <?php else: ?>
        <div class="container">
            <div class="admin-header">
                <div><h2>Panel de Control</h2><span style="color: var(--text-muted); font-size: 0.9rem;">Bienvenido, Admin</span></div>
                <div>
                    <a href="index.php" style="color: var(--text-muted); text-decoration: none; margin-right: 20px;">Ver Web</a>
                    <a href="?logout=true" style="color: var(--danger); text-decoration: none;">Cerrar Sesión</a>
                </div>
            </div>
            <div class="admin-tabs">
                <button class="tab-btn active" onclick="document.getElementById('tab-properties').classList.remove('hidden'); document.getElementById('tab-pages').classList.add('hidden');">Pisos y Oportunidades</button>
                <button class="tab-btn" onclick="document.getElementById('tab-properties').classList.add('hidden'); document.getElementById('tab-pages').classList.remove('hidden');">Editar Textos Web</button>
            </div>

            <!-- Pestaña Propiedades -->
            <div id="tab-properties">
                <div style="background: rgba(0,0,0,0.2); padding: 20px; border-radius: 8px; margin-bottom: 30px;">
                    <h4 style="margin-bottom: 15px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 10px;">Añadir / Editar Oportunidad</h4>
                    <form id="property-form" onsubmit="app.handlePropertySubmit(event)">
                        <div class="form-group">
                            <label>Descripción Completa del Piso:</label>
                            <textarea id="prop-desc" class="form-input" rows="4" placeholder="Describa detalles de la propiedad..."></textarea>
                        </div>
                        <input type="hidden" id="prop-id">
                        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:15px; margin-bottom: 15px;">
                            <input type="text" id="prop-title" class="form-input" placeholder="Título (Ej: Torre Madrid)" required>
                            <input type="text" id="prop-loc" class="form-input" placeholder="Ubicación (Ej: Madrid, España)" required>
                            <input type="text" id="prop-profit" class="form-input" placeholder="Rentabilidad (Ej: 8.5% / año)" required>
                            <input type="text" id="prop-min" class="form-input" placeholder="Inversión Mínima (Ej: €500)" required>
                            <input type="text" id="prop-duration" class="form-input" placeholder="Duración (Ej: 24 Meses)" required>
                            <input type="text" id="prop-badge" class="form-input" placeholder="Estado (Ej: En Financiación)">
                        </div>
                        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:15px; margin-bottom: 15px;">
                            <div class="form-group"><label>Progreso (%) 0-100</label><input type="number" id="prop-progress" class="form-input" min="0" max="100"></div>
                            <div class="form-group"><label>Dinero Recaudado (Texto)</label><input type="text" id="prop-funded" class="form-input" placeholder="Ej: €120,000 recaudados"></div>
                        </div>
                        <div class="form-group"><label>Imagen del Proyecto</label><input type="file" id="prop-file" class="form-input" accept="image/*" onchange="app.handleImagePreview(this)"><input type="hidden" id="prop-image-data"><div id="prop-preview" style="margin-top: 10px; height: 100px; background: #333; border-radius: 4px; background-size: cover; background-position: center;"></div></div>
                        <button type="submit" class="login-btn" style="width: auto; display: inline-block;">Guardar Ficha</button>
                        <button type="button" onclick="app.resetPropForm()" class="tab-btn" style="background: transparent; color: white;">Cancelar</button>
                    </form>
                </div>
                <h4>Listado de Activos</h4>
                <div style="overflow-x:auto;"><table id="props-table"><thead><tr><th>Img</th><th>Título</th><th>Ubicación</th><th>Rentabilidad</th><th>Acciones</th></tr></thead><tbody></tbody></table></div>
            </div>

            <!-- Pestaña Textos -->
            <div id="tab-pages" class="hidden">
                <h4 style="margin-bottom:15px;">Editor de Contenidos de Páginas</h4>
                <div class="form-group"><label>Seleccionar Página a Editar:</label><select id="page-selector" onchange="app.loadPageContent()"><option value="sobre-nosotros">Sobre Nosotros</option><option value="blog">Blog</option><option value="como-funciona">Cómo Funciona</option><option value="ayuda">Ayuda / FAQ</option><option value="terminos">Términos de Uso</option><option value="privacidad">Política de Privacidad</option></select></div>
                <div class="form-group"><label>Título H1 de la Página:</label><input type="text" id="page-title" class="form-input"></div>
                <div class="form-group"><label>Contenido (HTML permitido):</label><textarea id="page-body"></textarea></div>
                <button onclick="app.savePageContent()" class="login-btn">Guardar Cambios</button>
            </div>
        </div>
        <script src="backend.js"></script>
    <?php endif; ?>
</body>
</html>
