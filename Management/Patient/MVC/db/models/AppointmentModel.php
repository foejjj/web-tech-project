<?php
class AppointmentModel {

    public static function create(int $patientId, int $doctorId, string $date, string $time): bool {
        $conn = DB::conn();
        $status = 'scheduled';
        $sql = "INSERT INTO appointments (patient_id, doctor_id, date, time, status) VALUES (?,?,?,?,?)";
        $st = $conn->prepare($sql);
        $st->bind_param("iisss", $patientId, $doctorId, $date, $time, $status);
        $ok = $st->execute();
        $st->close();
        return $ok;
    }

    public static function listByPatient(int $patientId): array {
        $conn = DB::conn();
        $sql = "
          SELECT a.id, a.date, a.time, a.status, d.name AS doctor_name
          FROM appointments a
          JOIN doctors d ON d.id = a.doctor_id
          WHERE a.patient_id = ?
          ORDER BY a.date DESC, a.time DESC
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

    public static function cancel(int $appointmentId, int $patientId): bool {
        $conn = DB::conn();
        $status = 'cancelled';
        $sql = "UPDATE appointments SET status=? WHERE id=? AND patient_id=? AND status='scheduled'";
        $st = $conn->prepare($sql);
        $st->bind_param("sii", $status, $appointmentId, $patientId);
        $ok = $st->execute() && $st->affected_rows > 0;
        $st->close();
        return $ok;
    }

    public static function getNextUpcoming(int $patientId): ?array {
        $conn = DB::conn();
        $sql = "
          SELECT a.id, a.date, a.time, d.name AS doctor_name
          FROM appointments a
          JOIN doctors d ON d.id = a.doctor_id
          WHERE a.patient_id = ? AND a.status='scheduled'
            AND (a.date > CURDATE() OR (a.date = CURDATE() AND a.time >= CURTIME()))
          ORDER BY a.date ASC, a.time ASC
          LIMIT 1
        ";
        $st = $conn->prepare($sql);
        $st->bind_param("i", $patientId);
        $st->execute();
        $row = $st->get_result()->fetch_assoc();
        $st->close();
        return $row ?: null;
    }

    public static function countUpcoming(int $patientId): int {
        $conn = DB::conn();
        $sql = "
          SELECT COUNT(*) AS c
          FROM appointments
          WHERE patient_id = ? AND status='scheduled'
            AND (date > CURDATE() OR (date = CURDATE() AND time >= CURTIME()))
        ";
        $st = $conn->prepare($sql);
        $st->bind_param("i", $patientId);
        $st->execute();
        $row = $st->get_result()->fetch_assoc();
        $st->close();
        return (int)($row['c'] ?? 0);
    }
}
