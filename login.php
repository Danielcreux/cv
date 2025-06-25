<?php
session_start();
$path = __DIR__ . '/../includes/db_config.php';
$authPath = __DIR__ . '/../includes/auth_check.php';

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Resume Builder Pro</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body { display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #f0f0f1; }
        .auth-container { background-color: #fff; padding: 30px 40px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        .auth-container h1 {
            text-align: center;
            color: var(--wp-primary);
            margin-bottom: 25px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--wp-text-light);
        }
        .form-group input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--wp-border);
            border-radius: 4px;
            box-sizing: border-box;
        }
        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: var(--wp-primary);
            color: var(--wp-white);
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
        }
        .btn-submit:hover {
            background-color: var(--wp-primary-hover);
        }
        .message {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            text-align: center;
        }
        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .auth-link {
            text-align: center;
            margin-top: 20px;
        }
        .auth-link a {
            color: var(--wp-primary);
            text-decoration: none;
        }
        .auth-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <h1>Login</h1>

        <?php if (isset($_SESSION['login_error'])): ?>
            <div class="message error"><?= $_SESSION['login_error']; unset($_SESSION['login_error']); ?></div>
        <?php endif; ?>

        <form action="handle_login.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn-submit">Login</button>
        </form>
        <div class="auth-link">
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>
</body>
</html>