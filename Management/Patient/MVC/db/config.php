<?php
class DB {
    private static ?mysqli $conn = null;

    public static function conn(): mysqli {
        if (self::$conn instanceof mysqli) return self::$conn;

        $host = "localhost";
        $user = "root";
        $pass = "";
        $db   = "smart_patient_portal";

        $conn = new mysqli($host, $user, $pass, $db);
        if ($conn->connect_error) {
            die("DB Connection failed: " . $conn->connect_error);
        }
        $conn->set_charset("utf8mb4");
        self::$conn = $conn;
        return self::$conn;
    }
}
