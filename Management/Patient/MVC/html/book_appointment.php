<?php include "_layout_top.php"; ?>
<h2 class="page-title">Book Appointment</h2>

<?php if(isset($_GET["err"])): ?>
  <p style="color:red"><?= htmlspecialchars($_GET["err"]) ?></p>
<?php endif; ?>

<?php if(isset($_GET["msg"])): ?>
  <p style="color:green"><?= htmlspecialchars($_GET["msg"]) ?></p>
<?php endif; ?>
