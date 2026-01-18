<?php include "_layout_top.php"; ?>

<h2>My Appointments</h2>

<?php if(isset($_GET["msg"])): ?>
  <p style="color:green"><?= htmlspecialchars($_GET["msg"]) ?></p>
<?php endif; ?>

<table>
<tr>
  <th>Date</th>
  <th>Time</th>
  <th>Doctor</th>
  <th>Status</th>
</tr>

<?php
$pid = (int)$_SESSION["patient_id"];
$q = "
  SELECT a.date, a.time, a.status, d.name
  FROM appointments a
  JOIN doctors d ON d.id=a.doctor_id
  WHERE a.patient_id=$pid
  ORDER BY a.date DESC, a.time DESC
";
$res = $conn->query($q);

while($r = $res->fetch_assoc()):
?>
<tr>
  <td><?= $r["date"] ?></td>
  <td><?= $r["time"] ?></td>
  <td><?= htmlspecialchars($r["name"]) ?></td>
  <td><?= $r["status"] ?></td>
</tr>
<?php endwhile; ?>
</table>

<?php include "_layout_bottom.php"; ?>
