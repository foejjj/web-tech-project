<?php include "_layout_top.php"; ?>

<h2 class="page-title">Request Lab Test</h2>

<div class="panel">
  <form method="post" action="../php/save_lab_test.php">
    <label>Patient</label>
    <select name="patient_id" required>
      <option value="">Select Patient</option>
      <?php
      $doctor_id = (int)($_SESSION["doctor_id"] ?? 0);
      $res = $conn->query("
        SELECT DISTINCT p.id, p.name
        FROM appointments a
        JOIN patients p ON p.id = a.patient_id
        WHERE a.doctor_id = $doctor_id
        ORDER BY p.name
      ");
      if ($res) {
        while($p = $res->fetch_assoc()):
      ?>
        <option value="<?= (int)$p["id"] ?>"><?= htmlspecialchars($p["name"]) ?></option>
      <?php
        endwhile;
      }
      ?>
    </select>

    <label>Test Type</label>
    <input type="text" name="test_type" placeholder="e.g. Blood Test" required>

    <button type="submit">Request</button>
  </form>
</div>

<?php include "_layout_bottom.php"; ?>
