<?php
require_once("../../Auth/MVC/db/db.php");
if (!isset($_SESSION["role"]) || $_SESSION["role"]!=="patient") {
  header("Location: /Management/Auth/MVC/html/login.php");
  exit;
}
?>

<?php include "_layout_top.php"; ?>

<h2 class="page-title">Book Appointment</h2>

<div class="panel">
  <form method="post" action="../php/book_appointment.php">
    <select name="doctor" required>
      <option value="">Select Doctor</option>
      <?php
      $res=$conn->query("SELECT id,name FROM doctors WHERE approved=1");
      while($d=$res->fetch_assoc()):
      ?>
        <option value="<?= $d["id"] ?>"><?= htmlspecialchars($d["name"]) ?></option>
      <?php endwhile; ?>
    </select>

    <input type="date" name="date" required>
    <input type="time" name="time" required>

    <button>Confirm</button>
  </form>
</div>

<?php include "_layout_bottom.php"; ?>
<a href="/web-tech-project/Management/Auth/MVC/php/logout.php">Logout</a>
