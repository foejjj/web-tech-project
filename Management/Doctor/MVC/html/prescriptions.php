<?php include "_layout_top.php"; ?>

<h2 class="page-title">Prescriptions</h2>

<?php if (isset($_GET["msg"])): ?>
  <div class="alert success"><?= htmlspecialchars($_GET["msg"]) ?></div>
<?php endif; ?>

<?php if (isset($_GET["err"])): ?>
  <div class="alert error"><?= htmlspecialchars($_GET["err"]) ?></div>
<?php endif; ?>

<div class="card">
  <h3>Write Prescription</h3>

  <form method="post" action="../php/add_prescription_process.php">
    <label>Select Patient</label>
    <select name="patient_id" required>
      <option value="">-- Select --</option>
      <?php
      $did = (int)($_SESSION["doctor_id"] ?? 0);
      $q = "
        SELECT DISTINCT p.id, p.name
        FROM appointments a
        JOIN patients p ON p.id = a.patient_id
        WHERE a.doctor_id = $did
        ORDER BY p.name ASC
      ";
      $res = $conn->query($q);
      while($r = $res->fetch_assoc()):
      ?>
        <option value="<?= (int)$r["id"] ?>"><?= htmlspecialchars($r["name"]) ?></option>
      <?php endwhile; ?>
    </select>