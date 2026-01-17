<?php include "_layout_top.php"; ?>

<h2 class="page-title">Dashboard</h2>

<div class="card-grid">
  <div class="card">
    <h3>Appointments</h3>
    <p>View assigned patient appointments.</p>
    <a class="btn" href="appointments.php">Open</a>
  </div>

  <div class="card">
    <h3>Write Prescription</h3>
    <p>Create a prescription for a patient.</p>
    <a class="btn gray" href="appointments.php">Select Appointment</a>
  </div>

  <div class="card">
    <h3>Request Lab Test</h3>
    <p>Request or upload a lab test entry.</p>
    <a class="btn gray" href="request_lab_test.php">Request</a>
  </div>
</div>

<?php include "_layout_bottom.php"; ?>
