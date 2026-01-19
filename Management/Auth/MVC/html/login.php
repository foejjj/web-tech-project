
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
    
    <?php if(isset($_GET["msg"]) && $_GET["msg"]==="reset_ok"): ?>
      <div class="alert success">Password reset successful. Please login.</div>
    <?php endif; ?>

    <?php if(isset($_GET["err"])): ?>
      <div class="alert error"><?= htmlspecialchars($_GET["err"]) ?></div>
    <?php endif; ?>

    <form method="post" action="../php/login_process.php">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>

    <p class="center">
      New user? <a href="register.php">Register (Patient/Doctor)</a>
    </p>


    <p class="center" style="font-size:13px;color:#6b7280;margin-top:8px;">
      Admin has no registration. Use fixed admin email/password.
    </p>
  </div>
</div>

</body>
</html>


