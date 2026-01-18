<?php
require_once("../../../Auth/MVC/db/db.php");

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "patient") {
  header("Location: /web-tech-project/Management/Auth/MVC/html/login.php");
  exit;
}

$pid = (int)($_SESSION["patient_id"] ?? 0);
$id  = (int)($_GET["id"] ?? 0);

if ($pid > 0 && $id > 0) {
  $conn->query("UPDATE appointments SET status='cancelled' WHERE id=$id AND patient_id=$pid AND status='scheduled'");
}

header("Location: ../html/appointments.php?msg=Cancelled");
exit;
