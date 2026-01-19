
<?php
require_once("../db/db.php");

function goErr($msg) {
  $m = urlencode($msg);
  header("Location: /web-tech-project/Management/Auth/MVC/html/register.php?err=$m");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  goErr("Invalid request");
}

$role   = $_POST["role"] ?? "";
$name   = trim($_POST["name"] ?? "");
$email  = trim($_POST["email"] ?? "");
$phone  = trim($_POST["phone"] ?? "");
$dob    = trim($_POST["dob"] ?? "");
$gender = trim($_POST["gender"] ?? "");
$pass   = $_POST["password"] ?? "";
$cpass  = $_POST["confirm_password"] ?? "";
$spec   = trim($_POST["specialization"] ?? "");

if ($role !== "patient" && $role !== "doctor") goErr("Please select role.");

if ($name==="" || $email==="" || $phone==="" || $dob==="" || $gender==="" || $pass==="" || $cpass==="") {
  goErr("All fields required.");
}

if (!preg_match('/^[A-Za-z\s]{3,}$/', $name)) goErr("Name must be 3+ letters (A-Z) and spaces only.");

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) goErr("Invalid email format.");

if (!preg_match('/^01\d{9}$/', $phone)) goErr("Phone must be 11 digits and start with 01.");

if (!in_array($gender, ["male","female","other"], true)) goErr("Invalid gender.");

if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}$/', $pass)) {
  goErr("Password must be 8+ chars with uppercase, lowercase, number & special character.");
}
if ($pass !== $cpass) goErr("Passwords do not match.");

if ($role==="doctor" && $spec==="") goErr("Doctor specialization is required.");


$check = $conn->prepare("SELECT id FROM users WHERE email=? LIMIT 1");
$check->bind_param("s", $email);
$check->execute();
$exists = $check->get_result()->fetch_assoc();
$check->close();
if ($exists) goErr("Email already exists.");

$hash = password_hash($pass, PASSWORD_BCRYPT);

$conn->begin_transaction();
try {

  $st = $conn->prepare("INSERT INTO users(role,email,password_hash,status) VALUES(?,?,?,'active')");
  $st->bind_param("sss", $role, $email, $hash);
  $st->execute();
  $user_id = $conn->insert_id;
  $st->close();

  if ($role === "patient") {
    $st2 = $conn->prepare("INSERT INTO patients(user_id,name,phone,dob,gender) VALUES(?,?,?,?,?)");
    $st2->bind_param("issss", $user_id, $name, $phone, $dob, $gender);
    $st2->execute();
    $st2->close();

    $conn->commit();
    header("Location: /web-tech-project/Management/Auth/MVC/html/login.php?msg=registered");
    exit;
  }
   if ($role === "doctor") {
    $approved = 0;
    $st3 = $conn->prepare("INSERT INTO doctors(user_id,name,specialization,phone,dob,gender,approved,status) VALUES(?,?,?,?,?,?,?,'active')");
    $st3->bind_param("isssssi", $user_id, $name, $spec, $phone, $dob, $gender, $approved);
    $st3->execute();
    $st3->close();

    $conn->commit();
    header("Location: /web-tech-project/Management/Auth/MVC/html/login.php?msg=doctor_pending");
    exit;
  }

  $conn->rollback();
  goErr("Unknown role");

} catch (Throwable $e) {
  $conn->rollback();
  goErr("Server error. Try again.");
}
