-- PSP Student Portal - Database Schema
-- Import this file first (phpMyAdmin: Import, or `mysql -u root -p < database.sql`)
-- After importing, run seed.php once (in browser or CLI) to insert sample students
-- with properly hashed passwords.

CREATE DATABASE IF NOT EXISTS psp_portal CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE psp_portal;

CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    ic VARCHAR(20) NOT NULL UNIQUE,
    program VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    marks DECIMAL(5,2) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
