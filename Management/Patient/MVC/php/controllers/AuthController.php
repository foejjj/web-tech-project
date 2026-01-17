<?php
class AuthController {

    public static function showLogin(): void {
        include MVC_PATH . '/html/auth/login.php';
    }

    public static function showRegister(): void {
        include MVC_PATH . '/html/auth/register.php';
    }

    public static function login(): void {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($email === '' || $password === '') {
            flash_set('error', 'Email and password are required.');
            header('Location: index.php?r=login');
            exit;
        }

        $user = UserModel::findByEmail($email);
        if (!$user || !password_verify($password, $user['password_hash'])) {
            flash_set('error', 'Invalid email or password.');
            header('Location: index.php?r=login');
            exit;
        }

        if ($user['role'] !== 'patient') {
            flash_set('error', 'This portal is for patients only.');
            header('Location: index.php?r=login');
            exit;
        }

        $patient = PatientModel::findByUserId((int)$user['id']);
        if (!$patient) {
            flash_set('error', 'Patient profile not found.');
            header('Location: index.php?r=login');
            exit;
        }

        $_SESSION['user'] = [
            'id' => (int)$user['id'],
            'role' => $user['role'],
            'email' => $user['email'],
        ];
        $_SESSION['patient'] = [
            'patient_id' => (int)$patient['id'],
            'name' => $patient['name'],
            'phone' => $patient['phone'],
        ];

        header('Location: index.php?r=dashboard');
        exit;
    }

    public static function register(): void {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        if ($name === '' || $email === '' || $phone === '' || $password === '') {
            flash_set('error', 'All fields are required.');
            header('Location: index.php?r=register');
            exit;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            flash_set('error', 'Invalid email format.');
            header('Location: index.php?r=register');
            exit;
        }
        if ($password !== $confirm) {
            flash_set('error', 'Passwords do not match.');
            header('Location: index.php?r=register');
            exit;
        }
        if (strlen($password) < 6) {
            flash_set('error', 'Password must be at least 6 characters.');
            header('Location: index.php?r=register');
            exit;
        }
        if (UserModel::findByEmail($email)) {
            flash_set('error', 'Email already registered.');
            header('Location: index.php?r=register');
            exit;
        }

        $conn = DB::conn();
        $conn->begin_transaction();

        try {
            $userId = UserModel::createPatientUser($email, $password);
            PatientModel::create((int)$userId, $name, $phone);

            $conn->commit();
            flash_set('success', 'Registration successful. Please login.');
            header('Location: index.php?r=login');
            exit;

        } catch (Throwable $e) {
            $conn->rollback();
            flash_set('error', 'Registration failed. Try again.');
            header('Location: index.php?r=register');
            exit;
        }
    }

    public static function logout(): void {
        session_destroy();
        header('Location: index.php?r=login');
        exit;
    }
}
