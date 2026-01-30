<?php
// help-submit.php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['fullName'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $phone    = trim($_POST['phone'] ?? '');
    $message  = trim($_POST['message'] ?? '');

    if ($fullName && $email && $message) {
        // Save to contacts table
        $sql = 'INSERT INTO contacts (full_name, email, phone, message)
                VALUES (?, ?, ?, ?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$fullName, $email, $phone, $message]); // [web:82][web:88]

        // Set success message and render the same help page
        $successMessage = 'Message sent successfully!';
        include __DIR__ . '/templates/help.html';
        exit;
    } else {
        // Missing required fields: you could set an error message too
        $successMessage = 'Please fill in all required fields.';
        include __DIR__ . '/templates/help.html';
        exit;
    }
}

// If accessed via GET, just show help page normally
include __DIR__ . '/templates/help.html';
exit;
