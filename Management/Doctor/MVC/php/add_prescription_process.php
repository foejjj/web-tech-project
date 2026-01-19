<?php
require_once("../../../Auth/MVC/db/db.php");

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "doctor") {
  header("Location: /web-tech-project/Management/Auth/MVC/html/login.php");
  exit;
}

$did = (int)($_SESSION["doctor_id"] ?? 0);
$pid = (int)($_POST["patient_id"] ?? 0);
$med = trim($_POST["medicines"] ?? "");