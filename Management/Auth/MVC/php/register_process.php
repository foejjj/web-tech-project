
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