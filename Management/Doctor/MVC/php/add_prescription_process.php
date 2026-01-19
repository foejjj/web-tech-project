<?php
require_once("../../../Auth/MVC/db/db.php");

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "doctor") {
  header("Location: /web-tech-project/Management/Auth/MVC/html/login.php");
  exit;
}

$did = (int)($_SESSION["doctor_id"] ?? 0);
$pid = (int)($_POST["patient_id"] ?? 0);
$med = trim($_POST["medicines"] ?? "");

if ($did <= 0 || $pid <= 0 || $med === "") {
  header("Location: ../html/prescriptions.php?err=Fill+all+fields");
  exit;
}

$chk = $conn->query("SELECT id FROM appointments WHERE doctor_id=$did AND patient_id=$pid LIMIT 1")->fetch_assoc();
if (!$chk) {
  header("Location: ../html/prescriptions.php?err=Invalid+patient+selection");
  exit;
}

$st = $conn->prepare("INSERT INTO prescriptions(patient_id, doctor_id, medicines) VALUES(?,?,?)");
$st->bind_param("iis", $pid, $did, $med);
$ok = $st->execute();
$st->close();

if (!$ok) {
  header("Location: ../html/prescriptions.php?err=DB+Insert+Failed");
  exit;
}

header("Location: ../html/prescriptions.php?msg=Prescription+saved");
exit;