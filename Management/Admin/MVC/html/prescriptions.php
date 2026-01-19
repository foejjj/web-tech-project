<?php
require_once("../../../Auth/MVC/db/db.php");

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
  header("Location: /web-tech-project/Management/Auth/MVC/html/login.php");
  exit;
}

$displayName = $_SESSION["name"] ?? "Admin";
?>
<!doctype html>
<html>
<head>
  <title>Admin - Prescriptions</title>
  <link rel="stylesheet" href="/web-tech-project/Management/Admin/MVC/css/style.css">
</head>
<body>

<div class="topbar">
  <div class="brand">Admin Panel</div>
  <div class="user"><?= htmlspecialchars($displayName) ?></div>
</div>

<div class="layout">
  <div class="sidebar">
    <a href="/web-tech-project/Management/Admin/MVC/html/dashboard.php">Dashboard</a>
    <a href="/web-tech-project/Management/Admin/MVC/html/doctors.php">Doctors</a>
    <a href="/web-tech-project/Management/Admin/MVC/html/patients.php">Patients</a>
    <a href="/web-tech-project/Management/Admin/MVC/html/appointments.php">Appointments</a>
    <a class="active" href="/web-tech-project/Management/Admin/MVC/html/prescriptions.php">Prescriptions</a>
    <a href="/web-tech-project/Management/Auth/MVC/php/logout.php">Logout</a>
  </div>

  <div class="content">
    <h2 class="page-title">All Prescriptions</h2>

    <table>
      <tr>
        <th>Date</th>
        <th>Patient</th>
        <th>Doctor</th>
        <th>Prescription</th>
      </tr>

      <?php
      $q = "
        SELECT pr.created_at, pr.medicines,
               p.name AS patient,
               d.name AS doctor
        FROM prescriptions pr
        JOIN patients p ON p.id = pr.patient_id
        JOIN doctors d ON d.id = pr.doctor_id
        ORDER BY pr.created_at DESC
      ";
      $res = $conn->query($q);
      while($r = $res->fetch_assoc()):
      ?>
        <tr>
          <td><?= htmlspecialchars($r["created_at"]) ?></td>
          <td><?= htmlspecialchars($r["patient"]) ?></td>
          <td><?= htmlspecialchars($r["doctor"]) ?></td>
          <td><?= nl2br(htmlspecialchars($r["medicines"])) ?></td>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>
</div>

</body>
</html>
