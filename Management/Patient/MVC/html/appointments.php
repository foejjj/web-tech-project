<?php require_once("../db/db.php"); ?>
<!doctype html>
<html>
<head>
  <title>My Appointments</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="topbar">
  <strong>My Appointments</strong>
  <a class="btn gray" href="dashboard.php">Back</a>
</div>

<div class="content">
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
      FROM appointments a JOIN doctors d ON d.id=a.doctor_id
      WHERE a.patient_id=".$_SESSION["pid"]
    );
    while($r=$res->fetch_assoc()):
    ?>
    <tr>
      <td><?= $r["date"] ?></td>
      <td><?= $r["time"] ?></td>
      <td><?= $r["name"] ?></td>
      <td><?= $r["status"] ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>

</body>
</html>
