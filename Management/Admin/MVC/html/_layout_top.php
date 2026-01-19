<?php
require_once("../../../Auth/MVC/db/db.php");

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
  header("Location: /web-tech-project/Management/Auth/MVC/html/login.php");
  exit;
}
