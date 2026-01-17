<?php
function require_login_patient(): void {
    if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] ?? '') !== 'patient') {
        header('Location: index.php?r=login');
        exit;
    }
}
