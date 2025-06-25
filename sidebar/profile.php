<?php
require_once __DIR__ . '/../includes/auth_check.php';
requireAuth();

$pageTitle = "Mi Perfil";
include 'templates/header.php';

// Obtener datos de usuario
$user = getUserData();
?>

<div class="content-header">
    <h2>Mi Perfil</h2>
    <p>Administra la información de tu cuenta</p>
</div>

<div class="profile-container">
    <div class="profile-sidebar">
        <div class="profile-avatar">
            <i class="fas fa-user-circle"></i>
            <button class="btn-change-avatar">Cambiar foto</button>
        </div>
        
        <div class="profile-stats">
            <h3>Estadísticas</h3>
            <div class="stat-item">
                <i class="fas fa-file-alt"></i>
                <span>Currículums creados: 5</span>
            </div>
            <div class="stat-item">
                <i class="fas fa-download"></i>
                <span>Descargas: 12</span>
            </div>
            <div class="stat-item">
                <i class="fas fa-calendar-alt"></i>
                <span>Miembro desde: <?php echo $user['created_at']; ?></span>
            </div>
        </div>
    </div>
    
    <div class="profile-content">
        <form class="profile-form">
            <div class="form-group">
                <label for="full_name">Nombre Completo</label>
                <input type="text" id="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>">
            </div>
            
            <div class="form-group">
                <label for="username">Nombre de Usuario</label>
                <input type="text" id="username" value="<?php echo htmlspecialchars($user['username']); ?>">
            </div>
            
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>">
            </div>
            
            <div class="form-group">
                <label for="password">Contraseña Actual</label>
                <input type="password" id="password" placeholder="••••••••">
            </div>
            
            <div class="form-group">
                <label for="new_password">Nueva Contraseña</label>
                <input type="password" id="new_password" placeholder="••••••••">
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirmar Nueva Contraseña</label>
                <input type="password" id="confirm_password" placeholder="••••••••">
            </div>
            
            <div class="form-actions">
                <button type="reset" class="btn-cancel">Cancelar</button>
                <button type="submit" class="btn-save">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>