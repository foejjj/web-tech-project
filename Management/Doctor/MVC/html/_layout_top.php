<?php
require_once("../../../Auth/MVC/db/db.php");
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "doctor") {
  header("Location: /web-tech-project/Management/Auth/MVC/html/login.php");
  exit;
}
$displayName = $_SESSION["name"] ?? "Doctor";
?>
<!doctype html>
<html>
<head>
  <title>Doctor Portal</title>
  <link rel="stylesheet" href="/web-tech-project/Management/Doctor/MVC/css/style.css">
</head>
<body>

<div class="topbar">
  <div class="brand">Doctor Portal</div>
  <div class="user"><?= htmlspecialchars($displayName) ?></div>
</div>

<div class="layout">
  <div class="sidebar">
    <a href="/web-tech-project/Management/Doctor/MVC/html/dashboard.php">Dashboard</a>
    <a href="/web-tech-project/Management/Doctor/MVC/html/appointments.php">Appointments</a>
    <a href="/web-tech-project/Management/Doctor/MVC/html/prescriptions.php">Prescriptions</a>
    <a href="/web-tech-project/Management/Doctor/MVC/html/profile.php">Profile</a>
    <a href="/web-tech-project/Management/Auth/MVC/php/logout.php">Logout</a>
  </div>
  <div class="content">


