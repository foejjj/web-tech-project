<?php include "_layout_top.php"; ?>

<h2 class="page-title">My Appointments</h2>

<?php if(isset($_GET["msg"])): ?>
  <div class="panel"><?= htmlspecialchars($_GET["msg"]) ?></div><br>
<?php endif; ?>

<table>
  <tr>
    <th>Date</th>
    <th>Time</th>
    <th>Doctor</th>
    <th>Status</th>
  </tr>

<?php
$patient_id = (int)($_SESSION["patient_id"] ?? 0);

$sql = "
  SELECT a.date,a.time,a.status, d.name AS doctor_name
  FROM appointments a
  JOIN doctors d ON d.id = a.doctor_id
  WHERE a.patient_id = $patient_id
  ORDER BY a.date DESC, a.time DESC
";
$res = $conn->query($sql);

if ($res) {
  while($r = $res->fetch_assoc()):
?>
  <tr>
    <td><?= htmlspecialchars($r["date"]) ?></td>
    <td><?= htmlspecialchars($r["time"]) ?></td>
    <td><?= htmlspecialchars($r["doctor_name"]) ?></td>
    <td><?= htmlspecialchars($r["status"]) ?></td>
  </tr>
<?php
  endwhile;
}
?>
</table>

<?php include "_layout_bottom.php"; ?>
