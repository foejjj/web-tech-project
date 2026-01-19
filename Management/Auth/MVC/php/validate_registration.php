

<?php
require_once("../db/db.php");
header("Content-Type: application/json; charset=utf-8");

$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

if (!is_array($data) || ($data["action"] ?? "") !== "check_email") {
  echo json_encode(["ok" => false, "message" => "Invalid request"]);
  exit;
}

$email = trim($data["email"] ?? "");
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo json_encode(["ok" => false, "message" => "Invalid email format"]);
  exit;
}

$stmt = $conn->prepare("SELECT id FROM users WHERE email=? LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
  $stmt->close();
  echo json_encode(["ok" => false, "message" => "Email already exists"]);
  exit;
}

$stmt->close();
echo json_encode(["ok" => true, "message" => "Email available"]);
exit;

