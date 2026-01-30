<?php
// sign-up.php
require 'config.php';

$error = '';
$success = '';

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($name && $email && $password) {
        // Hash password (similar to bcrypt in your Flask app)
        $hash = password_hash($password, PASSWORD_BCRYPT);

        // Insert user
        $stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
        try {
            $stmt->execute([$name, $email, $hash]);
            // After successful signup, redirect to login
            header('Location: login.php');
            exit;
        } catch (PDOException $e) {
            // Likely duplicate email or DB error
            $error = 'This email is already registered or there was a database error.';
        }
    } else {
        $error = 'All fields are required.';
    }
}

// Render original sign-up template
include __DIR__ . '/templates/sign-up.html';
