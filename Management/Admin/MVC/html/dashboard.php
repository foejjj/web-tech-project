<?php include "_layout_top.php"; ?>

<h2 class="page-title">Dashboard</h2>

<div class="card-grid">
  <div class="card">
    <h3>Doctors</h3>
    <p>Approve pending doctors and manage status.</p>
    <a class="btn" href="doctors.php">Open</a>
  </div>
  
  <div class="card">
    <h3>Patients</h3>
    <p>View registered patients list.</p>
    <a class="btn gray" href="patients.php">Open</a>
  </div>

  <div class="card">
    <h3>Appointments</h3>
    <p>View all appointments.</p>
    <a class="btn gray" href="appointments.php">Open</a>
  </div>

  <div class="card">
    <h3>Prescriptions</h3>
    <p>View prescriptions created by doctors.</p>
    <a class="btn gray" href="prescriptions.php">Open</a>
  </div>
</div>

<?php include "_layout_bottom.php"; ?>