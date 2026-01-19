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
        <label>Medicines / Advice</label>
    <textarea name="medicines" rows="5" placeholder="Write prescription..." required></textarea>

    <button type="submit">Save Prescription</button>
  </form>
</div>

<div class="card" style="margin-top:16px;">
  <h3>My Written Prescriptions</h3>

  <table>
    <tr>
      <th>Date</th>
      <th>Patient</th>
      <th>Prescription</th>
    </tr>

    <?php
    $did = (int)($_SESSION["doctor_id"] ?? 0);
    $q2 = "
      SELECT pr.created_at, pr.medicines, p.name AS patient
      FROM prescriptions pr
      JOIN patients p ON p.id = pr.patient_id
      WHERE pr.doctor_id = $did
      ORDER BY pr.created_at DESC
    ";
    $res2 = $conn->query($q2);
    while($r = $res2->fetch_assoc()):
    ?>
      <tr>
        <td><?= htmlspecialchars($r["created_at"]) ?></td>
        <td><?= htmlspecialchars($r["patient"]) ?></td>
        <td><?= nl2br(htmlspecialchars($r["medicines"])) ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
</div>