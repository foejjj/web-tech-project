<!doctype html>
<html>
<head>
  <title>Patient Login</title>
  <link rel="stylesheet" href="../css/style.css">
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
