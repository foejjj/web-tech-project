<?php
require_once("../../../Auth/MVC/db/db.php");
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
  header("Location: /web-tech-project/Management/Auth/MVC/html/login.php");
  exit;
}

$id = (int)($_GET["id"] ?? 0);
if ($id > 0) {
  $conn->query("UPDATE doctors SET approved=1 WHERE id=$id");
}
header("Location: /web-tech-project/Management/Admin/MVC/html/doctors.php");
exit;



