<?php $title = "Patient Registration"; include MVC_PATH . '/html/partials/head.php'; ?>
<div class="authWrap">
  <div class="authCard">
    <h2>Patient Registration</h2>

    <?php if ($m = flash_get('error')): ?>
      <div class="alert error"><?= htmlspecialchars($m) ?></div>
    <?php endif; ?>

    <form method="post" action="index.php?r=register" class="form">
      <label>Full Name</label>
      <input type="text" name="name" required/>

      <label>Email</label>
      <input type="email" name="email" required/>

      <label>Phone</label>
      <input type="text" name="phone" required/>

      <label>Password</label>
      <input type="password" name="password" required minlength="6"/>

      <label>Confirm Password</label>
      <input type="password" name="confirm_password" required minlength="6"/>

      <button class="btn primary" type="submit">Register</button>
    </form>

    <div class="authLinks">
      <a href="index.php?r=login">Back to login</a>
    </div>
  </div>
</div>
<?php include MVC_PATH . '/html/partials/footer.php'; ?>
