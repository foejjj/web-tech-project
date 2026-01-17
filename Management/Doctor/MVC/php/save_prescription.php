<?php
require_once("../../../Auth/MVC/db/db.php");
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "doctor") {
  header("Location: /web-tech-project/Management/Auth/MVC/html/login.php");
  exit;
}

$doctor_id = (int)($_SESSION["doctor_id"] ?? 0);
$appointment_id = (int)($_POST["appointment_id"] ?? 0);
$patient_id = (int)($_POST["patient_id"] ?? 0);
$medicines = trim($_POST["medicines"] ?? "");

if ($appointment_id <= 0 || $patient_id <= 0 || $medicines === "") {
  header("Location: /web-tech-project/Management/Doctor/MVC/html/appointments.php");
  exit;
}

$check = $conn->query("
  SELECT id FROM appointments
  WHERE id=$appointment_id AND doctor_id=$doctor_id AND patient_id=$patient_id
  LIMIT 1
")->fetch_assoc();

if (!$check) {
  header("Location: /web-tech-project/Management/Doctor/MVC/html/appointments.php");
  exit;
}

$st = $conn->prepare("INSERT INTO prescriptions(patient_id, doctor_id, medicines) VALUES(?,?,?)");
$st->bind_param("iis", $patient_id, $doctor_id, $medicines);
$st->execute();

header("Location: /web-tech-project/Management/Doctor/MVC/html/appointments.php");
exit;
