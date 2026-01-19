<?php require_once("../db/db.php"); ?>
<!doctype html>
<html>
<head>
  <title>Register</title>
  <link rel="stylesheet" href="/web-tech-project/Management/Auth/MVC/css/style.css">
</head>
<body>

<div class="auth-container">
  <div class="auth-box">
    <h2>Registration</h2>

    <?php if(isset($_GET["err"])): ?>
      <div class="alert error"><?= htmlspecialchars($_GET["err"]) ?></div>
    <?php endif; ?>

    <div id="liveMsg" class="alert" style="display:none;"></div>

    <form id="regForm" method="post" action="../php/register_process.php" novalidate>
      <label>Register As</label>
      <select name="role" id="role" required>
        <option value="">-- Select --</option>
        <option value="patient">Patient</option>
        <option value="doctor">Doctor</option>
      </select>