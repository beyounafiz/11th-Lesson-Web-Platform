<?php
// config.php
// Start session for login state
session_start();

// Database configuration for XAMPP MySQL
$host    = 'localhost';
$db      = 'elearning_11th_lesson'; // create this DB in phpMyAdmin
$user    = 'root';                  // default XAMPP user
$pass    = '';                      // default XAMPP password (empty)
$charset = 'utf8mb4';

// Data Source Name
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// PDO options
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // In production do not echo the real message
    die('Database connection failed.');
}
