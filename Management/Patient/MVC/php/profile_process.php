<?php
require_once("../../../Auth/MVC/db/db.php");

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "patient") {
  header("Location: /web-tech-project/Management/Auth/MVC/html/login.php");
  exit;
}

$user_id = (int)($_SESSION["user_id"] ?? 0);
$patient_id = (int)($_SESSION["patient_id"] ?? 0);
$action = $_POST["action"] ?? "";

if ($user_id <= 0 || $patient_id <= 0) {
  header("Location: ../html/profile.php?err=Session+missing");
  exit;
}