<?php
class UserModel {
    public static function findByEmail(string $email): ?array {
        $conn = DB::conn();
        $sql = "SELECT id, role, email, password_hash, status FROM users WHERE email = ? LIMIT 1";
        $st = $conn->prepare($sql);
        $st->bind_param("s", $email);
        $st->execute();
        $res = $st->get_result();
        $row = $res->fetch_assoc();
        $st->close();
        return $row ?: null;
    }

    public static function createPatientUser(string $email, string $password): int {
        $conn = DB::conn();
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $role = 'patient';
        $sql = "INSERT INTO users (role, email, password_hash) VALUES (?,?,?)";
        $st = $conn->prepare($sql);
        $st->bind_param("sss", $role, $email, $hash);
        if (!$st->execute()) {
            $st->close();
            throw new Exception("User insert failed");
        }
        $id = $conn->insert_id;
        $st->close();
        return (int)$id;
    }
}
