<?php include "_layout_top.php"; ?>

<h2 class="page-title">Appointments (Admin Approval)</h2>

<table>
  <tr>
    <th>Date</th>
    <th>Time</th>
    <th>Patient</th>
    <th>Doctor</th>
    <th>Status</th>
    <th>Action</th>
  </tr>

<?php
$sql = "
  SELECT a.id,a.date,a.time,a.status,
         p.name AS patient_name,
         d.name AS doctor_name
  FROM appointments a
  JOIN patients p ON p.id=a.patient_id
  JOIN doctors d ON d.id=a.doctor_id
  ORDER BY a.created_at DESC
";
$res = $conn->query($sql);

if ($res) {
  while($r = $res->fetch_assoc()):
    $id = (int)$r["id"];
?>
  <tr>
    <td><?= htmlspecialchars($r["date"]) ?></td>
    <td><?= htmlspecialchars($r["time"]) ?></td>
    <td><?= htmlspecialchars($r["patient_name"]) ?></td>
    <td><?= htmlspecialchars($r["doctor_name"]) ?></td>
    <td><?= htmlspecialchars($r["status"]) ?></td>
    <td>
      <?php if($r["status"] === "pending"): ?>
        <a class="btn" href="/web-tech-project/Management/Admin/MVC/php/approve_appointment.php?id=<?= $id ?>">Approve</a>
      <?php else: ?>
        —
      <?php endif; ?>
    </td>
  </tr>
<?php
  endwhile;
}
?>
</table>

<?php include "_layout_bottom.php"; ?>
