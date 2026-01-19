<?php
require_once("../../../Auth/MVC/db/db.php");

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "patient") {
  header("Location: /web-tech-project/Management/Auth/MVC/html/login.php");
  exit;
}

$patient_id = (int)($_SESSION["patient_id"] ?? 0);
$doctor_id  = (int)($_POST["doctor_id"] ?? 0);
$date       = trim($_POST["date"] ?? "");
$time       = trim($_POST["time"] ?? "");