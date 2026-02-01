<?php
$host = 'localhost'; // O el host que te indique el panel de control
$db_user = 'USUARIO_DE_TU_BD';
$db_pass = 'CONTRASEÑA_DE_TU_BD';
$db_name = 'NOMBRE_DE_TU_BD';

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

// Si la conexión falla, devolvemos un JSON para que el JS lea el error
if ($conn->connect_error) {
    die(json_encode(['error' => true, 'message' => 'Fallo de conexión BD: ' . $conn->connect_error]));
}

// Configurar caracteres para acentos
$conn->set_charset("utf8mb4");
?>
