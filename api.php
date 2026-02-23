<?php
// Configuración de cabeceras para JSON
header('Content-Type: application/json');
header("Cache-Control: no-store, no-cache, must-reload");

// 1. CONEXIÓN (Carga db.php)
// Si db.php falla (contraseña incorrecta), se detiene aquí devolviendo JSON.
require 'db.php';

$action = $_GET['action'] ?? '';

// 2. LEER DATOS
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

    echo json_encode($response);
    exit;
}

// 3. GUARDAR
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

// 4. BORRAR
if ($action == 'delete_property') {
    $id = $_GET['id'];
    $conn->query("DELETE FROM properties WHERE id=$id");
    echo json_encode(['status' => 'success']);
    exit;
}

// --- NUEVO: Obtener SOLO un piso ---
if ($action == 'get_property') {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM properties WHERE id=$id");
    if ($result) {
        $item = $result->fetch_assoc();
        echo json_encode($item);
    } else {
        echo json_encode(null);
    }
    exit;
}

// --- NUEVO: Obtener SOLO un artículo ---
if ($action == 'get_post') {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM posts WHERE id=$id");
    if ($result) {
        $item = $result->fetch_assoc();
        echo json_encode($item);
    } else {
        echo json_encode(null);
    }
    exit;
}

// --- NUEVO: GUARDAR POST ---
if ($action == 'save_post' && $_SERVER['REQUEST_METHOD'] == 'POST') {
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
        $stmt = $conn->prepare("UPDATE posts SET title=?, location=?, image=?, profit=?, duration=?, min=?, badge=?, progress=?, funded=?, description=? WHERE id=?");
        $stmt->bind_param("ssssssssssi", $title, $location, $image, $profit, $duration, $min, $badge, $progress, $funded, $description, $id);
        $executed = $stmt->execute();
    } else {
        $stmt = $conn->prepare("INSERT INTO posts (title, location, image, profit, duration, min, badge, progress, funded, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss", $title, $location, $image, $profit, $duration, $min, $badge, $progress, $funded, $description);
        $executed = $stmt->execute();
    }

    if ($executed) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }
    exit;
}

// --- NUEVO: BORRAR POST ---
if ($action == 'delete_post') {
    $id = $_GET['id'];
    $conn->query("DELETE FROM posts WHERE id=$id");
    echo json_encode(['status' => 'success']);
    exit;
}

$conn->close();
?>
