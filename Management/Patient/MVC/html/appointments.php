<?php
require_once("../../../Auth/MVC/db/db.php");
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "patient") {
  header("Location: /web-tech-project/Management/Auth/MVC/html/login.php");
  exit;
}
?>


<?php include "_layout_top.php"; ?>

<h2 class="page-title">My Appointments</h2>

<table>
  <tr>
    <th>Date</th>
    <th>Time</th>
    <th>Doctor</th>
    <th>Status</th>
  </tr>

  <?php
  $res=$conn->query("
    SELECT a.date,a.time,a.status,d.name
    FROM appointments a
    JOIN doctors d ON d.id=a.doctor_id
    WHERE a.patient_id=".$_SESSION["patient_id"]
  );
  while($r=$res->fetch_assoc()):
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
