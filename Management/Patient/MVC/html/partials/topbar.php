<div class="topbar">
  <div class="brand">Smart Patient Portal</div>

  <?php if (isset($_SESSION['patient'])): ?>
    <div class="userbox">
      <div class="userchip">
        <img class="avatar" src="images/avatar.svg" alt="avatar"/>
        <div class="username"><?= htmlspecialchars($_SESSION['patient']['name'] ?? 'Patient') ?></div>
        <div class="caret">▼</div>
      </div>
      <div class="dropdown">
        <a href="index.php?r=logout">Logout</a>
      </div>
    </div>
  <?php endif; ?>
</div>
