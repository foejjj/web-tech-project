<?php include "_layout_top.php"; ?>

<h2 class="page-title">Appointments</h2>

<table>
  <tr>
    <th>Date</th>
    <th>Time</th>
    <th>Patient</th>
    <th>Doctor</th>
    <th>Status</th>
  </tr>

<?php
$sql = "
  SELECT a.date,a.time,a.status, p.name AS patient_name, d.name AS doctor_name
  FROM appointments a
  JOIN patients p ON p.id=a.patient_id
  JOIN doctors d ON d.id=a.doctor_id
  ORDER BY a.date DESC, a.time DESC
";
$res = $conn->query($sql);

if ($res) {
  while ($a = $res->fetch_assoc()):
?>
  <tr>
    <td><?= htmlspecialchars($a["date"]) ?></td>
    <td><?= htmlspecialchars($a["time"]) ?></td>
    <td><?= htmlspecialchars($a["patient_name"]) ?></td>
    <td><?= htmlspecialchars($a["doctor_name"]) ?></td>
    <td><?= htmlspecialchars($a["status"]) ?></td>
  </tr>
<?php
  endwhile;
}
?>
</table>

<?php include "_layout_bottom.php"; ?>
