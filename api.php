<?php
// Obligar al buffer de salida para capturar cualquier cosa
ob_start();
header('Content-Type: application/json');
header("Cache-Control: no-store, no-cache, must-revalidate");

try {
    // Intentamos conectar
    require 'db.php';
} catch (Exception $e) {
    // Si falla la conexión, devolvemos un JSON de error explícito
    echo json_encode(['error' => true, 'message' => 'Error de conexión BD: ' . $e->getMessage()]);
    exit;
}

$action = $_GET['action'] ?? '';

// 1. LEER DATOS
if ($action == 'get_all') {
    $response = [];

    // Obtenemos Pisos
    $query_props = $conn->query("SELECT * FROM properties ORDER BY id DESC");
    if ($query_props) {
        $response['properties'] = [];
        while($row = $query_props->fetch_assoc()) {
            $response['properties'][] = $row;
        }
    } else {
        $response['properties'] = [];
    }

    // Obtenemos Posts
    $query_posts = $conn->query("SELECT * FROM posts ORDER BY id DESC");
    if ($query_posts) {
        $response['posts'] = [];
        while($row = $query_posts->fetch_assoc()) {
            $response['posts'][] = $row;
        }
    } else {
        $response['posts'] = [];
    }

    // Limpieza final del buffer
    ob_clean();
    echo json_encode($response);
    exit;
}

// 2. GUARDAR
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

    ob_clean();
    if ($executed) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }
    exit;
}

// 3. BORRAR
if ($action == 'delete_property') {
    $id = $_GET['id'];
    $conn->query("DELETE FROM properties WHERE id=$id");
    ob_clean();
    echo json_encode(['status' => 'success']);
    exit;
}

$conn->close();
?>
