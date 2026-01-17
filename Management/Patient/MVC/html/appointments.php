<?php require_once("../db/db.php"); ?>
<h3>My Appointments</h3>
<?php
$res=$conn->query("
SELECT a.date,a.time,a.status,d.name doctor
FROM appointments a JOIN doctors d ON d.id=a.doctor_id
WHERE a.patient_id=".$_SESSION["pid"]
);
while($r=$res->fetch_assoc()):
?>
<p><?= $r["date"] ?> | <?= $r["time"] ?> | <?= $r["doctor"] ?> | <?= $r["status"] ?></p>
<?php endwhile; ?>
