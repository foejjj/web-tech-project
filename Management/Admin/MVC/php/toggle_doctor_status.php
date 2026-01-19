


<?php
require_once("../../../Auth/MVC/db/db.php");
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
  header("Location: /web-tech-project/Management/Auth/MVC/html/login.php");
  exit;
}

$id = (int)($_GET["id"] ?? 0);
if ($id > 0) {
  $d = $conn->query("SELECT status FROM doctors WHERE id=$id LIMIT 1")->fetch_assoc();
  if ($d) {
    $newStatus = ($d["status"] === "active") ? "inactive" : "active";
    $st = $conn->prepare("UPDATE doctors SET status=? WHERE id=?");
    $st->bind_param("si", $newStatus, $id);
    $st->execute();
  }
}
header("Location: /web-tech-project/Management/Admin/MVC/html/doctors.php");
exit;

