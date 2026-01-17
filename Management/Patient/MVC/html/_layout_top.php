<?php
require_once("../../../Auth/MVC/db/db.php");

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "patient") {
  header("Location: /web-tech-project/Management/Auth/MVC/html/login.php");
  exit;
}

$displayName = $_SESSION["name"] ?? "Patient";
?>
<!doctype html>
<html>
<head>
  <title>Patient Portal</title>
  <link rel="stylesheet" href="/web-tech-project/Management/Patient/MVC/css/style.css">
</head>
<body>

<div class="topbar">
  <div class="brand">Patient Portal</div>
  <div class="user"><?= htmlspecialchars($displayName) ?></div>
</div>

<div class="layout">
  <div class="sidebar">
    <a href="dashboard.php">Dashboard</a>
    <a href="book_appointment.php">Book Appointment</a>
    <a href="appointments.php">Appointments</a>
    <a href="prescriptions.php">Prescriptions</a>
    <a href="/web-tech-project/Management/Auth/MVC/php/logout.php">Logout</a>
  </div>

  <div class="content">
