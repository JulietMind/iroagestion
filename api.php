<?php
// Ocultar advertencias de PHP para que no rompan el JSON
error_reporting(0);
header('Content-Type: application/json');

require 'db.php';

$action = $_GET['action'] ?? '';

// 1. LEER DATOS
if ($action == 'get_all') {

    $properties = [];
    // Verificamos que la tabla properties exista antes de consultar
    $check_props = $conn->query("SHOW TABLES LIKE 'properties'");
    if($check_props && $check_props->num_rows > 0) {
        $props_result = $conn->query("SELECT * FROM properties ORDER BY id DESC");
        if ($props_result) {
            while($row = $props_result->fetch_assoc()) {
                $properties[] = $row;
            }
        }
    }

    $posts = [];
    // Verificamos que la tabla posts exista antes de consultar
    $check_posts = $conn->query("SHOW TABLES LIKE 'posts'");
    if($check_posts && $check_posts->num_rows > 0) {
        $posts_result = $conn->query("SELECT * FROM posts ORDER BY id DESC");
        if ($posts_result) {
            while($row = $posts_result->fetch_assoc()) {
                $posts[] = $row;
            }
        }
    }

    echo json_encode(['properties' => $properties, 'posts' => $posts]);
    exit;
}

// 2. GUARDAR PISO
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
        // Actualizar
        $stmt = $conn->prepare("UPDATE properties SET title=?, location=?, image=?, profit=?, duration=?, min=?, badge=?, progress=?, funded=?, description=? WHERE id=?");
        $stmt->bind_param("sssssssssi", $title, $location, $image, $profit, $duration, $min, $badge, $progress, $funded, $description, $id);
        $executed = $stmt->execute();
    } else {
        // Crear Nuevo
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

// 3. BORRAR PISO
if ($action == 'delete_property') {
    $id = $_GET['id'];
    $conn->query("DELETE FROM properties WHERE id=$id");
    echo json_encode(['status' => 'success']);
    exit;
}

$conn->close();
?>
