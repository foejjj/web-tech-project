<!doctype html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<h2>Login</h2>

<form method="post" action="../php/login_process.php">
  <label>Email</label>
  <input type="email" name="email" required>

  <label>Password</label>
  <input type="password" name="password" required>

  <button type="submit">Login</button>
</form>

<p>New user? <a href="register.php">Register</a></p>

</body>
</html>
