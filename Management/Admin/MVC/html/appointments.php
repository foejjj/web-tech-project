<?php
require_once("../../../Auth/MVC/db/db.php");

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../Auth/MVC/html/login.php");
    exit;
}

$q = "
SELECT a.id, a.date, a.time, a.status, a.approved,
       p.name AS patient_name,
       d.name AS doctor_name
FROM appointments a
JOIN patients p ON p.id = a.patient_id
JOIN doctors d ON d.id = a.doctor_id
ORDER BY a.date DESC, a.time DESC
";

$res = $conn->query($q);
?>