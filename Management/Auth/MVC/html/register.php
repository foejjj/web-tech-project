<?php require_once("../db/db.php"); ?>
<!doctype html>
<html>
<head>
  <title>Register</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="auth-container">
  <div class="auth-box">
    <h2>Registration</h2>

    <?php if(isset($_GET["msg"])): ?>
      <div class="alert success"><?= htmlspecialchars($_GET["msg"]) ?></div>
    <?php endif; ?>

    <form method="post" action="../php/register_process.php">
      <label>Register As</label>
      <select name="role" id="role" required>
        <option value="">-- Select --</option>
        <option value="patient">Patient</option>
        <option value="doctor">Doctor</option>
      </select>

      <input name="name" placeholder="Full Name" required>
      <input name="email" type="email" placeholder="Email" required>
      <input name="phone" placeholder="Phone" required>
      <input name="password" type="password" placeholder="Password" required>

      <div id="doctorBox" style="display:none;">
        <input name="specialization" placeholder="Specialization (Doctor)">
      </div>

      <button type="submit">Register</button>
    </form>

    <p class="center">
      Already have account? <a href="login.php">Login</a>
    </p>
  </div>
</div>

<script>
  const role = document.getElementById("role");
  const box = document.getElementById("doctorBox");
  role.addEventListener("change", () => {
    box.style.display = (role.value === "doctor") ? "block" : "none";
  });
</script>

</body>
</html>
