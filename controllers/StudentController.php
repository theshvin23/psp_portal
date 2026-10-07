<?php

$error = "";


if ($action === 'students') {
    $students = $studentModel->getAll();
    include __DIR__ . '/../views/students/list.php';
    exit;
}


if ($action === 'student_add') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name    = trim($_POST['name'] ?? '');
        $ic      = trim($_POST['ic'] ?? '');
        $program = trim($_POST['program'] ?? '');
        $marks   = $_POST['marks'] ?? '';


        if (empty($name) || empty($ic) || empty($program) || $marks === '') {
            $error = "All fields are required.";
        } elseif (!ctype_digit($ic)) {
            $error = "NRIC must contain numbers only.";
        } elseif (!is_numeric($marks) || $marks < 0 || $marks > 100) {
            $error = "Marks must be a number between 0 and 100.";
        } elseif ($studentModel->icExists($ic)) {
            $error = "NRIC already exists.";
        } else {
  
            $defaultPassword = password_hash("password123", PASSWORD_BCRYPT);
            if ($studentModel->create($name, $ic, $program, $marks, $defaultPassword)) {
                header("Location: index.php?action=students&msg=added");
                exit;
            }
            $error = "Error adding student record.";
        }
    }
    include __DIR__ . '/../views/students/form.php';
    exit;
}


if ($action === 'student_edit') {
    $id = $_GET['id'] ?? ($_POST['id'] ?? null);
    if (!$id) {
        header("Location: index.php?action=students");
        exit;
    }

    $editStudent = $studentModel->getById($id);
    if (!$editStudent) {
        header("Location: index.php?action=students");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name    = trim($_POST['name'] ?? '');
        $ic      = trim($_POST['ic'] ?? '');
        $program = trim($_POST['program'] ?? '');
        $marks   = $_POST['marks'] ?? '';

        if (empty($name) || empty($ic) || empty($program) || $marks === '') {
            $error = "All fields are required.";
        } elseif (!ctype_digit($ic)) {
            $error = "NRIC must contain numbers only.";
        } elseif (!is_numeric($marks) || $marks < 0 || $marks > 100) {
            $error = "Marks must be a number between 0 and 100.";
        } elseif ($studentModel->icExists($ic, $id)) {
            $error = "NRIC already exists.";
        } else {
            if ($studentModel->update($id, $name, $ic, $program, $marks)) {
                header("Location: index.php?action=students&msg=updated");
                exit;
            }
            $error = "Error updating student record.";
        }

        $editStudent = ['id' => $id, 'name' => $name, 'ic' => $ic, 'program' => $program, 'marks' => $marks];
    }
    include __DIR__ . '/../views/students/form.php';
    exit;
}


if ($action === 'student_delete') {
    $id = $_GET['id'] ?? null;
    if ($id) {
        $studentModel->delete($id);
    }
    header("Location: index.php?action=students&msg=deleted");
    exit;
}
