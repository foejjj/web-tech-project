<?php
$conn = new mysqli("localhost","root","","smart_patient_portal");
if($conn->connect_error) die("DB Error");
session_start();

define("ADMIN_EMAIL","admin@portal.com");
define("ADMIN_PASSWORD","admin123");
?>