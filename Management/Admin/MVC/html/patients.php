<?php include "_layout_top.php"; ?>
<h2 class="page-title">Patients</h2>
<table>
  <tr>
    <th>Name</th>
    <th>Phone</th>
    <th>User ID</th>
  </tr>

<?php
$res = $conn->query("SELECT id,user_id,name,phone FROM patients ORDER BY id DESC");
if ($res) {
  while ($p = $res->fetch_assoc()):
?>
  <tr>
    <td><?= htmlspecialchars($p["name"]) ?></td>
    <td><?= htmlspecialchars($p["phone"]) ?></td>
    <td><?= (int)$p["user_id"] ?></td>
  </tr>
<?php
  endwhile;
}
?>
</table>

<?php include "_layout_bottom.php"; ?>
