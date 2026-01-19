<?php include "_layout_top.php"; ?>

<h2>My Appointments</h2>

<?php if(isset($_GET["msg"])): ?>
  <p style="color:green"><?= htmlspecialchars($_GET["msg"]) ?></p>
<?php endif; ?>
