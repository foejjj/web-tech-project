
<?php
require_once("../db/db.php");

$email = trim($_POST["email"] ?? "");
$pass  = $_POST["password"] ?? "";

if ($email === "" || $pass === "") {
  header("Location: ../html/login.php?err=Email+and+password+required");
  exit;
}

if ($email === ADMIN_EMAIL && $pass === ADMIN_PASSWORD) {
  $_SESSION["user_id"] = 0;
  $_SESSION["role"] = "admin";
  $_SESSION["name"] = "Admin";
  header("Location: /web-tech-project/Management/Admin/MVC/html/dashboard.php");
  exit;
}