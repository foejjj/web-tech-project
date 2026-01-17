<?php
$title = "Book Appointment";
include MVC_PATH . '/html/partials/head.php';
include MVC_PATH . '/html/partials/topbar.php';
?>
<div class="layout">
  <?php include MVC_PATH . '/html/partials/sidebar.php'; ?>

  <div class="content">
    <h1 class="pageTitle">Book Appointment</h1>

    <?php if ($m = flash_get('error')): ?>
      <div class="alert error"><?= htmlspecialchars($m) ?></div>
    <?php endif; ?>

    <div class="panel">
      <form method="post" action="index.php?r=book_appointment" class="form wide">
        <label>Select Doctor</label>
        <select name="doctor_id" required>
          <option value="">-- Choose --</option>
          <?php foreach ($doctors as $d): ?>
            <option value="<?= (int)$d['id'] ?>">
              Dr. <?= htmlspecialchars($d['name']) ?> (<?= htmlspecialchars($d['specialization']) ?>)
            </option>
          <?php endforeach; ?>
        </select>

        <label>Date</label>
        <input type="date" name="date" required/>

        <label>Time</label>
        <input type="time" name="time" required/>

        <button class="btn primary" type="submit">Confirm Booking</button>
      </form>
    </div>
  </div>
</div>
<?php include MVC_PATH . '/html/partials/footer.php'; ?>
