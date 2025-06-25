<?php
session_start();
require_once __DIR__ . '/../includes/db_config.php';

try {
    $pdo = getPDO();
    $stmt = $pdo->prepare("SELECT id, title, created_at FROM resumes WHERE user_id = :user_id ORDER BY created_at DESC");
    $stmt->execute([':user_id' => $_SESSION['user_id']]);
    $resumes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    header('Content-Type: application/json');
    echo json_encode($resumes);
} catch (PDOException $e) {
    echo json_encode([]);
}
?>