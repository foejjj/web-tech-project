<?php
class LabTestModel {
    public static function countRecent(int $patientId): int {
        $conn = DB::conn();
        $sql = "
          SELECT COUNT(*) AS c
          FROM lab_tests
          WHERE patient_id=? AND status IN ('uploaded','reviewed')
            AND created_at >= (NOW() - INTERVAL 30 DAY)
        ";
        $st = $conn->prepare($sql);
        $st->bind_param("i", $patientId);
        $st->execute();
        $row = $st->get_result()->fetch_assoc();
        $st->close();
        return (int)($row['c'] ?? 0);
    }
}
