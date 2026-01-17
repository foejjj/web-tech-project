<?php
require_once("../../Auth/MVC/db/db.php");
if (!isset($_SESSION["role"]) || $_SESSION["role"]!=="patient") {
  header("Location: /Management/Auth/MVC/html/login.php");
  exit;
}
?>

<h3>My Prescriptions</h3>
<?php
$res=$conn->query("
SELECT p.medicines,d.name doctor,p.created_at
FROM prescriptions p JOIN doctors d ON d.id=p.doctor_id
WHERE p.patient_id=".$_SESSION["patient_id"]
);
while($r=$res->fetch_assoc()):
?>
<p><?= $r["created_at"] ?> | <?= $r["doctor"] ?><br><?= $r["medicines"] ?></p>
<?php endwhile; ?>
<a href="/Management/Auth/MVC/php/logout.php">Logout</a>
