
<?php
require_once("../db/db.php");

$email = trim($_POST["email"] ?? "");
$pass  = $_POST["password"] ?? "";

if ($email === "" || $pass === "") {
  header("Location: ../html/login.php?err=Email+and+password+required");
  exit;
}

if ($email === ADMIN_EMAIL && $pass === ADMIN_PASSWORD) {
  $_SESSION["user_id"] = 0;
  $_SESSION["role"] = "admin";
  $_SESSION["name"] = "Admin";
  header("Location: /web-tech-project/Management/Admin/MVC/html/dashboard.php");
  exit;
}

$st = $conn->prepare("SELECT id, role, password_hash, status FROM users WHERE email=? LIMIT 1");
$st->bind_param("s", $email);
$st->execute();
$u = $st->get_result()->fetch_assoc();
$st->close();

if (!$u || !password_verify($pass, $u["password_hash"])) {
  header("Location: ../html/login.php?err=Invalid+login");
  exit;
}
if ($u["status"] !== "active") {
  header("Location: ../html/login.php?err=Account+inactive");
  exit;
}

$_SESSION["user_id"] = (int)$u["id"];
$_SESSION["role"] = $u["role"];

if ($u["role"] === "patient") {
  $p = $conn->query("SELECT id,name FROM patients WHERE user_id=".$_SESSION["user_id"]." LIMIT 1")->fetch_assoc();
  if (!$p) {
    header("Location: ../html/login.php?err=Patient+profile+missing");
    exit;
  }
  $_SESSION["patient_id"] = (int)$p["id"];
  $_SESSION["name"] = $p["name"];
  header("Location: /web-tech-project/Management/Patient/MVC/html/dashboard.php");
  exit;
}


if ($u["role"] === "doctor") {
  $d = $conn->query("SELECT id,name,approved,status FROM doctors WHERE user_id=".$_SESSION["user_id"]." LIMIT 1")->fetch_assoc();
  if (!$d) {
    header("Location: ../html/login.php?err=Doctor+profile+missing");
    exit;
  }
  if ((int)$d["approved"] !== 1) {
    header("Location: ../html/login.php?err=Doctor+not+approved+yet");
    exit;
  }
  if ($d["status"] !== "active") {
    header("Location: ../html/login.php?err=Doctor+inactive");
    exit;
  }
  $_SESSION["doctor_id"] = (int)$d["id"];
  $_SESSION["name"] = $d["name"];
  header("Location: /web-tech-project/Management/Doctor/MVC/html/dashboard.php");
  exit;
}

header("Location: ../html/login.php?err=Unknown+role");
exit;
