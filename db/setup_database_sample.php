<?php
// Incluir el archivo de configuración de la base de datos
require_once __DIR__ . '/../includes/db_config.php';

// Obtener la instancia de PDO utilizando la función getPDO
$pdo = getPDO();

try {
    // Crear la tabla de usuarios
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL UNIQUE,
        email TEXT NOT NULL UNIQUE,
        password_hash TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // Crear la tabla de currículums
    $pdo->exec("CREATE TABLE IF NOT EXISTS resumes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER NOT NULL,
        title TEXT NOT NULL,
        content TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY(user_id) REFERENCES users(id)
    )");

    // Añadir un usuario por defecto
    $username = 'tuusuario';
    $email = 'tucorreo@example.com';
    $password = 'tucontraseña';
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT OR IGNORE INTO users (username, email, password_hash)
                           VALUES (:username, :email, :password_hash)");
    $stmt->execute([
        ':username' => $username,
        ':email' => $email,
        ':password_hash' => $passwordHash
    ]);

    echo "La configuración de la base de datos se ha completado con éxito!";

} catch (PDOException $e) {
    die("Error en la base de datos: " . $e->getMessage());
}
?>
