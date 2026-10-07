<?php
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once __DIR__ . '/controllers/AuthController.php';
}


if (isset($_SESSION['student_id'])) {
    header("Location: index.php?action=profile");
    exit;
}

include __DIR__ . '/views/auth/login.php';
