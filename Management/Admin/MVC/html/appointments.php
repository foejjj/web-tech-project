<?php include "_layout_top.php"; ?>

<h2>Appointments</h2>

<table>
<tr>
  <th>Date</th>
  <th>Time</th>
  <th>Patient</th>
  <th>Doctor</th>
  <th>Status</th>
</tr>

<?php
$q = "
  SELECT a.date,a.time,a.status,
         p.name AS patient,
         d.name AS doctor
  FROM appointments a
  JOIN patients p ON p.id=a.patient_id
  JOIN doctors d ON d.id=a.doctor_id
  ORDER BY a.date DESC, a.time DESC
";
$res = $conn->query($q);

while($r = $res->fetch_assoc()):
?>
<tr>
  <td><?= $r["date"] ?></td>
  <td><?= $r["time"] ?></td>
  <td><?= htmlspecialchars($r["patient"]) ?></td>
  <td><?= htmlspecialchars($r["doctor"]) ?></td>
  <td><?= $r["status"] ?></td>
</tr>
<?php endwhile; ?>
</table>

<?php include "_layout_bottom.php"; ?>
