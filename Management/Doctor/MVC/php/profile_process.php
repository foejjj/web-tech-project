<?php
require_once("../../../Auth/MVC/db/db.php");

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "doctor") {
  header("Location: /web-tech-project/Management/Auth/MVC/html/login.php");
  exit;
}

$user_id = (int)($_SESSION["user_id"] ?? 0);
$doctor_id = (int)($_SESSION["doctor_id"] ?? 0);
$action = $_POST["action"] ?? "";

if ($user_id <= 0 || $doctor_id <= 0) {
  header("Location: ../html/profile.php?err=Session+missing");
  exit;
}

if ($action === "name") {
  $name = trim($_POST["name"] ?? "");
  if ($name === "") {
    header("Location: ../html/profile.php?err=Name+required");
    exit;
  }

  $st = $conn->prepare("UPDATE doctors SET name=? WHERE id=? AND user_id=?");
  $st->bind_param("sii", $name, $doctor_id, $user_id);
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

if ($action === "password") {
  $old = $_POST["old_password"] ?? "";
  $new = $_POST["new_password"] ?? "";
  $c   = $_POST["confirm_password"] ?? "";

  if ($old==="" || $new==="" || $c==="") {
    header("Location: ../html/profile.php?err=All+password+fields+required");
    exit;
  }
  if ($new !== $c) {
    header("Location: ../html/profile.php?err=New+password+not+matched");
    exit;
  }
  if (strlen($new) < 4) {
    header("Location: ../html/profile.php?err=Password+too+short");
    exit;
  }

  $st = $conn->prepare("SELECT password_hash FROM users WHERE id=? LIMIT 1");
  $st->bind_param("i", $user_id);
  $st->execute();
  $u = $st->get_result()->fetch_assoc();
  $st->close();

  if (!$u || !password_verify($old, $u["password_hash"])) {
    header("Location: ../html/profile.php?err=Old+password+wrong");
    exit;
  }

  $hash = password_hash($new, PASSWORD_BCRYPT);
  $st2 = $conn->prepare("UPDATE users SET password_hash=? WHERE id=?");
  $st2->bind_param("si", $hash, $user_id);
  $ok = $st2->execute();
  $st2->close();

    if (!$ok) {
    header("Location: ../html/profile.php?err=DB+error");
    exit;
  }

  header("Location: ../html/profile.php?msg=Password+updated");
  exit;
}