<?php
// Iniciar la sesión
session_start();
?>

<div class="sidebar-section">
    <h3>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h3>
    <h3>Main Menu</h3>
    <ul class="sidebar-menu">
        <li><a href="index.php" onclick="showDashboard()"><i class="fas fa-home"></i> Dashboard</a></li>
        <li><a href="sidebar/my_resumes.php"><i class="fas fa-file-alt"></i> My Resumes</a></li>
        <li><a href="sidebar/downloads.php"><i class="fas fa-download"></i> Downloads</a></li>
    </ul>
</div>

<div class="sidebar-section">
    <h3>Account</h3>
    <ul class="sidebar-menu">
        <li><a href="sidebar/profile.php"><i class="fas fa-user"></i> Profile</a></li>
        <li><a href="sidebar/settings.php"><i class="fas fa-cog"></i> Settings</a></li>
        <li><a href="sidebar/help.php"><i class="fas fa-question-circle"></i> Help</a></li>
        <li><a href="sidebar/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
</div>

<div class="sidebar-section">
    <h3>Templates</h3>
    <ul class="sidebar-menu">
        <li><a href="?template=professional"><i class="fas fa-star"></i> Professional</a></li>
        <li><a href="?template=creative"><i class="fas fa-paint-brush"></i> Creative</a></li>
        <li><a href="?template=executive"><i class="fas fa-briefcase"></i> Executive</a></li>
        <li><a href="?template=academic"><i class="fas fa-graduation-cap"></i> Academic</a></li>
    </ul>
</div>
