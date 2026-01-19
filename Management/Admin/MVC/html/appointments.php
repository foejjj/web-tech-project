<?php
require_once("../../../Auth/MVC/db/db.php");

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../Auth/MVC/html/login.php");
    exit;
}

$q = "
SELECT a.id, a.date, a.time, a.status, a.approved,
       p.name AS patient_name,
       d.name AS doctor_name
FROM appointments a
JOIN patients p ON p.id = a.patient_id
JOIN doctors d ON d.id = a.doctor_id
ORDER BY a.date DESC, a.time DESC
";

$res = $conn->query($q);
?>

<?php include("_layout_top.php"); ?>

<h2>Appointments</h2>

<table class="table">
  <tr>
    <th>Date</th>
    <th>Time</th>
    <th>Patient</th>
    <th>Doctor</th>
    <th>Status</th>
    <th>Approved</th>
    <th>Action</th>
  </tr>
  
  <?php while($r = $res->fetch_assoc()): ?>
  <tr>
    <td><?= $r['date'] ?></td>
    <td><?= $r['time'] ?></td>
    <td><?= htmlspecialchars($r['patient_name']) ?></td>
    <td><?= htmlspecialchars($r['doctor_name']) ?></td>
    <td><?= $r['status'] ?></td>
    <td><?= $r['approved'] ? "Yes" : "No" ?></td>
    <td>
      <?php if($r['approved']==0): ?>
        <a href="../php/approve_appointment.php?id=<?= $r['id'] ?>"
           onclick="return confirm('Approve this appointment?');">
           Approve
        </a>
      <?php else: ?>
        —
      <?php endif; ?>
    </td>
  </tr>
  <?php endwhile; ?>
</table>

<?php include("_layout_bottom.php"); ?>