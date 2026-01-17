<?php
$conn = new mysqli("localhost","root","","smart_patient_portal");
if($conn->connect_error){ die("DB Error"); }
session_start();
