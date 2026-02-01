<?php
// 1. Iniciamos sesión y control de errores
session_start();
$error_message = '';

// 2. Si enviamos el formulario de LOGIN
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Solo procesamos si hay usuario y contraseña (evita conflictos con el botón guardar)
    if (isset($_POST['login_username']) && isset($_POST['login_password'])) {
        $user = $_POST['login_username'];
        $pass = $_POST['login_password'];

        // Credenciales: admin / Iroagestion
        if ($user === 'admin' && $pass === 'Iroagestion') {
            $_SESSION['admin'] = true;
            header("Location: gestion.php"); // Recargar para mostrar el panel
            exit;
        } else {
            $error_message = "Usuario o contraseña incorrectos.";
        }
    }
}

// 3. Si pulsamos Cerrar Sesión
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
<title>Panel de Administración - Iroa Gestión</title>
<style>
/* Estilos del Panel */
body { font-family: 'Inter', sans-serif; background: #0f172a; color: white; margin: 0; padding: 20px; }
h2 { font-family: 'Playfair Display', serif; color: #d4af37; margin-bottom: 20px; }

/* Pantalla de Login */
#login-screen { display: flex; justify-content: center; align-items: center; min-height: 80vh; }
.login-box { background: #1e293b; padding: 40px; border-radius: 16px; border: 1px solid #d4af37; width: 100%; max-width: 400px; text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
.login-input { width: 100%; padding: 12px; margin: 10px 0; border-radius: 8px; border: 1px solid rgba(255,255,255,0.1); background: rgba(0,0,0,0.3); color: white; box-sizing: border-box; }
.login-btn { width: 100%; padding: 12px; background: #d4af37; border: none; color: black; font-weight: bold; border-radius: 8px; cursor: pointer; margin-top: 10px; }
.error-msg { color: #ef4444; font-size: 0.9rem; margin-bottom: 15px; }

/* Panel de Administración */
.admin-container { max-width: 1200px; margin: 0 auto; }
.admin-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 20px; }

/* Formulario */
.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px; }
.form-input { width: 100%; padding: 10px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.2); background: rgba(0,0,0,0.3); color: white; box-sizing: border-box; }
textarea.form-input { width: 100%; padding: 10px; height: 100px; }
input[type="file"] { width: 100%; }

/* Tabla */
table { width: 100%; border-collapse: collapse; margin-top: 20px; background: #1e293b; border-radius: 8px; overflow: hidden; }
th, td { padding: 15px; text-align: left; border-bottom: 1px solid rgba(255,255,255,0.1); }
th { color: #d4af37; font-weight: 600; }
td img { width: 60px; height: 40px; object-fit: cover; border-radius: 4px; }

/* Botones */
.btn-save { background: #d4af37; color: black; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-weight: bold; }
.btn-edit { background: #3b82f6; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; margin-right: 5px; }
.btn-del { background: #ef4444; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; }
.btn-reset { background: transparent; border: 1px solid rgba(255,255,255,0.2); color: white; padding: 10px 20px; border-radius: 6px; cursor: pointer; margin-left: 10px; }
</style>
</head>
<body>

<?php if (!isset($_SESSION['admin'])): ?>
<!-- VISTA LOGIN -->
<div id="login-screen">
<div class="login-box">
<h2>Iroa Gestión</h2>
<p style="color: #94a3b8; margin-bottom: 20px;">Acceso Restringido</p>

<?php if ($error_message): ?>
<div class="error-msg"><?php echo $error_message; ?></div>
<?php endif; ?>

<!-- Formulario de Login -->
<form method="POST">
<input type="text" name="login_username" class="login-input" placeholder="Usuario" required>
<input type="password" name="login_password" class="login-input" placeholder="Contraseña" required>
<button type="submit" class="login-btn">Entrar al Panel</button>
</form>
<p style="margin-top: 20px; font-size: 0.8rem;">
<a href="index.php" style="color: #94a3b8; text-decoration: none;">← Volver a la web</a>
</p>
</div>
</div>

<?php else: ?>
<!-- VISTA PANEL DE CONTROL -->
<div class="admin-container">
<div class="admin-header">
<h2>Panel de Control</h2>
<a href="?logout=true" style="color: #ef4444; text-decoration: none; font-weight: 600;">Cerrar Sesión</a>
</div>

<!-- Formulario Añadir/Editar -->
<div style="background: rgba(255,255,255,0.03); padding: 25px; border-radius: 12px; margin-bottom: 30px; border: 1px solid rgba(255,255,255,0.05);">
<h3 style="margin-top: 0;">Gestión de Pisos</h3>
<form id="prop-form" onsubmit="app.saveProperty(event)">
<input type="hidden" id="prop-id">

<div class="form-grid">
<input type="text" id="prop-title" class="form-input" placeholder="Título (Ej: Torre Madrid)" required>
<input type="text" id="prop-loc" class="form-input" placeholder="Ubicación (Ej: Madrid, España)" required>
<input type="text" id="prop-profit" class="form-input" placeholder="Rentabilidad (Ej: 8.5% / año)" required>
<input type="text" id="prop-min" class="form-input" placeholder="Inversión Mínima (Ej: €500)" required>
<input type="text" id="prop-duration" class="form-input" placeholder="Duración (Ej: 24 Meses)" required>
<input type="text" id="prop-badge" class="form-input" placeholder="Estado (Ej: En Financiación)">
<input type="number" id="prop-progress" class="form-input" placeholder="Progreso (0-100)">
<input type="text" id="prop-funded" class="form-input" placeholder="Recaudado (Ej: €120,000)">
</div>

<div style="margin-bottom: 15px;">
<textarea id="prop-desc" class="form-input" placeholder="Descripción completa del piso..."></textarea>
</div>

<div style="margin-bottom: 15px;">
<label style="display:block; margin-bottom:5px; color:#94a3b8;">Imagen:</label>
<input type="file" id="prop-file" class="form-input" accept="image/*" onchange="app.previewImage(this)">
<input type="hidden" id="prop-image-data">
<div id="prop-preview" style="width: 100%; height: 150px; background: #333; margin-top: 10px; background-size: cover; background-position: center; border-radius: 6px;"></div>
</div>

<button type="submit" class="btn-save">Guardar Piso</button>
<button type="button" class="btn-reset" onclick="app.resetForm()">Cancelar</button>
</form>
</div>

<!-- Listado -->
<h3>Listado de Pisos</h3>
<table id="admin-table">
<thead>
<tr>
<th>Img</th>
<th>Título</th>
<th>Ubicación</th>
<th>Rentabilidad</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>
<!-- Se rellena con JS -->
</tbody>
</table>
</div>

<!-- Cargamos el archivo JS que tiene la lógica -->
<script src="backend.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    app.init();
});
</script>
<?php endif; ?>

</body>
</html>
