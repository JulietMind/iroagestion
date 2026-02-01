<?php
$host = 'bbdd.iroagestion.com';
$db_user = 'ddb267655';
$db_pass = 'Iroapass90*';
$db_name = 'ddb267655';

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
