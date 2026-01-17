<?php
class PrescriptionModel {

    public static function listByPatient(int $patientId): array {
        $conn = DB::conn();
        $sql = "
          SELECT p.id, p.issued_at, p.medications, p.notes, d.name AS doctor_name
          FROM prescriptions p
          JOIN doctors d ON d.id = p.doctor_id
          WHERE p.patient_id = ?
          ORDER BY p.issued_at DESC
        ";
        $st = $conn->prepare($sql);
        $st->bind_param("i", $patientId);
        $st->execute();
        $res = $st->get_result();
        $rows = [];
        while ($r = $res->fetch_assoc()) $rows[] = $r;
        $st->close();
        return $rows;
    }

    public static function latestByPatient(int $patientId): ?array {
        $conn = DB::conn();
        $sql = "
          SELECT p.*, pat.name AS patient_name, d.name AS doctor_name
          FROM prescriptions p
          JOIN patients pat ON pat.id = p.patient_id
          JOIN doctors d ON d.id = p.doctor_id
          WHERE p.patient_id = ?
          ORDER BY p.issued_at DESC
          LIMIT 1
        ";
        $st = $conn->prepare($sql);
        $st->bind_param("i", $patientId);
        $st->execute();
        $row = $st->get_result()->fetch_assoc();
        $st->close();
        return $row ?: null;
    }

    public static function countActive(int $patientId): int {
        $conn = DB::conn();
        $sql = "SELECT COUNT(*) AS c FROM prescriptions WHERE patient_id=? AND status='active'";
        $st = $conn->prepare($sql);
        $st->bind_param("i", $patientId);
        $st->execute();
        $row = $st->get_result()->fetch_assoc();
        $st->close();
        return (int)($row['c'] ?? 0);
    }
}
