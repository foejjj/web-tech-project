<?php
$title = "My Appointments";
include MVC_PATH . '/html/partials/head.php';
include MVC_PATH . '/html/partials/topbar.php';
?>
<div class="layout">
  <?php include MVC_PATH . '/html/partials/sidebar.php'; ?>

  <div class="content">
    <div class="rowBetween">
      <h1 class="pageTitle">Appointments</h1>
      <a class="btn primary" href="index.php?r=book_appointment">+ Book</a>
    </div>

    <?php if ($m = flash_get('success')): ?>
      <div class="alert success"><?= htmlspecialchars($m) ?></div>
    <?php endif; ?>
    <?php if ($m = flash_get('error')): ?>
      <div class="alert error"><?= htmlspecialchars($m) ?></div>
    <?php endif; ?>

    <div class="panel">
      <table class="table">
        <thead>
          <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Doctor</th>
            <th>Status</th>
            <th style="width:140px;">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!$rows): ?>
            <tr><td colspan="5" class="muted">No appointments found.</td></tr>
          <?php endif; ?>

          <?php foreach ($rows as $a): ?>
            <tr>
              <td><?= htmlspecialchars($a['date']) ?></td>
              <td><?= htmlspecialchars($a['time']) ?></td>
              <td>Dr. <?= htmlspecialchars($a['doctor_name']) ?></td>
              <td><span class="badge"><?= htmlspecialchars($a['status']) ?></span></td>
              <td>
                <?php if ($a['status'] === 'scheduled'): ?>
                  <a class="btn danger sm" href="index.php?r=cancel_appointment&id=<?= (int)$a['id'] ?>"
                     onclick="return confirm('Cancel this appointment?');">Cancel</a>
                <?php else: ?>
                  <span class="muted">—</span>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

  </div>
</div>
<?php include MVC_PATH . '/html/partials/footer.php'; ?>
