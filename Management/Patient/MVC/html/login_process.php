<?php
require_once("../db/db.php");

$email = $_POST["email"];
$pass  = $_POST["password"];

$q = $conn->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
$q->bind_param("s", $email);
$q->execute();
$user = $q->get_result()->fetch_assoc();

if (!$user || !password_verify($pass, $user["password_hash"])) {
    header("Location: ../html/login.php");
    exit;
}

if ($user["role"] !== "patient") {
    header("Location: ../html/login.php");
    exit;
}

$p = $conn->query("SELECT id,name FROM patients WHERE user_id=".$user["id"])->fetch_assoc();

$_SESSION["patient_id"] = $p["id"];
$_SESSION["patient_name"] = $p["name"];

header("Location: dashboard.php");
exit;
