<?php
require_once("../db/db.php");

$role = $_POST["role"] ?? "";
$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$phone = trim($_POST["phone"] ?? "");
$pass = $_POST["password"] ?? "";
$spec = trim($_POST["specialization"] ?? "");

if ($role !== "patient" && $role !== "doctor") die("Invalid role");
if ($name==="" || $email==="" || $phone==="" || $pass==="") die("All fields required");
if ($role==="doctor" && $spec==="") die("Doctor specialization required");

$check = $conn->prepare("SELECT id FROM users WHERE email=? LIMIT 1");
$check->bind_param("s", $email);
$check->execute();
$exists = $check->get_result()->fetch_assoc();
$check->close();
if ($exists) die("Email already exists");

$hash = password_hash($pass, PASSWORD_BCRYPT);

$conn->begin_transaction();
try {
  $st = $conn->prepare("INSERT INTO users(role,email,password_hash,status) VALUES(?,?,?,'active')");
  $st->bind_param("sss", $role, $email, $hash);
  $st->execute();
  $user_id = $conn->insert_id;
  $st->close();

  if ($role === "patient") {
    $st2 = $conn->prepare("INSERT INTO patients(user_id,name,phone) VALUES(?,?,?)");
    $st2->bind_param("iss", $user_id, $name, $phone);
    $st2->execute();
    $st2->close();

    $conn->commit();
    header("Location: /web-tech-project/Management/Auth/MVC/html/login.php?msg=registered");
    exit;
  }

  if ($role === "doctor") {
    $approved = 0;

    /* If your doctors table has phone column, use this INSERT:
       INSERT INTO doctors(user_id,name,specialization,phone,approved,status)
       Otherwise use the simpler one below.
    */

    $st3 = $conn->prepare("INSERT INTO doctors(user_id,name,specialization,approved,status) VALUES(?,?,?,?, 'active')");
    $st3->bind_param("issi", $user_id, $name, $spec, $approved);
    $st3->execute();
    $st3->close();

    $conn->commit();
    header("Location: /web-tech-project/Management/Auth/MVC/html/login.php?msg=doctor_pending");
    exit;
  }

} catch (Throwable $e) {
  $conn->rollback();
  die("Registration failed");
}
