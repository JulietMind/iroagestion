<?php
$host = 'bbdd.iroagestion.com';
$db_user = 'ddb267655';
$db_pass = 'Iroapass90*';
$db_name = 'ddb267655';

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

// Si la conexión falla, devolvemos un JSON para que el JS lea el error
if ($conn->connect_error) {
    die(json_encode(['error' => true, 'message' => 'Fallo de conexión BD: ' . $conn->connect_error]));
}

// Configurar caracteres para acentos
$conn->set_charset("utf8mb4");
?>
