<?php
session_start();

define('BASE_PATH', dirname(__DIR__));
define('MVC_PATH', __DIR__ . '/..');

require_once MVC_PATH . '/db/config.php';
require_once __DIR__ . '/helpers/flash.php';
require_once __DIR__ . '/middleware.php';

require_once MVC_PATH . '/db/models/UserModel.php';
require_once MVC_PATH . '/db/models/PatientModel.php';
require_once MVC_PATH . '/db/models/DoctorModel.php';
require_once MVC_PATH . '/db/models/AppointmentModel.php';
require_once MVC_PATH . '/db/models/PrescriptionModel.php';
require_once MVC_PATH . '/db/models/LabTestModel.php';

require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/PatientController.php';
