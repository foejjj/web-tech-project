<?php $title = "Patient Login"; include MVC_PATH . '/html/partials/head.php'; ?>
<div class="authWrap">
  <div class="authCard">
    <h2>Patient Login</h2>

    <?php if ($m = flash_get('error')): ?>
      <div class="alert error"><?= htmlspecialchars($m) ?></div>
    <?php endif; ?>
    <?php if ($m = flash_get('success')): ?>
      <div class="alert success"><?= htmlspecialchars($m) ?></div>
    <?php endif; ?>

    <form method="post" action="index.php?r=login" class="form">
      <label>Email</label>
      <input type="email" name="email" required/>

      <label>Password</label>
      <input type="password" name="password" required/>

      <button class="btn primary" type="submit">Login</button>
    </form>

    <div class="authLinks">
      <a href="index.php?r=register">Create an account</a>
    </div>
  </div>
</div>
<?php include MVC_PATH . '/html/partials/footer.php'; ?>
