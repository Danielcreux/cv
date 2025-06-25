<?php
require_once __DIR__ . '/../includes/auth_check.php';

$pageTitle = "Mis Descargas";
include 'templates/header.php';

// Obtener datos de ejemplo
$resumes = getSampleResumes();
?>

<div class="content-header">
    <h2>Mis Descargas</h2>
    <p>Historial de todos tus currículums descargados</p>
</div>

<div class="downloads-container">
    <div class="stats-cards">
        <div class="stat-card">
            <i class="fas fa-file-download"></i>
            <div>
                <h3>15</h3>
                <p>Descargas totales</p>
            </div>
        </div>
        <div class="stat-card">
            <i class="fas fa-file-alt"></i>
            <div>
                <h3><?php echo count($resumes); ?></h3>
                <p>Currículums creados</p>
            </div>
        </div>
        <div class="stat-card">
            <i class="fas fa-star"></i>
            <div>
                <h3>4</h3>
                <p>Plantillas usadas</p>
            </div>
        </div>
    </div>

    <div class="downloads-table-container">
        <table class="downloads-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Plantilla</th>
                    <th>Fecha</th>
                    <th>Formato</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resumes as $resume): ?>
                <tr>
                    <td><?php echo htmlspecialchars($resume['name']); ?></td>
                    <td><?php echo htmlspecialchars(ucfirst($resume['template'])); ?></td>
                    <td><?php echo htmlspecialchars($resume['created']); ?></td>
                    <td>PDF</td>
                    <td>
                        <a href="#" class="btn-download"><i class="fas fa-download"></i> Descargar</a>
                        <a href="#" class="btn-view"><i class="fas fa-eye"></i> Ver</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>