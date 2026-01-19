<?php
require_once("../../../Auth/MVC/db/db.php");

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "doctor") {
  header("Location: /web-tech-project/Management/Auth/MVC/html/login.php");
  exit;
}

$user_id = (int)($_SESSION["user_id"] ?? 0);
$doctor_id = (int)($_SESSION["doctor_id"] ?? 0);
$action = $_POST["action"] ?? "";