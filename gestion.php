<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['username'] === 'admin' && $_POST['password'] === 'Iroagestion') {
        $_SESSION['admin'] = true;
        header("Location: gestion.php"); exit;
    }
}
if (isset($_GET['logout'])) { session_destroy(); header("Location: index.php"); exit; }
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Admin</title>
<style>
body { font-family: sans-serif; background: #0f172a; color: white; padding: 20px; }
input, textarea, select { width: 100%; padding: 10px; margin: 5px 0; background: #1e293b; border: 1px solid #334155; color: white; box-sizing: border-box; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; background: #1e293b; }
th, td { padding: 10px; border-bottom: 1px solid #334155; text-align: left; }
button { padding: 10px 20px; cursor: pointer; background: #d4af37; border: none; color: black; font-weight: bold; }
</style>
</head>
<body>
<div style="max-width: 1000px; margin: 0 auto;">
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
<h2>Panel de Control</h2>
<a href="?logout=true" style="color: #ef4444;">Cerrar Sesión</a>
</div>

<!-- Formulario -->
<div style="background: #1e293b; padding: 20px; border-radius: 8px;">
<h3>Añadir / Editar Piso</h3>
<form id="prop-form" onsubmit="app.saveProperty(event)">
<input type="hidden" id="prop-id">
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
<input type="text" id="prop-title" placeholder="Título" required>
<input type="text" id="prop-loc" placeholder="Ubicación" required>
<input type="text" id="prop-profit" placeholder="Rentabilidad (ej: 8%)" required>
<input type="text" id="prop-min" placeholder="Mínimo (ej: €500)" required>
<input type="text" id="prop-duration" placeholder="Duración" required>
<input type="text" id="prop-badge" placeholder="Estado">
<input type="number" id="prop-progress" placeholder="Progreso (0-100)">
<input type="text" id="prop-funded" placeholder="Recaudado">
</div>
<textarea id="prop-desc" rows="3" placeholder="Descripción completa..."></textarea>
<input type="file" id="prop-file" onchange="app.previewImage(this)">
<input type="hidden" id="prop-image-data">
<div id="prop-preview" style="width: 100%; height: 150px; background: #333; margin-top: 10px; background-size: cover; background-position: center;"></div>
<button type="submit" style="margin-top: 10px; width: 100%;">Guardar</button>
<button type="button" onclick="app.resetForm()" style="background: #475569; color: white; width: 100%; margin-top: 5px;">Cancelar</button>
</form>
</div>

<!-- Tabla -->
<h3>Listado de Pisos</h3>
<table id="admin-table"><thead><tr><th>Img</th><th>Título</th><th>Ubicación</th><th>Rentabilidad</th><th>Acciones</th></tr></thead><tbody></tbody></table>
</div>
<script src="backend.js"></script>
</body>
</html>
