<?php
require_once("../../../Auth/MVC/db/db.php");

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
  header("Location: /web-tech-project/Management/Auth/MVC/html/login.php");
  exit;
}

$displayName = $_SESSION["name"] ?? "Admin";
?>
<!doctype html>
<html>
<head>
  <title>Admin Panel</title>
  <link rel="stylesheet" href="/web-tech-project/Management/Admin/MVC/css/style.css">
</head>
<body>

<div class="topbar">
  <div class="brand">Admin Panel</div>
  <div class="user"><?= htmlspecialchars($displayName) ?></div>
</div>

<div class="layout">
  <div class="sidebar">
    <a href="/web-tech-project/Management/Admin/MVC/html/dashboard.php">Dashboard</a>
    <a href="/web-tech-project/Management/Admin/MVC/html/doctors.php">Doctors</a>
    <a href="/web-tech-project/Management/Admin/MVC/html/patients.php">Patients</a>
    <a href="/web-tech-project/Management/Admin/MVC/html/appointments.php">Appointments</a>
    <a href="/web-tech-project/Management/Admin/MVC/html/prescriptions.php">Prescriptions</a>
    <a href="/web-tech-project/Management/Auth/MVC/php/logout.php">Logout</a>
  </div>
  <div class="content">
