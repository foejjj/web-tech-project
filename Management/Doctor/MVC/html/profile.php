<?php include "_layout_top.php"; ?>

<h2 class="page-title">Profile</h2>

<?php if(isset($_GET["msg"])): ?>
  <div class="alert success"><?= htmlspecialchars($_GET["msg"]) ?></div>
<?php endif; ?>

<?php if(isset($_GET["err"])): ?>
  <div class="alert error"><?= htmlspecialchars($_GET["err"]) ?></div>
<?php endif; ?>