<?php include "_layout_top.php"; ?>
<h2 class="page-title">Doctors</h2>
<table>
  <tr>
    <th>Name</th>
    <th>Specialization</th>
    <th>Phone</th>
    <th>Approved</th>
    <th>Status</th>
    <th>Action</th>
  </tr>

<?php
$res = $conn->query("SELECT id,name,specialization,phone,approved,status FROM doctors ORDER BY created_at DESC");

if ($res) {
  while ($d = $res->fetch_assoc()):
    $did = (int)$d["id"];
    $approved = (int)$d["approved"];
?>
  <tr>
    <td><?= htmlspecialchars($d["name"]) ?></td>
    <td><?= htmlspecialchars($d["specialization"]) ?></td>
    <td><?= htmlspecialchars($d["phone"]) ?></td>
    <td><?= $approved ? "Yes" : "No" ?></td>
    <td><?= htmlspecialchars($d["status"]) ?></td>
    <td>
      <?php if (!$approved): ?>
        <a class="btn" href="/web-tech-project/Management/Admin/MVC/php/approve_doctor.php?id=<?= $did ?>">Approve</a>
      <?php endif; ?>

      <a class="btn gray" href="/web-tech-project/Management/Admin/MVC/php/toggle_doctor_status.php?id=<?= $did ?>">
        Toggle Status
      </a>
    </td>
  </tr>
<?php
  endwhile;
}
?>
</table>

<?php include "_layout_bottom.php"; ?>

