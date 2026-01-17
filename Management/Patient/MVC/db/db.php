<?php
$conn = new mysqli("localhost", "root", "", "smart_patient_portal");
if ($conn->connect_error) {
    die("Database Connection Failed");
}
session_start();
