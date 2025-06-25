<?php
define('DB_PATH', __DIR__ . '/../db/database.sqlite');

$authPath = __DIR__ . '/../includes/auth_check.php';
function getPDO() {
    return new PDO('sqlite:' . DB_PATH);
}
?>