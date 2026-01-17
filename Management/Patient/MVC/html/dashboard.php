<?php require_once("../db/db.php"); ?>
<h2>Welcome <?= $_SESSION["pname"] ?></h2>
<ul>
  <li><a href="book_appointment.php">Book Appointment</a></li>
  <li><a href="appointments.php">My Appointments</a></li>
  <li><a href="prescriptions.php">My Prescriptions</a></li>
  <li><a href="../php/logout.php">Logout</a></li>
</ul>
