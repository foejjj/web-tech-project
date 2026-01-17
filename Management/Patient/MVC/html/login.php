<?php
require_once("../../../Auth/MVC/db/db.php");
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "patient") {
  header("Location: /web-tech-project/Management/Auth/MVC/html/login.php");
  exit;
}
?>

<!doctype html>
<html>
<head>
  <title>Patient Login</title>
  <link rel="stylesheet" href="/web-tech-project/Management/Patient/MVC/css/style.css">
</head>
<body>

<div class="auth-container">
  <div class="auth-box">
    <h2>Patient Login</h2>

    <form method="post" action="../php/login_process.php">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button>Login</button>
    </form>

    <p style="text-align:center;margin-top:10px">
      New patient? <a href="register.php">Register</a>
    </p>
  </div>
</div>

</body>
</html>
<a href="/web-tech-project/Management/Auth/MVC/php/logout.php">Logout</a>
