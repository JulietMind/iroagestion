<?php
// --- 1. CONFIGURACIÓN DIRECTA (BLINDADA) ---
$db_host = 'bbdd.iroagestion.com';
$db_user = 'ddb267655';
$db_pass = 'Iroagestion90*';
$db_name = 'ddb267655';

// --- 2. CABECERAS JSON ---
error_reporting(0); // Ocultamos errores visuales de PHP
header('Content-Type: application/json');
header("Cache-Control: no-store, no-cache, must-reload");

// --- 3. CONEXIÓN A LA BASE DE DATOS ---
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Si la conexión falla, generamos un mensaje de error JSON MANUALMENTE
if ($conn->connect_error) {
    // Esto hace que incluso si falla la BD, el navegador lea JSON y el JS te diga qué pasó
    $response = ['error' => true, 'message' => 'Error de conexión BD: ' . $conn->connect_error];
    echo json_encode($response);
    exit;
}

// Forzamos caracteres especiales
$conn->set_charset("utf8mb4");

// --- 4. LÓGICA DE LA API ---
$action = $_GET['action'] ?? '';

// OBTENER DATOS
if ($action == 'get_all') {
    $response = ['properties' => [], 'posts' => []];

    // Pisos
    $props_result = $conn->query("SELECT * FROM properties ORDER BY id DESC");
    if ($props_result) {
        while($row = $props_result->fetch_assoc()) {
            $response['properties'][] = $row;
        }
    }

    // Posts
    $posts_result = $conn->query("SELECT * FROM posts ORDER BY id DESC");
    if ($posts_result) {
        while($row = $posts_result->fetch_assoc()) {
            $response['posts'][] = $row;
        }
    }

    echo json_encode($response);
    exit;
}

// GUARDAR
if ($action == 'save_property' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? '';
    $title = $_POST['title'];
    $location = $_POST['location'];
    $image = $_POST['image'];
    $profit = $_POST['profit'];
    $duration = $_POST['duration'];
    $min = $_POST['min'];
    $badge = $_POST['badge'];
    $progress = $_POST['progress'];
    $funded = $_POST['funded'];
    $description = $_POST['description'];

    if ($id) {
        $stmt = $conn->prepare("UPDATE properties SET title=?, location=?, image=?, profit=?, duration=?, min=?, badge=?, progress=?, funded=?, description=? WHERE id=?");
        $stmt->bind_param("sssssssssi", $title, $location, $image, $profit, $duration, $min, $badge, $progress, $funded, $description, $id);
        $executed = $stmt->execute();
    } else {
        $stmt = $conn->prepare("INSERT INTO properties (title, location, image, profit, duration, min, badge, progress, funded, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssi", $title, $location, $image, $profit, $duration, $min, $badge, $progress, $funded, $description);
        $executed = $stmt->execute();
    }

    if ($executed) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }
    exit;
}

// BORRAR
if ($action == 'delete_property') {
    $id = $_GET['id'];
    $conn->query("DELETE FROM properties WHERE id=$id");
    echo json_encode(['status' => 'success']);
    exit;
}

$conn->close();
?>
