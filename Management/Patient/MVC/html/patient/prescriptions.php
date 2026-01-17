<?php
$title = "My Prescriptions";
include MVC_PATH . '/html/partials/head.php';
include MVC_PATH . '/html/partials/topbar.php';
?>
<div class="layout">
  <?php include MVC_PATH . '/html/partials/sidebar.php'; ?>

  <div class="content">
    <div class="rowBetween">
      <h1 class="pageTitle">Prescriptions</h1>
      <a class="btn primary" href="index.php?r=download_latest_prescription">Download Latest</a>
    </div>

    <?php if ($m = flash_get('error')): ?>
      <div class="alert error"><?= htmlspecialchars($m) ?></div>
    <?php endif; ?>

    <div class="panel">
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Doctor</th>
            <th>Issued At</th>
            <th>Medications</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!$rows): ?>
            <tr><td colspan="4" class="muted">No prescriptions found.</td></tr>
          <?php endif; ?>

          <?php foreach ($rows as $rx): ?>
            <tr>
              <td>#<?= (int)$rx['id'] ?></td>
              <td>Dr. <?= htmlspecialchars($rx['doctor_name']) ?></td>
              <td><?= htmlspecialchars($rx['issued_at']) ?></td>
              <td class="wrap"><?= nl2br(htmlspecialchars($rx['medications'])) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

  </div>
</div>
<?php include MVC_PATH . '/html/partials/footer.php'; ?>
