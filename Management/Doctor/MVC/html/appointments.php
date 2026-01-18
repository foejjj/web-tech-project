<?php include "_layout_top.php"; ?>

<h2 class="page-title">My Appointments</h2>

<table>
  <tr>
    <th>Date</th>
    <th>Time</th>
    <th>Patient</th>
    <th>Status</th>
    <th>Action</th>
  </tr>

  <?php
  $doctor_id = (int)($_SESSION["doctor_id"] ?? 0);

  $sql = "
    SELECT a.id, a.date, a.time, a.status, p.name AS patient_name
    FROM appointments a
    JOIN patients p ON p.id = a.patient_id
    WHERE a.doctor_id = $doctor_id
    ORDER BY a.date DESC, a.time DESC
  ";
  $res = $conn->query($sql);

  if ($res) {
    while ($r = $res->fetch_assoc()):
  ?>
  <tr>
    <td><?= htmlspecialchars($r["date"]) ?></td>
    <td><?= htmlspecialchars($r["time"]) ?></td>
    <td><?= htmlspecialchars($r["patient_name"]) ?></td>
    <td><?= htmlspecialchars($r["status"]) ?></td>
    <td>
      <a class="btn gray" href="write_prescription.php?appointment_id=<?= (int)$r["id"] ?>">Write</a>
    </td>
  </tr>
  <?php
    endwhile;
  }
  ?>
</table>

<?php include "_layout_bottom.php"; ?>
