<?php
require_once __DIR__ . '/../includes/auth_check.php';
requireAuth();

$pageTitle = "Mis Currículums";

// Obtener datos de ejemplo
$resumes = getSampleResumes();
?>

<div class="content-header">
    <h2>Mis Currículums</h2>
    <div class="header-actions">
        <a href="templates.php" class="btn-create">
            <i class="fas fa-plus"></i> Crear Nuevo
        </a>
    </div>
</div>

<div class="resumes-container">
    <?php if (empty($resumes)): ?>
        <div class="empty-state">
            <i class="fas fa-file-alt"></i>
            <h3>No tienes currículums creados</h3>
            <p>Comienza creando tu primer currículum profesional</p>
            <a href="templates.php" class="btn-create">Crear Primer Currículum</a>
        </div>
    <?php else: ?>
        <div class="resumes-grid">
            <?php foreach ($resumes as $resume): ?>
            <div class="resume-card">
                <div class="resume-thumbnail" style="background-color: <?php echo $resume['template'] === 'professional' ? '#3498db' : '#9b59b6'; ?>">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="resume-info">
                    <h3><?php echo htmlspecialchars($resume['name']); ?></h3>
                    <p>Plantilla: <?php echo htmlspecialchars(ucfirst($resume['template'])); ?></p>
                    <p>Creado: <?php echo htmlspecialchars($resume['created']); ?></p>
                    <p>Descargas: <?php echo htmlspecialchars($resume['downloads']); ?></p>
                </div>
                <div class="resume-actions">
                    <a href="#" class="btn-edit"><i class="fas fa-edit"></i> Editar</a>
                    <a href="#" class="btn-download"><i class="fas fa-download"></i> Descargar</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>