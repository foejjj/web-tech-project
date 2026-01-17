<?php
require_once("../db/db.php");
if (!isset($_SESSION["pid"])) {
  header("Location: login.php");
  exit;
}
?>
<!doctype html>
<html>
<head>
  <title>Patient Portal</title>
  <link rel="stylesheet" href="/Management/Patient/MVC/css/style.css">
</head>
<body>

<div class="topbar">
  <div>Patient Portal</div>
  <div><?= htmlspecialchars($_SESSION["pname"]) ?></div>
</div>

<div class="layout">
  <div class="sidebar">
    <a href="dashboard.php">Dashboard</a>
    <a href="book_appointment.php">Book Appointment</a>
    <a href="appointments.php">Appointments</a>
    <a href="prescriptions.php">Prescriptions</a>
    <a href="../php/logout.php">Logout</a>
  </div>

  <div class="content">
