<?php require_once("../db/db.php"); ?>
<!doctype html>
<html>
<head>
  <title>Patient Dashboard</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="topbar">
  <strong>Patient Portal</strong>
  <span><?= $_SESSION["pname"] ?></span>
</div>

<div class="layout">
  <div class="sidebar">
    <a href="dashboard.php">Dashboard</a>
    <a href="book_appointment.php">Book Appointment</a>
    <a href="appointments.php">Appointments</a>
    <a href="prescriptions.php">Prescriptions</a>
    <a href="../php/logout.php">Logout</a>
  </div>

  <div class="content">
    <h2 class="page-title">Dashboard</h2>

    <div class="card-grid">
      <div class="card">
        <h3>Book Appointment</h3>
        <p>Schedule appointment with doctors.</p>
        <a class="btn" href="book_appointment.php">Book Now</a>
      </div>

      <div class="card">
        <h3>Appointments</h3>
        <p>View upcoming appointments.</p>
        <a class="btn gray" href="appointments.php">View</a>
      </div>

      <div class="card">
        <h3>Prescriptions</h3>
        <p>Check your prescriptions.</p>
        <a class="btn gray" href="prescriptions.php">Open</a>
      </div>
    </div>

  </div>
</div>

</body>
</html>
