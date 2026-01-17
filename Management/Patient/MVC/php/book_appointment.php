<?php require_once("../db/db.php"); ?>
<form method="post" action="../php/book_appointment.php">
  <select name="doctor">
    <?php
    $res=$conn->query("SELECT id,name FROM doctors WHERE approved=1");
    while($d=$res->fetch_assoc()):
    ?>
    <option value="<?= $d["id"] ?>"><?= $d["name"] ?></option>
    <?php endwhile; ?>
  </select>
  <input type="date" name="date" required>
  <input type="time" name="time" required>
  <button>Book</button>
</form>
