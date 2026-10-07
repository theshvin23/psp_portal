<?php
session_start();

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/models/Student.php';


if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit;
}

$database = new Database();
$db = $database->getConnection();
$studentModel = new Student($db);

$action = $_GET['action'] ?? 'profile';

switch ($action) {
    case 'profile':
    case 'change_password':
        require_once __DIR__ . '/controllers/ProfileController.php';
        break;

    case 'students':
    case 'student_add':
    case 'student_edit':
    case 'student_delete':
        require_once __DIR__ . '/controllers/StudentController.php';
        break;

    default:
        require_once __DIR__ . '/controllers/ProfileController.php';
}
