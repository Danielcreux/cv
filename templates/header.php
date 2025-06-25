<div class="container header-container">
    <div class="logo">
        <i class="fas fa-file-alt"></i>
        <span>ResumeBuilder Pro</span>
    </div>
    <nav>
        <ul>
            <li><a href="#" class="active">Dashboard</a></li>
            <li><a href="#">Templates</a></li>
            <li><a href="#">My Resumes</a></li>
            <li><a href="#">Help</a></li>
        </ul>
    </nav>
    <div class="user-actions">
        <button class="btn btn-outline">
            <i class="fas fa-bell"></i>
        </button>
        <div class="avatar">
            <?php
            // Iniciar la sesión si no está iniciada
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            // Verificar si el usuario está logueado y tiene un nombre de usuario
            if (isset($_SESSION['username'])) {
                // Obtener las dos primeras letras del nombre de usuario
                $initials = substr($_SESSION['username'], 0, 2);
                echo htmlspecialchars($initials);
            } else {
                // Si no hay usuario logueado, mostrar un avatar vacío o predeterminado
                echo "GU";
            }
            ?>
        </div>
    </div>
</div>
