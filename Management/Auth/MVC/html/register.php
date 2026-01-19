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
           <input name="name" id="name" placeholder="Full Name" required>
      <input name="email" id="email" type="email" placeholder="Email" required>
      <input name="phone" id="phone" placeholder="Phone (01XXXXXXXXX)" required>

      <label style="margin-top:8px;">Date of Birth</label>
      <input name="dob" id="dob" type="date" required>

      <label style="margin-top:8px;">Gender</label>
      <select name="gender" id="gender" required>
        <option value="">-- Select --</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
      </select>

      <input name="password" id="password" type="password" placeholder="Password" required>

     
      <input name="confirm_password" id="confirm_password" type="password" placeholder="Confirm Password" required>
