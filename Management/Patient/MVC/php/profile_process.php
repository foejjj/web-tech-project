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

if ($action === "name") {
  $name = trim($_POST["name"] ?? "");
  if ($name === "") {
    header("Location: ../html/profile.php?err=Name+required");
    exit;
  }
  
  $st = $conn->prepare("UPDATE patients SET name=? WHERE id=? AND user_id=?");
  $st->bind_param("sii", $name, $patient_id, $user_id);
  $ok = $st->execute();
  $st->close();

  if (!$ok) {
    header("Location: ../html/profile.php?err=DB+error");
    exit;
  }

  $_SESSION["name"] = $name;
  header("Location: ../html/profile.php?msg=Name+updated");
  exit;
}  