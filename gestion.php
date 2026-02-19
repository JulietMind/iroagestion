<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login_username']) && isset($_POST['login_password'])) {
        $user = $_POST['login_username'];
        $pass = $_POST['login_password'];
        if ($user === 'admin' && $pass === 'Iroagestion') {
            $_SESSION['admin'] = true;
            header("Location: gestion.php"); exit;
        } else {
            $error_message = "Usuario o contraseña incorrectos.";
        }
    }
}
if (isset($_GET['logout'])) { session_destroy(); header("Location: index.php"); exit; }
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Panel de Administración - Iroa Gestión</title>
<style>
/* Estilos Generales */
body { font-family: 'Inter', sans-serif; background: #0f172a; color: white; margin: 0; padding: 20px; }
h2 { font-family: 'Playfair Display', serif; color: #d4af37; margin-bottom: 20px; }
input, textarea, select { width: 100%; padding: 10px; margin: 5px 0; background: #1e293b; border: 1px solid #334155; color: white; box-sizing: border-box; }
button { padding: 10px 20px; cursor: pointer; background: #d4af37; border: none; color: black; font-weight: bold; }
.container { max-width: 1200px; margin: 0 auto; }
.admin-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 20px; }

/* Login */
#login-screen { display: flex; justify-content: center; align-items: center; min-height: 80vh; }
.login-box { background: #1e293b; padding: 40px; border-radius: 16px; border: 1px solid #d4af37; width: 100%; max-width: 400px; text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
.error-msg { color: #ef4444; font-size: 0.9rem; margin-bottom: 15px; }

/* Formularios y Tablas */
.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; background: #1e293b; border-radius: 8px; overflow: hidden; }
th, td { padding: 15px; text-align: left; border-bottom: 1px solid rgba(255,255,255,0.1); }
th { color: #d4af37; font-weight: 600; }
td img { width: 60px; height: 40px; object-fit: cover; border-radius: 4px; }

/* Botones Acciones */
.btn-save { background: #d4af37; color: black; padding: 10px 20px; border-radius: 6px; cursor: pointer; width: 100%; }
.btn-edit { background: #3b82f6; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; margin-right: 5px; }
.btn-del { background: #ef4444; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; }
.btn-reset { background: transparent; border: 1px solid rgba(255,255,255,0.2); color: white; padding: 10px 20px; border-radius: 6px; cursor: pointer; margin-left: 10px; }

/* --- SISTEMA DE PESTAÑAS --- */
.tabs { display: flex; gap: 20px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 30px; }
.tab-btn { background: none; border: none; color: #94a3b8; font-size: 1.1rem; padding-bottom: 10px; cursor: pointer; position: relative; }
.tab-btn.active { color: #d4af37; font-weight: bold; }
.tab-btn.active::after { content: ''; position: absolute; bottom: -1px; left: 0; width: 100%; height: 2px; background: #d4af37; }

.tab-content { display: none; animation: fadeIn 0.3s; }
.tab-content.active { display: block; }

@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
</style>
</head>
<body>

<?php if (!isset($_SESSION['admin'])): ?>
<!-- VISTA LOGIN -->
<div id="login-screen">
<div class="login-box">
<h2>Iroa Gestión</h2>
<p style="color: #94a3b8; margin-bottom: 20px;">Acceso Restringido</p>
<?php if ($error_message): ?><div class="error-msg"><?php echo $error_message; ?></div><?php endif; ?>
<form method="POST">
<input type="text" name="login_username" placeholder="Usuario" required>
<input type="password" name="login_password" placeholder="Contraseña" required>
<button type="submit" class="login-btn" style="width: 100%; margin-top: 10px;">Entrar al Panel</button>
</form>
<p style="margin-top: 20px; font-size: 0.8rem;"><a href="index.php" style="color: #94a3b8; text-decoration: none;">← Volver a la web</a></p>
</div>
</div>

<?php else: ?>
<!-- VISTA PANEL DE CONTROL -->
<div class="container">
<div class="admin-header">
<h2>Panel de Control</h2>
<a href="?logout=true" style="color: #ef4444; text-decoration: none; font-weight: 600;">Cerrar Sesión</a>
</div>

<!-- PESTAÑAS -->
<div class="tabs">
<button class="tab-btn active" onclick="app.switchTab('tab-pisos')">Finalizadas</button>
<button class="tab-btn" onclick="app.switchTab('tab-blog')">En curso</button>
</div>

<!-- PESTAÑA 1: FINALIZADAS -->
<div id="tab-pisos" class="tab-content active">
<div style="background: rgba(255,255,255,0.03); padding: 25px; border-radius: 12px; margin-bottom: 30px; border: 1px solid rgba(255,255,255,0.05);">
<h3>Añadir / Editar Finalizada</h3>
<form id="prop-form" onsubmit="app.saveProperty(event)">
<input type="hidden" id="prop-id">
<div class="form-grid">
<input type="text" id="prop-title" placeholder="Título" required>
<input type="text" id="prop-loc" placeholder="Ubicación" required>
<input type="text" id="prop-profit" placeholder="Rentabilidad" required>
<input type="text" id="prop-min" placeholder="Total capital aportado" required>
<input type="text" id="prop-duration" placeholder="Duración" required>
<input type="text" id="prop-badge" placeholder="Estado">
<!-- <input type="number" id="prop-progress" placeholder="Progreso">-->
<input type="text" id="prop-funded" placeholder="Beneficio">
</div>
<textarea id="prop-desc" rows="3" placeholder="Descripción..."></textarea>
<input type="file" id="prop-file" class="form-input" accept="image/*" onchange="app.previewImage(this)">
<input type="hidden" id="prop-image-data">
<div id="prop-preview" style="width: 100%; height: 150px; background: #333; margin-top: 10px; background-size: cover; background-position: center;"></div>
<button type="submit" class="btn-save">Guardar Piso</button>
<button type="button" class="btn-reset" onclick="app.resetPropForm()">Cancelar</button>
</form>
</div>
<h3>Listado de Finalizadas</h3>
<table id="admin-table"><thead><tr><th>Img</th><th>Título</th><th>Ubicación</th><th>Rentabilidad</th><th>Acciones</th></tr></thead><tbody></tbody></table>
</div>

<!-- PESTAÑA 2: EN CURSO -->
<div id="tab-blog" class="tab-content">
<div style="background: rgba(255,255,255,0.03); padding: 25px; border-radius: 12px; margin-bottom: 30px; border: 1px solid rgba(255,255,255,0.05);">
<h3>Añadir / Editar En curso</h3>
<form id="prop-form" onsubmit="app.saveProperty(event)">
<input type="hidden" id="prop-id">
<div class="form-grid">
<input type="text" id="prop-title" placeholder="Título" required>
<input type="text" id="prop-loc" placeholder="Ubicación" required>
<input type="text" id="prop-profit" placeholder="Rentabilidad" required>
<input type="text" id="prop-min" placeholder="Total capital aportado" required>
<input type="text" id="prop-duration" placeholder="Duración" required>
<input type="text" id="prop-badge" placeholder="Estado">
<!-- <input type="number" id="prop-progress" placeholder="Progreso">-->
<input type="text" id="prop-funded" placeholder="Beneficio">
</div>
<textarea id="prop-desc" rows="3" placeholder="Descripción..."></textarea>
<input type="file" id="prop-file" class="form-input" accept="image/*" onchange="app.previewImage(this)">
<input type="hidden" id="prop-image-data">
<div id="prop-preview" style="width: 100%; height: 150px; background: #333; margin-top: 10px; background-size: cover; background-position: center;"></div>
<button type="submit" class="btn-save">Guardar Piso</button>
<button type="button" class="btn-reset" onclick="app.resetPropForm()">Cancelar</button>
</form>
</div>
<h3>Listado de En curso</h3>
<table id="admin-posts-table"><thead><tr><th>Img</th><th>Título</th><th>Ubicación</th><th>Rentabilidad</th><th>Acciones</th></tr></thead><tbody></tbody></table>
</div>

</div>

<script src="backend.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    app.init();
});

// Función para cambiar pestañas
app.switchTab = function(tabId) {
    // Ocultar contenidos
    document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
    // Desactivar botones
    document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));

    // Mostrar activo
    document.getElementById(tabId).classList.add('active');
    event.target.classList.add('active');
}
</script>
<?php endif; ?>

</body>
</html>
