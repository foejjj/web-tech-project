<?php
require_once("../../../Auth/MVC/db/db.php");

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "patient") {
  header("Location: /web-tech-project/Management/Auth/MVC/html/login.php");
  exit;
}

include "_layout_top.php";

$pid = (int)($_SESSION["patient_id"] ?? 0);

$sql = "
SELECT pr.created_at, pr.medicines, d.name AS doctor_name
FROM prescriptions pr
JOIN doctors d ON d.id = pr.doctor_id
WHERE pr.patient_id = $pid
ORDER BY pr.created_at DESC
";
$res = $conn->query($sql);
?>

<h2 class="page-title">My Prescriptions</h2>

<div class="table-card">
  <table class="table">
    <thead>
      <tr>
        <th style="width:180px;">Date</th>
        <th style="width:150px;">Doctor</th>
        <th>Prescription</th>
      </tr>
    </thead>
    <tbody>
      <?php if($res && $res->num_rows > 0): ?>
        <?php while($row = $res->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row["created_at"]) ?></td>
            <td><?= htmlspecialchars($row["doctor_name"]) ?></td>
            <td><?= nl2br(htmlspecialchars($row["medicines"])) ?></td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="3">No prescriptions found.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<?php include "_layout_bottom.php"; ?>