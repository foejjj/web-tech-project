
<?php require_once("../db/db.php"); ?>
<!doctype html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="/web-tech-project/Management/Auth/MVC/css/style.css">
</head>
<body>

<div class="auth-container">
  <div class="auth-box">
    <h2>Login</h2>

    <?php if(isset($_GET["msg"]) && $_GET["msg"]==="registered"): ?>
      <div class="alert success">Registration complete. Please login.</div>
    <?php endif; ?>

    <?php if(isset($_GET["msg"]) && $_GET["msg"]==="doctor_pending"): ?>
      <div class="alert success">Doctor registered. Wait for admin approval.</div>
    <?php endif; ?>
