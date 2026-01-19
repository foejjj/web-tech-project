<?php
require_once("../../../Auth/MVC/db/db.php");

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "patient") {
  header("Location: /web-tech-project/Management/Auth/MVC/html/login.php");
  exit;
}

include "_layout_top.php";

$pid = (int)($_SESSION["patient_id"] ?? 0);

$sql = "
SELECT pr.created_at, pr.medicines, d.name AS doctor_name
FROM prescriptions pr
JOIN doctors d ON d.id = pr.doctor_id
WHERE pr.patient_id = $pid
ORDER BY pr.created_at DESC
";
$res = $conn->query($sql);
?>