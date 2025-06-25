<?php
session_start();

// Incluir el archivo de configuración de la base de datos
require_once __DIR__ . '/includes/db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // --- Basic Validations ---
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['error_message'] = "All fields are required.";
        header('Location: register.php');
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_message'] = "Invalid email format.";
        header('Location: register.php');
        exit;
    }

    if (strlen($password) < 6) { // Example: Minimum password length
        $_SESSION['error_message'] = "Password must be at least 6 characters long.";
        header('Location: register.php');
        exit;
    }

    if ($password !== $confirm_password) {
        $_SESSION['error_message'] = "Passwords do not match.";
        header('Location: register.php');
        exit;
    }

    // --- Database Operations ---
    try {
        $pdo = new PDO('sqlite:' . DB_PATH);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if username or email already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username OR email = :email");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->fetchColumn()) {
            $_SESSION['error_message'] = "Username or email already taken.";
            header('Location: register.php');
            exit;
        }

        // Hash the password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash) VALUES (:username, :email, :password_hash)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password_hash', $password_hash);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Registration successful! You can now login.";
            header('Location: login.php'); // Redirect to login page after successful registration
            $_SESSION['user_id'] = $pdo->lastInsertId();
            $_SESSION['username'] = $username;
            exit;
        } else {
            $_SESSION['error_message'] = "Registration failed. Please try again.";
            header('Location: register.php');
            exit;
        }

    } catch (PDOException $e) {
        // Log error for admin, show generic message to user
        error_log("Registration Error: " . $e->getMessage()); // Uncomment to log errors to server logs
        $_SESSION['error_message'] = "An error occurred during registration. Please try again later.";
        header('Location: register.php');
        exit;
    }

} else {
    // If not a POST request, redirect to registration page
    header('Location: register.php');
    exit;
}
?>
