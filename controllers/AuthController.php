<?php

$ic = trim($_POST['ic'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($ic) || empty($password)) {
    $error = "Please enter your NRIC and password.";
} else {
    require_once __DIR__ . '/../config/database.php';
    require_once __DIR__ . '/../models/Student.php';

    $database = new Database();
    $db = $database->getConnection();
    $studentModel = new Student($db);

    $result = $studentModel->authenticate($ic, $password);

    if ($result) {
     
        session_regenerate_id(true);
        $_SESSION['student_id']   = $result['id'];
        $_SESSION['student_name'] = $result['name'];
        header("Location: index.php?action=profile");
        exit;
    } else {
        $error = "Invalid NRIC or password.";
    }
}
