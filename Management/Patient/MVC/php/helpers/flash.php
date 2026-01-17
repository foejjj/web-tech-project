<?php
function flash_set(string $key, string $msg): void {
    $_SESSION['flash'][$key] = $msg;
}
function flash_get(string $key): ?string {
    if (!isset($_SESSION['flash'][$key])) return null;
    $msg = $_SESSION['flash'][$key];
    unset($_SESSION['flash'][$key]);
    return $msg;
}
