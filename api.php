<?php
header('Content-Type: application/json');
require 'db.php';

 $action = $_GET['action'] ?? '';

// 1. LEER DATOS (Pisos y Posts)
if ($action == 'get_all') {
    // Obtener Pisos
    $props_result = $conn->query("SELECT * FROM properties ORDER BY id DESC");
    $properties = [];
    while($row = $props_result->fetch_assoc()) {
        $properties[] = $row;
    }

    // Obtener Posts
    $posts_result = $conn->query("SELECT * FROM posts ORDER BY id DESC");
    $posts = [];
    while($row = $posts_result->fetch_assoc()) {
        $posts[] = $row;
    }

    echo json_encode(['properties' => $properties, 'posts' => $posts]);
}

// 2. GUARDAR PISO
if ($action == 'save_property' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? '';
    $title = $_POST['title'];
    $location = $_POST['location'];
    $image = $_POST['image']; // Base64 string
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
        $stmt->execute();
    } else {
        // Crear Nuevo
        $stmt = $conn->prepare("INSERT INTO properties (title, location, image, profit, duration, min, badge, progress, funded, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssi", $title, $location, $image, $profit, $duration, $min, $badge, $progress, $funded, $description);
        $stmt->execute();
    }
    echo json_encode(['status' => 'success']);
}

// 3. BORRAR PISO
if ($action == 'delete_property') {
    $id = $_GET['id'];
    $conn->query("DELETE FROM properties WHERE id=$id");
    echo json_encode(['status' => 'success']);
}

 $conn->close();
?>
