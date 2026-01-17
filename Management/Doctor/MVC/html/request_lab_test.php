<?php include "_layout_top.php"; ?>

<?php
$doctor_id = (int)($_SESSION["doctor_id"] ?? 0);
$appointment_id = (int)($_GET["appointment_id"] ?? 0);

$appt = null;
if ($appointment_id > 0) {
  $q = $conn->query("
    SELECT a.id, a.patient_id, p.name AS patient_name
    FROM appointments a
    JOIN patients p ON p.id = a.patient_id
    WHERE a.id = $appointment_id AND a.doctor_id = $doctor_id
    LIMIT 1
  ");
  $appt = $q ? $q->fetch_assoc() : null;
}
?>

<h2 class="page-title">Write Prescription</h2>

<?php if (!$appt): ?>
  <div class="panel">
    Invalid appointment.
  </div>
<?php else: ?>
  <div class="panel">
    <p><b>Patient:</b> <?= htmlspecialchars($appt["patient_name"]) ?></p>
    <br>

    <form method="post" action="../php/save_prescription.php">
      <input type="hidden" name="appointment_id" value="<?= (int)$appt["id"] ?>">
      <input type="hidden" name="patient_id" value="<?= (int)$appt["patient_id"] ?>">

      <label>Medicines / Instructions</label>
      <textarea name="medicines" required style="width:100%;height:140px;padding:10px;border:1px solid #e5e7eb;border-radius:10px;"></textarea>

      <br><br>
      <button type="submit">Save Prescription</button>
    </form>
  </div>
<?php endif; ?>

<?php include "_layout_bottom.php"; ?>
