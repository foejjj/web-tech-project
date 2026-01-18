<?php
require_once("../../../Auth/MVC/db/db.php");

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "doctor") {
  header("Location: /web-tech-project/Management/Auth/MVC/html/login.php");
  exit;
}

$did = (int)($_SESSION["doctor_id"] ?? 0);
$id  = (int)($_GET["id"] ?? 0);

if ($did > 0 && $id > 0) {
  $conn->query("UPDATE appointments SET status='completed' WHERE id=$id AND doctor_id=$did AND approved=1 AND status='scheduled'");
}

header("Location: ../html/appointments.php?msg=Completed");
exit;
