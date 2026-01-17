<?php
require_once("../../../Auth/MVC/db/db.php");
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "doctor") {
  header("Location: /web-tech-project/Management/Auth/MVC/html/login.php");
  exit;
}

$doctor_id = (int)($_SESSION["doctor_id"] ?? 0);
$patient_id = (int)($_POST["patient_id"] ?? 0);
$test_type = trim($_POST["test_type"] ?? "");

if ($patient_id <= 0 || $test_type === "") {
  header("Location: /web-tech-project/Management/Doctor/MVC/html/request_lab_test.php");
  exit;
}

$st = $conn->prepare("INSERT INTO lab_tests(patient_id, doctor_id, test_type, status) VALUES(?,?,?, 'requested')");
$st->bind_param("iis", $patient_id, $doctor_id, $test_type);
$st->execute();

header("Location: /web-tech-project/Management/Doctor/MVC/html/dashboard.php");
exit;
