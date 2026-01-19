

<?php
session_start();
require_once("../../../Auth/MVC/db/db.php");

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../Auth/MVC/html/login.php");
    exit;
}

$id = (int)($_GET['id'] ?? 0);

if ($id > 0) {
    $conn->query("UPDATE appointments SET approved=1 WHERE id=$id");
}

header("Location: ../html/appointments.php");
exit;