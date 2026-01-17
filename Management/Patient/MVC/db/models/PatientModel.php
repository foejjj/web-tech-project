<?php
class PatientModel {
    public static function findByUserId(int $userId): ?array {
        $conn = DB::conn();
        $sql = "SELECT id, user_id, name, phone FROM patients WHERE user_id = ? LIMIT 1";
        $st = $conn->prepare($sql);
        $st->bind_param("i", $userId);
        $st->execute();
        $res = $st->get_result();
        $row = $res->fetch_assoc();
        $st->close();
        return $row ?: null;
    }

    public static function create(int $userId, string $name, string $phone): bool {
        $conn = DB::conn();
        $sql = "INSERT INTO patients (user_id, name, phone) VALUES (?,?,?)";
        $st = $conn->prepare($sql);
        $st->bind_param("iss", $userId, $name, $phone);
        $ok = $st->execute();
        $st->close();
        return $ok;
    }

    public static function countMedicalHistoryVisits(int $patientId): int {
        $conn = DB::conn();
        $sql = "SELECT COUNT(*) AS c FROM medical_history_visits WHERE patient_id = ?";
        $st = $conn->prepare($sql);
        $st->bind_param("i", $patientId);
        $st->execute();
        $res = $st->get_result()->fetch_assoc();
        $st->close();
        return (int)($res['c'] ?? 0);
    }
}
