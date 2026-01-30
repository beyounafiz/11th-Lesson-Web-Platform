<?php
// submit.php
require 'config.php';

// Require login
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

// Handle quiz submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get current user
    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ? LIMIT 1');
    $stmt->execute([$_SESSION['email']]);
    $user = $stmt->fetch();

    if ($user) {
        // Collect answers from POST (adjust names if your form is different)
        $answers = [
            'q1' => $_POST['q1'] ?? null,
            'q2' => $_POST['q2'] ?? null,
            'q3' => $_POST['q3'] ?? null,
            'q4' => $_POST['q4'] ?? null,
            'q5' => $_POST['q5'] ?? null,
        ];

        // Encode as JSON (similar to JSON field in SQLAlchemy model)
        $json = json_encode($answers);

        // Save to DB
        $insert = $pdo->prepare('INSERT INTO quiz_submissions (user_id, answers) VALUES (?, ?)');
        $insert->execute([$user['id'], $json]);

        // After successful submission go back to dashboard (like your Flask app)
        header('Location: dashboard.php');
        exit;
    } else {
        // If user not found in DB, force logout
        session_unset();
        session_destroy();
        header('Location: login.php');
        exit;
    }
}

// If accessed via GET or something else, just load a simple page or redirect.
include __DIR__ . '/templates/submit.html';
