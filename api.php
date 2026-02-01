<?php
// Forzar salida JSON limpia
header('Content-Type: application/json');
header("Cache-Control: no-store, no-cache, must-revalidate");

// Intentar conectar
require 'db.php';

// Si llegamos aquí, la conexión falló y db.php mató el script con "die()"
// O bien no existe db.php.
// Como db.php hace die(), este código no se ejecuta si falla.
// Por lo tanto, si llegamos aquí, la conexión fue EXITOSA.

$action = $_GET['action'] ?? '';

// 1. LEER DATOS
if ($action == 'get_all') {
    $response = [];

    // Pisos
    $props_result = $conn->query("SELECT * FROM properties ORDER BY id DESC");
    if ($props_result) {
        $response['properties'] = [];
        while($row = $props_result->fetch_assoc()) {
            $response['properties'][] = $row;
        }
    } else {
        $response['properties'] = [];
    }

    // Posts
    $posts_result = $conn->query("SELECT * FROM posts ORDER BY id DESC");
    if ($posts_result) {
        $response['posts'] = [];
        while($row = $posts_result->fetch_assoc()) {
            $response['posts'][] = $row;
        }
    } else {
        $response['posts'] = [];
    }

    // IMPORTANTE: Salida limpia
    echo json_encode($response);
    exit;
}

// 2. GUARDAR
if ($action == 'save_property' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificamos conexión de nuevo por si acaso
    if ($conn->connect_error) {
        echo json_encode(['status' => 'error', 'message' => 'DB Connection Lost']);
        exit;
    }

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

// 3. BORRAR
if ($action == 'delete_property') {
    $id = $_GET['id'];
    $conn->query("DELETE FROM properties WHERE id=$id");
    echo json_encode(['status' => 'success']);
    exit;
}

$conn->close();
?>
