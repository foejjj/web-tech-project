<?php
class PatientController {

    public static function dashboard(): void {
        $patientId = (int)($_SESSION['patient']['patient_id'] ?? 0);

        $nextAppt = AppointmentModel::getNextUpcoming($patientId);
        $upcomingCount = AppointmentModel::countUpcoming($patientId);
        $activeRxCount = PrescriptionModel::countActive($patientId);
        $recentTestsCount = LabTestModel::countRecent($patientId);
        $historyVisitsCount = PatientModel::countMedicalHistoryVisits($patientId);

        $data = [
            'nextAppt' => $nextAppt,
            'upcomingCount' => $upcomingCount,
            'activeRxCount' => $activeRxCount,
            'recentTestsCount' => $recentTestsCount,
            'historyVisitsCount' => $historyVisitsCount,
        ];

        include MVC_PATH . '/html/patient/dashboard.php';
    }

    public static function bookAppointmentForm(): void {
        $doctors = DoctorModel::allActive();
        include MVC_PATH . '/html/patient/book_appointment.php';
    }

    public static function bookAppointmentSubmit(): void {
        $patientId = (int)($_SESSION['patient']['patient_id'] ?? 0);

        $doctorId = (int)($_POST['doctor_id'] ?? 0);
        $date = trim($_POST['date'] ?? '');
        $time = trim($_POST['time'] ?? '');

        if ($doctorId <= 0 || $date === '' || $time === '') {
            flash_set('error', 'Doctor, date, and time are required.');
            header('Location: index.php?r=book_appointment');
            exit;
        }

        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            flash_set('error', 'Invalid date format.');
            header('Location: index.php?r=book_appointment');
            exit;
        }

        if (!preg_match('/^\d{2}:\d{2}$/', $time)) {
            flash_set('error', 'Invalid time format.');
            header('Location: index.php?r=book_appointment');
            exit;
        }

        $ok = AppointmentModel::create($patientId, $doctorId, $date, $time);
        if (!$ok) {
            flash_set('error', 'Could not book appointment. Try another time.');
            header('Location: index.php?r=book_appointment');
            exit;
        }

        flash_set('success', 'Appointment booked successfully.');
        header('Location: index.php?r=appointments');
        exit;
    }

    public static function appointments(): void {
        $patientId = (int)($_SESSION['patient']['patient_id'] ?? 0);
        $rows = AppointmentModel::listByPatient($patientId);
        include MVC_PATH . '/html/patient/appointments.php';
    }

    public static function cancelAppointment(): void {
        $patientId = (int)($_SESSION['patient']['patient_id'] ?? 0);
        $appointmentId = (int)($_GET['id'] ?? 0);

        if ($appointmentId <= 0) {
            flash_set('error', 'Invalid appointment.');
            header('Location: index.php?r=appointments');
            exit;
        }

        $ok = AppointmentModel::cancel($appointmentId, $patientId);
        flash_set($ok ? 'success' : 'error', $ok ? 'Appointment cancelled.' : 'Unable to cancel.');
        header('Location: index.php?r=appointments');
        exit;
    }

    public static function prescriptions(): void {
        $patientId = (int)($_SESSION['patient']['patient_id'] ?? 0);
        $rows = PrescriptionModel::listByPatient($patientId);
        include MVC_PATH . '/html/patient/prescriptions.php';
    }

    public static function downloadLatestPrescription(): void {
        $patientId = (int)($_SESSION['patient']['patient_id'] ?? 0);
        $rx = PrescriptionModel::latestByPatient($patientId);

        if (!$rx) {
            flash_set('error', 'No prescription found.');
            header('Location: index.php?r=prescriptions');
            exit;
        }

        $filename = 'prescription_' . $rx['id'] . '.txt';
        header('Content-Type: text/plain; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        echo "SMART PATIENT PORTAL\n";
        echo "PRESCRIPTION\n\n";
        echo "Prescription ID: " . $rx['id'] . "\n";
        echo "Patient: " . ($rx['patient_name'] ?? '') . "\n";
        echo "Doctor: " . ($rx['doctor_name'] ?? '') . "\n";
        echo "Date: " . $rx['issued_at'] . "\n\n";
        echo "Medications:\n" . $rx['medications'] . "\n\n";
        echo "Notes:\n" . ($rx['notes'] ?? '-') . "\n";
        exit;
    }
}
