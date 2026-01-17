<?php
require_once("../../../Auth/MVC/db/db.php");
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "patient") {
  header("Location: /web-tech-project/Management/Auth/MVC/html/login.php");
  exit;
}
?>


<form method="post" action="../php/register_process.php">
  <h2>Patient Registration</h2>
  <input name="name" placeholder="Name" required>
  <input name="email" type="email" placeholder="Email" required>
  <input name="phone" placeholder="Phone" required>
  <input name="password" type="password" placeholder="Password" required>
  <button>Register</button>
</form>
<a href="login.php">Login</a>
<a href="/web-tech-project/Management/Auth/MVC/php/logout.php">Logout</a>
