<?php
class DoctorModel {
    public static function allActive(): array {
        $conn = DB::conn();
        $sql = "SELECT id, name, specialization FROM doctors WHERE status='active' ORDER BY name";
        $res = $conn->query($sql);
        $rows = [];
        while ($r = $res->fetch_assoc()) $rows[] = $r;
        return $rows;
    }
}
