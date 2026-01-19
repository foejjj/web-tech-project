<?php
require_once("../../../Auth/MVC/db/db.php");

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "patient") {
  header("Location: /web-tech-project/Management/Auth/MVC/html/login.php");
  exit;
}

$patient_id = (int)($_SESSION["patient_id"] ?? 0);
$doctor_id  = (int)($_POST["doctor_id"] ?? 0);
$date       = trim($_POST["date"] ?? "");
$time       = trim($_POST["time"] ?? "");

if ($patient_id<=0 || $doctor_id<=0 || $date==="" || $time==="") {
  header("Location: ../html/book_appointment.php?err=Fill+all+fields");
  exit;
}

$status = "scheduled";

$st = $conn->prepare("INSERT INTO appointments(patient_id, doctor_id, date, time, status) VALUES(?,?,?,?,?)");
$st->bind_param("iisss", $patient_id, $doctor_id, $date, $time, $status);
$ok = $st->execute();