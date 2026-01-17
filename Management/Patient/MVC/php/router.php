<?php
$r = $_GET['r'] ?? 'dashboard';
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

switch ($r) {
    case 'login':
        if ($method === 'POST') AuthController::login();
        else AuthController::showLogin();
        break;

    case 'register':
        if ($method === 'POST') AuthController::register();
        else AuthController::showRegister();
        break;

    case 'logout':
        AuthController::logout();
        break;

    case 'dashboard':
        require_login_patient();
        PatientController::dashboard();
        break;

    case 'book_appointment':
        require_login_patient();
        if ($method === 'POST') PatientController::bookAppointmentSubmit();
        else PatientController::bookAppointmentForm();
        break;

    case 'appointments':
        require_login_patient();
        PatientController::appointments();
        break;

    case 'cancel_appointment':
        require_login_patient();
        PatientController::cancelAppointment();
        break;

    case 'prescriptions':
        require_login_patient();
        PatientController::prescriptions();
        break;

    case 'download_latest_prescription':
        require_login_patient();
        PatientController::downloadLatestPrescription();
        break;

    default:
        require_login_patient();
        PatientController::dashboard();
        break;
}
