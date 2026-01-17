<?php
$conn = new mysqli("localhost", "root", "", "smart_patient_portal");
if ($conn->connect_error) die("DB Connection Failed");
$conn->set_charset("utf8mb4");
session_start();

define("ADMIN_EMAIL", "admin@portal.com");
define("ADMIN_PASSWORD", "admin123");
