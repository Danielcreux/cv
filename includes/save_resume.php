<?php
session_start();

// Permitir CORS para desarrollo
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Encabezado principal
header('Content-Type: application/json');

// Solo permitir POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'error' => 'Método no permitido. Se requiere POST.'
    ]);
    exit;
}

// Verificar sesión
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'Usuario no autenticado']);
    exit;
}

// Obtener datos
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// Validar JSON
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => 'JSON inválido: ' . json_last_error_msg()
    ]);
    exit;
}

// Validar datos
if (empty($data['title']) || empty($data['content'])) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => 'Datos incompletos'
    ]);
    exit;
}

// Base de datos (SQLite)
try {
    $dbPath = __DIR__ . '/database.sqlite';
    $pdo = new PDO("sqlite:$dbPath");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Crear tabla si no existe
    $pdo->exec("CREATE TABLE IF NOT EXISTS resumes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER NOT NULL,
        title TEXT NOT NULL,
        content TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    
    // Insertar
    $stmt = $pdo->prepare("INSERT INTO resumes (user_id, title, content) VALUES (?, ?, ?)");
    $stmt->execute([
        $_SESSION['user_id'],
        $data['title'],
        json_encode($data['content'])
    ]);
    
    echo json_encode([
        'success' => true,
        'id' => $pdo->lastInsertId()
    ]);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Error de base de datos: ' . $e->getMessage()
    ]);
}