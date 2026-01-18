<?php include "_layout_top.php"; ?>

<h2 class="page-title">Prescriptions</h2>

<table>
  <tr>
    <th>Date</th>
    <th>Patient</th>
    <th>Doctor</th>
    <th>Medicines / Instructions</th>
  </tr>

<?php
$sql = "
  SELECT pr.created_at, pr.medicines, p.name AS patient_name, d.name AS doctor_name
  FROM prescriptions pr
  JOIN patients p ON p.id=pr.patient_id
  JOIN doctors d ON d.id=pr.doctor_id
  ORDER BY pr.created_at DESC
";
$res = $conn->query($sql);

if ($res) {
  while ($r = $res->fetch_assoc()):
?>
  <tr>
    <td><?= htmlspecialchars($r["created_at"]) ?></td>
    <td><?= htmlspecialchars($r["patient_name"]) ?></td>
    <td><?= htmlspecialchars($r["doctor_name"]) ?></td>
    <td><?= nl2br(htmlspecialchars($r["medicines"])) ?></td>
  </tr>
<?php
  endwhile;
}
?>
</table>

<?php include "_layout_bottom.php"; ?>
