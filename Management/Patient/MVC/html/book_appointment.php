<?php require_once("../db/db.php"); ?>
<!doctype html>
<html>
<head>
  <title>Book Appointment</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="topbar">
  <strong>Book Appointment</strong>
  <a class="btn gray" href="dashboard.php">Back</a>
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
    <h2 class="page-title">Appointment Form</h2>

    <div class="panel">
      <form method="post" action="../php/book_appointment.php">
        <select name="doctor" required>
          <option value="">Select Doctor</option>
          <?php
          $res=$conn->query("SELECT id,name FROM doctors WHERE approved=1");
          while($d=$res->fetch_assoc()):
          ?>
            <option value="<?= $d["id"] ?>"><?= $d["name"] ?></option>
          <?php endwhile; ?>
        </select>

        <input type="date" name="date" required>
        <input type="time" name="time" required>

        <button>Confirm Appointment</button>
      </form>
    </div>

  </div>
</div>

</body>
</html>
