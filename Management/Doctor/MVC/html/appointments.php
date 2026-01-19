<?php include "_layout_top.php"; ?>

<h2>My Appointments</h2>

<table>
<tr>
  <th>Date</th>
  <th>Time</th>
  <th>Patient</th>
  <th>Status</th>
</tr>

<?php
$did = (int)$_SESSION["doctor_id"];
$q = "
  SELECT a.date,a.time,a.status,p.name
  FROM appointments a
  JOIN patients p ON p.id=a.patient_id
  WHERE a.doctor_id = $did AND a.approved = 1
  ORDER BY a.date DESC, a.time DESC
";
$res = $conn->query($q);