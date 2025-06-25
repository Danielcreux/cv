<?php
session_start();

// Incluir el archivo de configuración de la base de datos
require_once __DIR__ . '/includes/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $_SESSION['login_error'] = "Username and password are required.";
        header("Location: login.php");
        exit;
    }

    try {
        $pdo = getPDO();
        $stmt = $pdo->prepare("SELECT id, username, password_hash FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            // Password is correct, start session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Regenerate session ID for security
            session_regenerate_id(true);

            // Redirect to the main panel
            header("Location: index.php");
            exit;
        } else {
            $_SESSION['login_error'] = "Invalid username or password.";
            header("Location: login.php");
            exit;
        }
    } catch (PDOException $e) {
        // Log error for admin, show generic message to user
        error_log("Login PDOException: " . $e->getMessage());
        $_SESSION['login_error'] = "An error occurred. Please try again later.";
        header("Location: login.php");
        exit;
    }
} else {
    // Not a POST request, redirect to login page
    header("Location: login.php");
    exit;
}
?>
