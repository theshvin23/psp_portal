<?php

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/models/Student.php';

$database = new Database();
$db = $database->getConnection();
$studentModel = new Student($db);

$samples = [
    ['Ahmad Zulkifli',  '010101010001', 'Diploma Teknologi Maklumat', 85],
    ['Siti Nurhaliza',  '020202020002', 'Diploma Kejuruteraan Elektrik', 78],
    ['Kumar Selvam',    '030303030003', 'Diploma Perakaunan', 90],
];

header('Content-Type: text/plain');

foreach ($samples as $s) {
    if (!$studentModel->icExists($s[1])) {
        $studentModel->create($s[0], $s[1], $s[2], $s[3], password_hash("password123", PASSWORD_BCRYPT));
        echo "Added: {$s[0]} (IC: {$s[1]})\n";
    } else {
        echo "Skipped (already exists): {$s[0]}\n";
    }
}

echo "\nSeeding complete. Default password for all sample students: password123\n";
