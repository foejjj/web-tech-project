<?php require_once("../db/db.php"); ?>
<h3>My Prescriptions</h3>
<?php
$res=$conn->query("
SELECT p.medicines,d.name doctor,p.created_at
FROM prescriptions p JOIN doctors d ON d.id=p.doctor_id
WHERE p.patient_id=".$_SESSION["pid"]
);
while($r=$res->fetch_assoc()):
?>
<p><?= $r["created_at"] ?> | <?= $r["doctor"] ?><br><?= $r["medicines"] ?></p>
<?php endwhile; ?>
