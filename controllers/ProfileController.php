<?php

$currentStudent = $studentModel->getById($_SESSION['student_id']);
$error = "";
$success = "";

if ($action === 'profile') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $targetDir = __DIR__ . '/../assets/uploads/';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['profile_picture'];
            $allowed = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];

            if (!in_array($file['type'], $allowed, true) || !in_array($ext, $allowedExt, true)) {
                $error = "Only JPEG, PNG, or WEBP images are allowed.";
            } elseif ($file['size'] > 2 * 1024 * 1024) {
                $error = "File size must be less than 2MB.";
            } else {
                $filename = 'profile_' . $_SESSION['student_id'] . '_' . time() . '.' . $ext;
                $destination = $targetDir . $filename;

                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    $oldImage = $currentStudent['profile_picture'] ?? '';
                    if (!empty($oldImage) && file_exists($targetDir . $oldImage)) {
                        unlink($targetDir . $oldImage);
                    }

                    if ($studentModel->updateProfileImage($_SESSION['student_id'], $filename)) {
                        $success = "Profile picture uploaded successfully.";
                        $currentStudent = $studentModel->getById($_SESSION['student_id']);
                    } else {
                        $error = "Error saving profile picture.";
                    }
                } else {
                    $error = "Unable to upload profile picture.";
                }
            }
        }
    }

    include __DIR__ . '/../views/profile/profile.php';
    exit;
}

if ($action === 'change_password') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $oldPassword     = $_POST['old_password'] ?? '';
        $newPassword     = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        $currentHash = $studentModel->getPasswordHash($_SESSION['student_id']);

        if (empty($oldPassword) || empty($newPassword) || empty($confirmPassword)) {
            $error = "All fields are required.";
        } elseif (!password_verify($oldPassword, $currentHash)) {

            $error = "Old password is incorrect.";
        } elseif (strlen($newPassword) < 6) {
            $error = "New password must be at least 6 characters.";
        } elseif ($newPassword !== $confirmPassword) {
            $error = "New password and confirm password do not match.";
        } else {

            $newHash = password_hash($newPassword, PASSWORD_BCRYPT);
            if ($studentModel->updatePassword($_SESSION['student_id'], $newHash)) {
                $success = "Password updated successfully.";
            } else {
                $error = "Error updating password.";
            }
        }
    }
    include __DIR__ . '/../views/profile/change_password.php';
    exit;
}
