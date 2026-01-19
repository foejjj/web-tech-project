<?php include "_layout_top.php"; ?>

<h2 class="page-title">Profile</h2>

<?php if(isset($_GET["msg"])): ?>
  <div class="alert success"><?= htmlspecialchars($_GET["msg"]) ?></div>
<?php endif; ?>

<?php if(isset($_GET["err"])): ?>
  <div class="alert error"><?= htmlspecialchars($_GET["err"]) ?></div>
<?php endif; ?>

<div class="card-grid">
  <div class="card" style="max-width:520px;">
    <h3>Update Name</h3>

    <form method="post" action="../php/profile_process.php">
      <input type="hidden" name="action" value="name">
      <input name="name" placeholder="Full Name" value="<?= htmlspecialchars($_SESSION["name"] ?? "") ?>" required>
      <button class="btn" type="submit">Update Name</button>
    </form>
  </div>

    <div class="card" style="max-width:520px;">
    <h3>Change Password</h3>

    <form method="post" action="../php/profile_process.php">
      <input type="hidden" name="action" value="password">

      <input type="password" name="old_password" placeholder="Old Password" required>
      <input type="password" name="new_password" placeholder="New Password" required>
      <input type="password" name="confirm_password" placeholder="Confirm New Password" required>

      <button class="btn gray" type="submit">Change Password</button>
    </form>
  </div>
</div>

