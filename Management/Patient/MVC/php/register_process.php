<?php
require_once("../db/db.php");

$name=$_POST["name"];
$email=$_POST["email"];
$phone=$_POST["phone"];
$pass=password_hash($_POST["password"],PASSWORD_DEFAULT);

$conn->query("INSERT INTO users(role,email,password_hash) VALUES('patient','$email','$pass')");
$uid=$conn->insert_id;

$conn->query("INSERT INTO patients(user_id,name,phone) VALUES($uid,'$name','$phone')");
header("Location: ../html/login.php");
